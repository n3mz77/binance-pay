<?php
include_once './vendor/autoload.php';

use Dotenv\Dotenv;
use Persec\BinancePay\BinancePay;
use Persec\BinancePay\CreateOrderRequest;

$dotenv = Dotenv::createImmutable(__DIR__, '.env');
$dotenv->load();

$key = $_ENV['API_KEY'];
$secretKey = $_ENV['SECRET_KEY'];
$merchantId = $_ENV['MERCHANT_ID'];
$subMerchantId = $_ENV['SUB_MERCHANT_ID'];
$isDebugRequest = $_ENV['DEBUG_REQUEST'] === '1';
$merchantTradeNo = date('Ymdhis');

$bp = new BinancePay($key, $secretKey, $isDebugRequest);
$params = new CreateOrderRequest([
   'merchantId' => $merchantId,
   'subMerchantId' => $subMerchantId,
   'merchantTradeNo' => $merchantTradeNo,
    'tradeType'  => 'APP',
    'totalFee' => '1',
    'currency' => 'BUSD',
    'productType' => 'Package',
    'productName' => 'BullVPN',
    'productDetail' => 'BullVPN 1 month',
    'returnUrl' => 'https://www.example.com/order/success',
    'cancelUrl' => 'https://www.example.com/order'
]);
$res = $bp->createOrder($params);
var_dump($res);
