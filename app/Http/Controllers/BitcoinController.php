<?php

namespace App\Http\Controllers;

use App\Models\bitcoin;
use App\Models\bitcoinLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BitcoinController extends Controller
{

    public function BitcoinIndex (){
        $kontrol = bitcoin::whereuser_id(Auth::user()->id)->first();
        $history = Auth::user()->bitcoinLog()->get();

        return view('bitcoin')
            ->with('history',$history)
            ->with('kontrol',$kontrol);
    }

    public function bitcoinAdressOlustur (){

        $address = bitcoind()->client('bitcoin')->getnewaddress(Auth::user()->id."-".Auth::user()->name);
        bitcoin::create([
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

            $log        = bitcoinLog::wheretxid($tx)->where('address','=',$address)->where('amount','=',number_format($amount,8))->first();

            $user_id    = explode('-',$label);

            if($log == null){
                bitcoinLog::create([
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

            $log        = bitcoinLog::wheretxid($tx)->first();

            $user_id    = $details['to'];


            if($log == null){

                bitcoinLog::create([
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

    public function bitcoinCek (Request $request){
        $quantity= $request->quantity;
        $address = $request->address;
        $user_id = Auth::user()->id;
        //bitcoind()->client('bitcoin')->estimatesmartfee(3,'ECONOMICAL');

        bitcoind()->client('bitcoin')->sendtoaddress($address,$quantity,"satoshiturk kullanıcısı şu adrese : ".$address . " transfer gerçekleştirdi",(string)$user_id,false);

        return redirect()->back();

    }

    public function bitcoinNotify (Request $request){
        $details = bitcoind()->client('bitcoin')->gettransaction($request->tx);

        if($details['details'][0]['category'] == "receive"){
            $this->receive($details);
        }else{
            $this->send($details);
        }
    }

    public function coinAdd($user_id,$amount){
        $balance = bitcoin::whereuser_id($user_id)->first();
        $bakiye = $balance->balance;
        $balance->update([
            'balance' => number_format(($bakiye+$amount),8)
        ]);
    }

    public function coinDelete($user_id,$amount){

        $balance = bitcoin::whereuser_id($user_id)->first();
        $bakiye = $balance->balance;
        $balance->update([
            'balance' => number_format(($bakiye-$amount),8)
        ]);

    }

    public function bitcoinUnlock (Request $request){

        bitcoind()->client('bitcoin')->walletpassphrase($request->password,(integer)$request->second);

        return redirect()->back();
    }
}
