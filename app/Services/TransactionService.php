<?php

namespace App\Services;

use App\Services\ValidationService;
use App\Models\Transaction;
use App\Models\User;

class TransactionService
{

    protected Transaction $transaction;
    protected ValidationService $validationService;


    public function __construct(
        Transaction $transaction,
        ValidationService $validationService

    ) {
        $this->transaction = $transaction;
        $this->validationService = $validationService;
    }

    public function create($request)
    {
        $this->transaction->fill([
            'customer_payer_id' => $request->payer,
            'customer_payee_id' => $request->payee,
            'value' => $request->value
        ]);

        $this->transaction->save();

        $user = User::findOrFail($request->payer);
        // return $user;

        $response = $this->validationService->validate('GET', 'https://run.mocky.io/v3/8fafdd68-a090-496f-8c9a-3442cf30dae6');
        return $response;

        // $payerBalance = $this->user->getBalanceAttribute($request->payer);
        // $payeeBalance = $this->user->getBalanceAttribute($request->payee);
        
        // $amountToReceive = $payeeBalance + $request->value;
        // $amountToDiscount = $payerBalance - $request->value;

        // $this->user->setBalanceAttribute($request->payer, $amountToDiscount);
        // $this->user->setBalanceAttribute($request->payee, $amountToReceive);

    }

    public function findBalanceById($id)
    {
        return User::where('id', $id)
            ->where();
    }

    public function isCpnj($id)
    {
        return User::where('id', $id)
            ->where('type');
    }



    
    // //Inicio da transaction para atualizar o saldo
    // DB::beginTransaction();
    // try {
    //     DB::table('users')->update(['balance' => $request->value]);
    //     DB::table('users')->update([
    //         'payer_id' => $request->
    //         'balance' => $request->value
    //     ]);

    //     DB::commit();
    //     $this->sendNotification();
    // }
    // catch (\Exception $e) {
    //     DB::rollBack();

    //     //verificar
    //     return response()->json([
    //         'error' => 'Houve uma falha ao inserir os dados no banco'
    //     ], 400);

    //     //verificar
    //     // throw new Exception($e->getMessage());
    // }

}