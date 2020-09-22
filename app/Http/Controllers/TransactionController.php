<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Services\TransactionService;
use App\Models\Transaction;

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

        return $this->service->create($request);

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