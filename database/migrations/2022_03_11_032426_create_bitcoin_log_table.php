<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{


/*"result" => array:13 [▼
"amount" => 1.0E-5
"confirmations" => 5
"blockhash" => "00000000000000de051a69f19c92278ceb45e2f58f435488d25bb39dfe5f4bac"
"blockheight" => 2189205
"blockindex" => 35
"blocktime" => 1646967453
"txid" => "3fe2198612bb96bf52e44c671ab626cd62671564cf7735ae15784e5b844565f1"
"walletconflicts" => []
"time" => 1646967018
"timereceived" => 1646967018
"bip125-replaceable" => "no"
"details" => array:1 [▼
0 => array:5 [▼
"address" => "tb1qr409l7a9fu5tj6zcft7vclhrwhf4vxzd70km28"
"category" => "receive"
"amount" => 1.0E-5
"label" => "2-satoshiturk"
"vout" => 1
]
]*/


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bitcoin_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('txid');
            $table->string('address');
            $table->string('category');
            $table->string('amount');
            $table->string('label');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bitcoin_log');
    }
};
