<?php

namespace App\Repositories;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\UserService;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    use UserService;


    /*
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function test()
    {
        return $this->user->test();
    }
    */
}