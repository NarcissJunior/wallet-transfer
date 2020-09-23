<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Http;

class Request
{
    protected $responses = ['Autorizado', 'Enviado'];

    public function makeRequest($method, $uri)
    {
        $response = Http::$method($uri)['message'];
        // if(in_array($response, $this->responses))
        if(!in_array($response, $this->responses))
        {
            return "fodeu";
        }
    }
}