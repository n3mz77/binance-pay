<?php

namespace Persec\BinancePay;

class CreateOrderRequest {

    public $merchantId;
    public $subMerchantId;
    public $merchantTradeNo;
    public $tradeType;
    public $totalFee;
    public $currency;
    public $productType;
    public $productName;
    public $productDetail;
    public $returnUrl;
    public $cancelUrl;

    public function __construct(array $data)
    {
        $this->merchantId = $data['merchantId'] ?? null;
        $this->subMerchantId = $data['subMerchantId'] ?? null;
        $this->merchantTradeNo = $data['merchantTradeNo'] ?? null;
        $this->tradeType = $data['tradeType'] ?? null;
        $this->totalFee = $data['totalFee'] ?? null;
        $this->currency = $data['currency'] ?? null;
        $this->productType = $data['productType'] ?? null;
        $this->productName = $data['productName'] ?? null;
        $this->productDetail = $data['productDetail'] ?? null;
        $this->returnUrl = $data['returnUrl'] ?? null;
        $this->cancelUrl = $data['cancelUrl'] ?? null;
    }
}
