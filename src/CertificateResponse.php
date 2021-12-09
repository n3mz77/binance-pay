<?php

namespace Persec\BinancePay;

class CertificateResponse
{
    /**
     * @var mixed|null
     */
    public $status;
    /**
     * @var mixed|null
     */
    public $code;
    /**
     * @var array
     */
    public $data;

    public function __construct(array $data)
    {
        $this->status = $data['status'] ?? null;
        $this->code = $data['code'] ?? null;
        $this->data = [];
        if (!empty($data['data']) && is_array($data['data'])) {
            $certList = [];
            foreach ($data['data'] as $cert)  {
                $certList[] = new Certificate($cert);
            }
            $this->data = $certList;
        }
    }
}
