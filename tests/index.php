<?php

namespace MyProject;

require_once(__DIR__ . '/../vendor/autoload.php');

use Maib\MaibApi\MaibClient;
use GuzzleHttp\Client;
use GuzzleHttp\Subscriber\Log\Formatter;
use GuzzleHttp\Subscriber\Log\LogSubscriber;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

// Set the Guzzle client options
$options = [
  'base_url' => MaibClient::MAIB_TEST_BASE_URI,
  'debug'  => false,
  'verify' => true,
  'defaults' => [
    'verify' => MaibClient::MAIB_TEST_CERT_URL,
    'cert'    => [MaibClient::MAIB_TEST_CERT_URL, MaibClient::MAIB_TEST_CERT_PASS],
    'ssl_key' => MaibClient::MAIB_TEST_CERT_KEY_URL,
    'config'  => [
      'curl'  =>  [
        CURLOPT_SSL_VERIFYHOST => 2,
        CURLOPT_SSL_VERIFYPEER => true,
      ]
    ]
  ]
];
// init Client
$guzzleClient = new Client($options);

echo "<pre>";
// create a log for client class, if you want (monolog/monolog required)
$log = new Logger('maib_guzzle_request');
$log->pushHandler(new StreamHandler(__DIR__.'/logs/maib_guzzle_request.log', Logger::DEBUG));
$subscriber = new LogSubscriber($log, Formatter::SHORT);

$client = new MaibClient($guzzleClient);
$client->getHttpClient()->getEmitter()->attach($subscriber);

// The Parameters needed to use MaibClient methods
$amount = 1; // The amount of the transaction
$currency = 498; // The currency of the transaction - is the 3 digits code of currency from ISO 4217
$clientIpAddr = '127.0.0.1'; // The client IP address
$description = 'testing'; // The description of the transaction
$lang = 'en'; // The language for the payment gateway

// Other parameters
$sms_transaction_id = null;
$dms_transaction_id = null;
$redirect_url = MaibClient::MAIB_TEST_REDIRECT_URL . '?trans_id=';
$sms_redirect_url = '';
$dms_redirect_url = '';

// The register sms transaction method
$registerSmsTransaction = $client->registerSmsTransaction($amount, $currency, $clientIpAddr, $description, $lang);
$sms_transaction_id = $registerSmsTransaction["TRANSACTION_ID"];
$sms_redirect_url = $redirect_url . $sms_transaction_id;

// The register dms authorization method
$registerDmsAuthorization = $client->registerDmsAuthorization($amount, $currency, $clientIpAddr, $description, $lang);
$dms_transaction_id = $registerDmsAuthorization["TRANSACTION_ID"];
$dms_redirect_url = $redirect_url . $dms_transaction_id;

// The execute dms transaction method
$makeDMSTrans = $client->makeDMSTrans($dms_transaction_id, $amount, $currency, $clientIpAddr, $description, $lang);

// The get transaction result method
$getTransactionResult = $client->getTransactionResult($sms_transaction_id, $clientIpAddr);

// The revert transaction method
$revertTransaction = $client->revertTransaction($sms_transaction_id, $amount);

// The close business day method
$closeDay = $client->closeDay();

// The Dump results examples
$dump = [
    "params" => [
      "amount"              => $amount,
      "currency"            => $currency,
      "clientIpAddr"        => $clientIpAddr,
      "description"         => $description,
      "language"            => $lang,
      "sms_transaction_id"  => $sms_transaction_id,
      "sms_redirect_url"    => '<a href="' . $sms_redirect_url . '">' . $sms_redirect_url . '</a>',
      "dms_transaction_id"  => $dms_transaction_id,
      "dms_redirect_url"    => '<a href="' . $dms_redirect_url . '">' . $dms_redirect_url . '</a>',
    ],
    "registerSmsTransaction"    => $registerSmsTransaction,
    "registerDmsAuthorization"  => $registerDmsAuthorization,
    "makeDMSTrans"              => $makeDMSTrans,
    "getTransactionResult"      => $getTransactionResult,
    "revertTransaction"         => $revertTransaction,
    "closeDay"                  => $closeDay,
];
print_r($dump);
