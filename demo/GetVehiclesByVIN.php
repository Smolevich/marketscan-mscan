<?php

header('Content-type:application/json;charset=utf-8');

require_once '../vendor/autoload.php';

use MarketScan\MScan;

//Load credentials, then intialize an MScan API instance
require_once 'credentials.php';
$mscan = new MScan($marketscan_partner_id, $marketscan_account, 'http://integration.marketscan.io/scan/rest/mscanservice/rest/mscanservice.rst/?', ['http_errors' => 0]);

if(!isset($_REQUEST['vin'])){
  http_response_code(400);
  exit( json_encode(['message' => 'vin is required']) );
}else{
  $vin = $_REQUEST['vin'];
}
$response = $mscan->GetVehiclesByVINParams($vin);
$body = $response->getBody();
$code = $response->getCode();
echo is_array($body) && $code === 200 ? json_encode($body, JSON_PRETTY_PRINT) : $body;
