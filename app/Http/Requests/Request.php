<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Http;

class Request
{
    public function makeRequest($method, $uri)
    {

            $response = Http::$method($uri)['message'];
            return $response;

    }
}