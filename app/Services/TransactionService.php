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

    public function create($request): void
    {
        try
        {
            $this->transaction->fill([
                'customer_payer_id' => $request->payer,
                'customer_payee_id' => $request->payee,
                'value' => $request->value
            ]);

            $this->verifyTransaction($request);
            // $this->transaction->save();

            $this->updateCustomersBalance($request);

        } catch (Throwable $e) {

        }
    }

    public function verifyTransaction($request)
    {
        if(!$this->validateUserType($request->payer))
        {
            return "Este usuário não tem permissão para fazer uma transferência";
        }

        if(!$this->validateFunds($request->value))
        {
            return "Este usuário não tem saldo suficiente para realizar esta transação";
        }
        
        if(!$this->validateThirdService())
        {
            return "Esta transação não foi autorizada";
        }
    }

    public function updateCustomersBalance($request): void
    {
        $this->userService->updateBalance($request);
    }

    public function validateUserType($userId): bool
    {
        $userType = $this->userService->findTypeById($userId);
        if($userType === 'pj')
        {
            return false;
        }
        return true;
    }

    public function validateFunds($userId): bool
    {
        $userBalance = $this->userService->findBalanceById($userId);
        if($userBalance < $request->value)
        {
            return false;
        }
        return true;
    }

    public function validateThirdService(): bool
    {
        // $response = $this->validationService->validate('GET', 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        return true;
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