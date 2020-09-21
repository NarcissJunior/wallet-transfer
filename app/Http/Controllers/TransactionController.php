<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

//verificar
// use App\Providers\TransactionServiceProvider;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    protected TransactionService $service;

    public function __construct(TransactionService $service)
    {
        $this->service = $service;
    }

    public function transfer(Request $request)
    {
        //validando a requisição
        $isValidated = $this->validateRequest($request);
        if($isValidated->fails()) {
            return response()->json([
                'error' => 'Favor inserir os dados obrigatórios corretamente!'
            ], 400);
        }

        //chamando o serviço e passando a request
        $this->service->save($request);

    }

    public function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'payer' => 'required|numeric',
            'payee' => 'required|numeric',
            'value' => 'required|numeric',
        ]);

        return $validator;
    }

}