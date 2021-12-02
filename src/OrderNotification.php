<?php

namespace Persec\BinancePay;

class OrderNotification
{
    const STATUS_SUCCESS = 'PAY_SUCCESS';
    const STATUS_CLOSE = 'PAY_CLOSED';

    const TYPE_PAY = 'PAY';
    const TYPE_PAYOUT = 'PAYOUT';

    public $bizType;
    public $bizId;
    public $bizStatus;
    public $data;
    public $raw;

    public function __construct(array $data)
    {
        $this->bizType = $data['bizType'] ?? null;
        $this->bizId = $data['bizId'] ?? null;
        $this->bizStatus = $data['bizStatus'] ?? null;
        $this->raw = $data;
        if (!empty($data['data'])) {
            $this->data = new NotificationData($data['data']);
        }
    }

    public function isPaySuccess(): bool
    {
        return $this->bizStatus === self::STATUS_SUCCESS;
    }

    public function isPayClose(): bool
    {
        return $this->bizStatus === self::STATUS_CLOSE;
    }
}
