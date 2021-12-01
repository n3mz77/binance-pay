<?php

namespace Persec\BinancePay;

use RuntimeException;

class BinancePay
{
    private $secretKey;
    private $key;
    private $isDebug;

    public function __construct($key, $secretKey, $isDebug = false)
    {
        $this->key = $key;
        $this->secretKey = $secretKey;
        $this->isDebug = $isDebug;
    }

    private function getNonce(): string
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $length = 32;
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function getTimestamp() {
        return time() * 1000;
    }

    private function getCertificate(): string
    {
        return $this->key;
    }

    private function getHeaders($timestamp, $nonce, $signature, $cert): array
    {
        return [
            'BinancePay-Timestamp:' . $timestamp,
            'BinancePay-Nonce:' .  $nonce,
            'BinancePay-Certificate-SN:' . $cert,
            'BinancePay-Signature:' . $signature,
            'Content-Type:application/json'
        ];
    }

    private function getPayload($timestamp, $nonce, array $data): string
    {
        $body = json_encode($data);
        return "$timestamp\n$nonce\n$body\n";
    }

    private function getSignature($payload): string
    {
        return strtoupper(bin2hex(hash_hmac('sha512', $payload, $this->secretKey, true)));
    }

    private function getBaseEndpoint($path = ''): string
    {
        return 'https://bpay.binanceapi.com'. $path;
    }

    /**
     * @param CreateOrderRequest $params
     * @return CreateOrderResponse
     * @throws RequestException
     */
    public function createOrder(CreateOrderRequest $params): CreateOrderResponse
    {
        $endpoint = $this->getBaseEndpoint('/binancepay/openapi/order');
        $requestParams = (array) $params;
        $timestamp = $this->getTimestamp();
        $nonce = $this->getNonce();
        $payload = $this->getPayload($timestamp, $nonce, $requestParams);
        $signature = $this->getSignature($payload);
        $cert = $this->getCertificate();
        $headers = $this->getHeaders($timestamp, $nonce, $signature, $cert);
        $rawResponse = $this->request($endpoint, json_encode($requestParams), $headers);
        $responseJson = json_decode($rawResponse, true);
        return new CreateOrderResponse($responseJson);
    }

    /**
     * @param $endpoint
     * @param $params
     * @param array $headers
     * @return bool|string
     * @throws RequestException
     */
    private function request($endpoint, $params, $headers = [])
    {
        $curl = curl_init($endpoint);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($this->isDebug) {
            curl_setopt($curl, CURLOPT_VERBOSE, true);
        }
        $response = curl_exec($curl);
        curl_close($curl);
        $httpStatusCode = intval(curl_getinfo($curl, CURLINFO_HTTP_CODE));
        $errNo = curl_errno($curl);
        $errMsg = curl_error($curl);
        curl_close($curl);
        if ($errNo > 0) {
            throw new RuntimeException($errMsg, $errNo);
        }
        if ($httpStatusCode > 399) {
            throw new RequestException($response, $httpStatusCode);
        }
        return $response;
    }
}

