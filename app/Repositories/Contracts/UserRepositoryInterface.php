<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface
{
    public function getBalanceAttribute(User $user);
    public function setBalanceAttribute($amount);
}