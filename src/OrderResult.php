<?php

namespace Persec\BinancePay;

class OrderResult {
    public $prepayId;
    public $tradeType;
    public $expireTime;
    public $qrcodeLink;
    public $qrContent;
    public $checkoutUrl;
    public $deeplink;

    public function __construct(array $data)
    {
        $this->prepayId = $data['prepayId'] ?? null;
        $this->tradeType = $data['tradeType'] ?? null;
        $this->expireTime = $data['expireTime'] ?? null;
        $this->qrcodeLink = $data['qrcodeLink'] ?? null;
        $this->qrContent = $data['qrContent'] ?? null;
        $this->checkoutUrl = $data['checkoutUrl'] ?? null;
        $this->deeplink = $data['deeplink'] ?? null;
    }
}
