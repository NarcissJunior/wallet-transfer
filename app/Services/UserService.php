<?php

namespace App\Services;

use App\Models\User;
use Exception;

class UserService
{

    public function findUser($id)
    {
        try {   
            return User::findOrFail($id);
        } catch (Exception $e)
        {
            throw new Exception('Usuário com o id ' .$id. ' não foi encontrado!!');
        }
    }

    public function findBalanceById($id)
    {
        try {   
            $user = User::findOrFail($id);
        } catch (Exception $e)
        {
            throw new zException('Usuário com o id ' .$id. ' não foi encontrado!');
        }
        return $user->balance;
    }

    public function findTypeById($id)
    {
        try {   
            $user = User::findOrFail($id);
        } catch (Exception $e)
        {
            throw new Exception('Usuário com o id ' .$id. ' não foi encontrado!');
        }
        return $user->type;
    }

    public function updateBalance($infos)
    {
        try {
            $this->subtractValue($infos->payer, $infos->value);
            $this->addValue($infos->payee, $infos->value);
        } catch (Exception $e)
        {
            throw new Exception('Não foi possível completar a transação! Erro no método updateBalance');
        }
    }

    private function subtractValue($payer, $amount)
    {
        $user = User::findOrFail($payer);
        $user->balance = $user->balance - $amount;
        $user->save();
    }

    private function addValue($payee, $amount)
    {
        $user = User::findOrFail($payee);
        $user->balance = $user->balance + $amount;
        $user->save();
    }
}