<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallets';

    //Relacionamento entre a wallet e o user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function getUserIdAttribute($id)
    {
        return ucfirst($id);
    }

    public function getBalanceAttribute($value)
    {
        return ucfirst($value);
    }


    public function setBalanceAttribute($value)
    {
        $this->attributes['balance'] = $value;
    }
}
