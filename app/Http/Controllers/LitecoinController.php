<?php

namespace App\Http\Controllers;

use App\Models\litecoin;
use App\Models\litecoinLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LitecoinController extends Controller
{
    public function LitecoinIndex (){
        $kontrol = litecoin::whereuser_id(Auth::user()->id)->first();
        $history = Auth::user()->litecoinLog()->get();

        return view('litecoin')
            ->with('history',$history)
            ->with('kontrol',$kontrol);
    }

    public function litecoinAdressOlustur (){

        $address = bitcoind()->client('litecoin')->getnewaddress(Auth::user()->id."-".Auth::user()->name);
        litecoin::create([
            'user_id' => Auth::user()->id,
            'address' => $address[0]
        ]);
        return redirect()->back();
    }

    public function receive ($details){
        $tx      = $details['txid'];
        for($i=0; $i<count($details['details']); $i++){

            $address    = $details['details'][$i]['address'];
            $category   = $details['details'][$i]['category'];
            $amount     = $details['details'][$i]['amount'];
            $label      = $details['details'][$i]['label'];

            $log        = litecoinLog::wheretxid($tx)->where('address','=',$address)->where('amount','=',number_format($amount,8))->first();

            $user_id    = explode('-',$label);

            if($log == null){
                litecoinLog::create([
                    'user_id' => $user_id[0],
                    'txid' => $tx,
                    'address' => $address,
                    'category' => $category,
                    'amount' => number_format($amount,8),
                    'label' => $label
                ]);


                $this->coinAdd($user_id[0],$amount);
            }
        }

    }

    public function send ($details){

        $tx      = $details['txid'];
        for($i=0; $i<count($details['details']); $i++){

            $address    = $details['details'][$i]['address'];
            $category   = $details['details'][$i]['category'];
            $amount     = abs($details['details'][$i]['amount']);
            $comment    = $details['comment'];

            $log        = litecoinLog::wheretxid($tx)->first();

            $user_id    = $details['to'];


            if($log == null){

                litecoinLog::create([
                    'user_id' => $user_id,
                    'txid' => $tx,
                    'address' => $address,
                    'category' => $category,
                    'amount' => number_format($amount,8),
                    'label' => $comment
                ]);


                $this->coinDelete($user_id,$amount);
            }
        }

    }

    public function litecoinCek (Request $request){
        $quantity= $request->quantity;
        $address = $request->address;
        $user_id = Auth::user()->id;
        //bitcoind()->client('litecoin')->estimatesmartfee(3,'ECONOMICAL');

        bitcoind()->client('litecoin')->sendtoaddress($address,$quantity,"satoshiturk kullanıcısı şu adrese : ".$address . " transfer gerçekleştirdi",(string)$user_id,false);

        return redirect()->back();

    }

    public function litecoinNotify (Request $request){
        $details = bitcoind()->client('litecoin')->gettransaction($request->tx);

        if($details['details'][0]['category'] == "receive"){
            $this->receive($details);
        }else{
            $this->send($details);
        }
    }

    public function coinAdd($user_id,$amount){
        $balance = litecoin::whereuser_id($user_id)->first();
        $bakiye = $balance->balance;
        $balance->update([
            'balance' => number_format(($bakiye+$amount),8)
        ]);
    }

    public function coinDelete($user_id,$amount){

        $balance = litecoin::whereuser_id($user_id)->first();
        $bakiye = $balance->balance;
        $balance->update([
            'balance' => number_format(($bakiye-$amount),8)
        ]);

    }

    public function litecoinUnlock (Request $request){

        bitcoind()->client('litecoin')->walletpassphrase($request->password,(integer)$request->second);

        return redirect()->back();
    }
}
