<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dogecoin extends Model
{
    use HasFactory;
    protected $table = 'dogecoin';
    protected $fillable = [
        'user_id',
        'balance',
        'address'
    ];

    //bu tablo user tablosuna aittir
    public function User (){
        return $this->belongsTo(User::class);
    }

}
