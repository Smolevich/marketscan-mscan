<?php

header('Content-type:application/json;charset=utf-8');

require_once '../vendor/autoload.php';

use MarketScan\MScan;

//Load credentials, then intialize an MScan API instance
require_once 'credentials.php';

$mscan = new MScan($marketscan_partner_id, $marketscan_account, 'http://integration.marketscan.io/scan/rest/mscanservice/rest/mscanservice.rst/?', ['http_errors' => 0]);

if(isset($_REQUEST['new'])){
  $new = $mscan->url_component_to_bool($_REQUEST['new']);
}else{
  $new = true;
}

$response = $mscan->GetModels($new);
$body = $response->getBody();
$code = $response->getCode();

//Changes slowly, could cache
echo is_array($body) && $code === 200 ? json_encode($body, JSON_PRETTY_PRINT) : json_encode(["error" => $body]);
