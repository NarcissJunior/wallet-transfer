<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_payer_id',
        'customer_payee_id',
        'value'
    ];

    //Accessors
    public function getCustomerPayerIdAttribute($payerId)
    {
        return ucfirst($payerId);
    }

    public function getCustomerPayeeIdAttribute($payeeId)
    {
        return ucfirst($payeeId);
    }

    public function getValueAttribute($value)
    {
        return ucfirst($value);
    }
}
