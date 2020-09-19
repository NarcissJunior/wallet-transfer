<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;

class TestController extends Controller
{
    private $_user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->_user = $user;
    }

    public function test()
    {
        $result = $this->_user->test();
        return $result;
    }
}