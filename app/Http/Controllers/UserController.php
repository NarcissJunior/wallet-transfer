<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositores\UserRepository;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function test()
    {
        $result = $this->user->test();
        return $result;
    }
}