<?php

namespace App\Services;

use App\Services\ValidationService;
use App\Services\UserService;
use App\Models\Transaction;
use App\Models\User;

class TransactionService
{
    protected ValidationService $validationService;
    protected Transaction $transaction;
    protected UserService $userService;

    public function __construct(
        ValidationService $validationService,
        Transaction $transaction,
        UserService $userService
    ) {
        $this->validationService = $validationService;
        $this->userService = $userService;
        $this->transaction = $transaction;
    }

    public function create($request)
    {
        try
        {
            $this->verifyTransaction($request);

            $this->updateCustomersBalance($request);

            $this->saveTransaction($request);

        } catch (Throwable $e) {
        }
    }

    private function verifyTransaction($request)
    {
        if(!$this->validateUserType($request->payer))
        {
            return response()->json([
                'error' => 'Este usuário não tem permissão para fazer uma transferência'
            ], 400);
        }

        if(!$this->validateFunds($request->payer, $request->value))
        {
            return response()->json([
                'error' => 'Este usuário não tem saldo suficiente para realizar esta transação'
            ], 400);
        }

        //verificar
        if(!$this->validateThirdService())
        {
            return response()->json([
                'error' => 'Esta transação não foi autorizada'
            ], 400);
        }
        return true;
    }

    private function validateUserType($userId): bool
    {
        $userType = $this->userService->findTypeById($userId);
        if($userType === 'pj')
        {
            return false;
        }
        return true;
    }

    private function validateFunds($userId, $amount): bool
    {
        $userBalance = $this->userService->findBalanceById($userId);
        if($userBalance < $amount)
        {
            return false;
        }
        return true;
    }

    private function validateThirdService(): bool
    {
        $response = $this->validationService->validate('GET', 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        return true;
    }

    private function updateCustomersBalance($request)
    {
        return $this->userService->updateBalance($request);
    }

    private function saveTransaction($request)
    {
        $this->transaction->fill([
            'customer_payer_id' => $request->payer,
            'customer_payee_id' => $request->payee,
            'value' => $request->value
            ]);

        $this->transaction->save();
    }


    // //Inicio da transaction para atualizar o saldo
    // DB::beginTransaction();
    // try {
    //     DB::commit();
    // }
    // catch (\Exception $e) {
    //     DB::rollBack();
    //     return response()->json([
    //         'error' => 'Houve uma falha ao inserir os dados no banco'
    //     ], 400);
    //     //verificar
    //     // throw new Exception($e->getMessage());
    // }
}