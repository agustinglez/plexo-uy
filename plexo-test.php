<?php
header('Content-Type: application/json');

require_once 'vendor/autoload.php';

use Plexo\Sdk;
use Plexo\Sdk\Type;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('Plexo');
$log->pushHandler(new StreamHandler('plexo_logs.log', Logger::DEBUG));

$client = new Sdk\Client([
    'env' => 'test',
	'client' => 'NikonTest',
    'pem_filename' => 'NikonTest.pem',
    'privkey_fingerprint' => '*******',
	'logger' => $log
]);

/*
    [CommerceId] => 11773
    [Name] => NikonUYPrueba
*/

try {

    $response = $client->AddIssuerCommerce([
        'IssuerId' => 98001456,
        'CommerceId' => 11773,
    ]);

    echo json_encode($response);

} catch (Sdk\Exception\PlexoException $exc) {
    printf("[%s] (%d) %s\n", get_class($exc), $exc->getCode(), $exc->getMessage());
}