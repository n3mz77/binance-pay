<?php

namespace Persec\BinancePay\Exceptions;

use Exception;

class RequestException extends Exception
{
    private $httpsStatus;
    public function __construct(string $msg, int $httpStatus)
    {
        $previous = $this->getPrevious();
        $code = $this->code;
        $this->message = $msg;
        $this->httpsStatus = $httpStatus;
        parent::__construct($msg, $code, $previous);
    }

    public function getHttpStatus(): int
    {
        return $this->httpsStatus;
    }
}
