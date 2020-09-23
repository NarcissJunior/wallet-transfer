<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Exceptions\Handler;
use Exception;

use App\Services\ValidationService;
use App\Services\UserService;
use App\Models\Transaction;
use App\Models\User;

class TransactionService
{
    protected ValidationService $validationService;
    protected Transaction $transaction;
    protected UserService $userService;

    protected $firstStep = 1;
    protected $secondStep = 1;

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
        DB::beginTransaction();
        try
        {
            $this->verifyTransaction($request);

            $this->verifyThirdService($this->firstStep);

            $this->updateCustomersBalance($request);

            $this->verifyThirdService($this->secondStep);

            $this->saveTransaction($request);

            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollBack();
            return $e->getMessage();
        }

        return response()->json([
            'message' => 'Transação realizada com sucesso!'
        ], 200);
    }

    private function verifyTransaction($request)
    {
        if(!$this->validateUserType($request->payer))
        {
            throw new Exception('Este usuário não tem permissão para fazer uma transferência');
        }

        if(!$this->validateFunds($request->payer, $request->value))
        {
            throw new Exception('Este usuário não tem saldo suficiente para realizar esta transação');
        }
    }

    private function validateUserType($userId): bool
    {
        $userType = $this->userService->findTypeById($userId);
        return ($userType === 'pj') ? false : true;
    }

    private function validateFunds($userId, $amount): bool
    {
        $userBalance = $this->userService->findBalanceById($userId);
        return ($userBalance < $amount) ? false : true;
    }

    private function verifyThirdService($step)
    {
        $this->validationService->validate($step);
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

        return $this->transaction->save();
    }
}