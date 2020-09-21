<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getBalanceAttribute($id)
    {
        $xablau = $this->user->find($id);
        return $xablau;
    }

    public function setBalanceAttribute($amount)
    {
        return $amount;
    }
}