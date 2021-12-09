<?php

namespace Persec\BinancePay;

class Certificate
{
    public $certSerial;
    public $certPublic;

    public function __construct(array $data)
    {
        $this->certSerial = $data['certSerial'] ?? null;
        $this->certPublic = $data['certPublic'] ?? null;
    }
}
