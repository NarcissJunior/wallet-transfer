<?php

namespace App\Services;

use App\Models\User;

class UserService
{

    public function __construct() {

    }

    public function findBalanceById($id)
    {
        $user = User::findOrFail($id);
        return $user->balance;
    }

    public function findTypeById($id)
    {
        $user = User::findOrFail($id);
        return $user->type;
    }

    public function updateBalance($infos)
    {
        $this->subtractValue($infos->payer, $infos->value);
        $this->addValue($infos->payee, $infos->value);
    }

    public function subtractValue($payer, $amount)
    {
        $user = User::findOrFail($payer);
        $total = $user->balance - $amount;
        $user->balance($total);
        // $user->setAttribute('balance', $total);
    }

    public function addValue($payee, $amount)
    {
        $user = User::findOrFail($payee);
        $total = $user->balance + $amount;
        $user->balance($total);
        // $user->setAttribute('balance', $total);
    }

}