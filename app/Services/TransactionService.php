<?php

namespace App\Services;

use App\Models\Transaction;

class TransactionService
{

public function __construct(
        // TransactionDAOInterface $transactionDAO,
        // CustomerInterface $customerService,
        // TransferAuthorizeAdapter $transferAuthorizeAdapter,
        // TransferNotificationAdapter $transferNotificationAdapter,
        // QueueAdapter $queueAdapter,
        // LoggerInterface $logger

    ) {
        // $this->transactionDAO = $transactionDAO;
        // $this->customerService = $customerService;
        // $this->transferAuthorizeAdapter = $transferAuthorizeAdapter;
        // $this->transferNotificationAdapter = $transferNotificationAdapter;
        // $this->queueAdapter = $queueAdapter;
        // $this->logger = $logger;
    }

    public function save(Request $request)
    {
        return 'ok';
    }

    //aqui eu vou chamar o transactionRepository
}