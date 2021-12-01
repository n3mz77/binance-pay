<?php

namespace Persec\BinancePay;

class CreateOrderResponse {
    public $status;
    public $code;
    public $data;
    public $errorMessage;

    public function __construct(array $data)
    {
        $this->status = $data['status'] ?? null;
        $this->code = $data['code'] ?? null;
        $this->errorMessage = $data['errorMessage'] ?? null;
        if (isset($data['data'])) {
            $this->data = new OrderResult($data['data']);
        }
    }

    public function isSuccess(): bool
    {
        return $this->status === 'SUCCESS';
    }
}
