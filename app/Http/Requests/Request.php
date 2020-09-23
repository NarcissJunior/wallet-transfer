<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Http;

class Request
{
    protected $responses = ['Autorizado', 'Enviado'];

    public function makeRequest($method, $uri): bool
    {
        $response = Http::$method($uri)['message'];
        $isValid = in_array($response, $this->responses);
        return ($isValid);
    }
}