<?php

namespace App\Repositories\Transaction;

class TransactionDTO
{
    private int $payerId;

    private int $payeeId;

    private int $value;

    //TransactionDTO constructor.
    public function __construct(int $payerId, int $payeeId, float $value)
    {
        $this->payerId = $payerId;
        $this->payeeId = $payeeId;
        $this->value = $value;
    }
    
        public function getPayerId(): int
        {
            return $this->payerId;
        }
    
        public function getPayeeId(): int
        {
            return $this->payeeId;
        }
    
        public function getValue(): int
        {
            return $this->value;
        }

        //verificar
        public function toArray(): array
        {
            return [
                'payerId' => $this->getPayerId(),
                'payeeId' => $this->getPayeeId(),
                'value' => $this->getValue()
            ];
        }
}