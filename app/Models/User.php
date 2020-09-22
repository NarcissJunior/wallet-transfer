<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'document',
        'balance',
        'type',
        'balance'
    ];

    //Relacionamento entre o user e a wallet
    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
    }

    public function getBalanceAttribute($balance)
    {
        return $this->attributes['balance'];
    }

    public function setBalanceAttribute($amount)
    {
        $this->attributes['balance'] = $amount;
    }

}
