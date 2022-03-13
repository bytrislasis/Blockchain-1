<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class bitcoinLog extends Model
{
    use HasFactory;

    protected $table = 'bitcoin_log';
    protected $fillable= [
        'user_id',
        'txid',
        'address',
        'category',
        'amount',
        'label',
    ];


    public function User (){
        return $this->belongsTo(User::class);
    }
}
