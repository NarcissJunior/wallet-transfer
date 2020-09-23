<?php

namespace App\Services;

use App\Http\Requests\Request;


class ValidationService
{
    private array $expectedResponse = ['Autorizado', 'Enviado'];
    protected Request $request;
    protected $method = 'GET';

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function validate($step)
    {
        switch($step)
        {
            case 1:
                $this->validateAuth($this->method, 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
            break;

            case 2:
                $this->validateTransfer($this->method, 'https://run.mocky.io/v3/b19f7b9f-9cbf-4fc6-ad22-dc30601aec04');
            break;
        }
    }

    private function validateAuth($method, $uri)
    {
        if(!$this->request->makeRequest($method, $uri))
        {
            throw new \Exception('O serviço externo não AUTORIZOU a transação!');
        }
    }

    private function validateTransfer($method, $uri)
    {
        if(!$this->request->makeRequest($method, $uri))
        {
            throw new \Exception('O serviço externo não completou ENVIO da transação!');
        }
    }
}