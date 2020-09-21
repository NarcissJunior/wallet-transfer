<?php

namespace App\Services;

use App\Models\Transaction;
use App\Repositories\UserRepository;

class TransactionService
{

    protected Transaction $transaction;
    protected UserRepository $user;


    public function __construct(
        Transaction $transaction,
        UserRepository $user
    ) {
        $this->transaction = $transaction;
        $this->user = $user;
    }

    public function create($request)
    {

        $this->transaction->fill([
            'customer_payer_id' => $request->payer,
            'customer_payee_id' => $request->payee,
            'value' => $request->value
        ]);

        $this->transaction->save();

        $payerBalance = $this->user->getBalanceAttribute($request->payer);
        $payeeBalance = $this->user->getBalanceAttribute($request->payee);
        
        $amountToReceive = $payeeBalance + $request->value;
        $amountToDiscount = $payerBalance - $request->value;

        $this->user->setBalanceAttribute($request->payer, $amountToDiscount);
        $this->user->setBalanceAttribute($request->payee, $amountToReceive);


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