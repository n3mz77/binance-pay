<?php

namespace Persec\BinancePay;

class NotificationData
{
    public $merchantTradeNo;
    public $productType;
    public $productName;
    public $tradeType;
    public $totalFee;
    public $currency;
    public $transactTime;
    public $openUserId;
    public $payerInfo;

    public function __construct(array $data)
    {
        $this->merchantTradeNo = $data['merchantTradeNo'] ?? null;
        $this->productType = $data['productType'] ?? null;
        $this->productName = $data['productName'] ?? null;
        $this->tradeType = $data['tradeType'] ?? null;
        $this->totalFee = $data['totalFee'] ?? null;
        $this->currency = $data['currency'] ?? null;
        $this->transactTime = $data['transactTime'] ?? null;
        $this->openUserId = $data['openUserId'] ?? null;
        if (!empty($data['payerInfo'])) {
            $this->payerInfo = new PayInfoData($data['payerInfo']);
        }
    }
}
