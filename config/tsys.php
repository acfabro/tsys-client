<?php

// define the root directory as config's parent dir
use Acfabro\Tsys\Transport\PhpSoapClientTransport;

if (!defined('TSYS_PACKAGE_ROOT')) define('TSYS_PACKAGE_ROOT', realpath(__DIR__ . '/..'));

return [

    // auth credentials
    'auth' => [
        'merchantName' => getenv('TSYS_MERCHANT_NAME'),
        'merchantSiteId' => getenv('TSYS_MERCHANT_SITE_ID'),
        'merchantKey' => getenv('TSYS_MERCHANT_KEY'),
    ],

    // genius client config
    'genius' => [
        'api' => getenv('TSYS_GENIUS_API_ENDPOINT'),
        'wsdl' => getenv('TSYS_GENIUS_API_WSDL')?
            getenv('TSYS_GENIUS_API_WSDL'):
            getenv('TSYS_GENIUS_API_ENDPOINT') . "?WSDL",
    ],

    // merchantware config
    'merchantware' => [
        'api' => getenv('TSYS_MERCHANTWARE_API_ENDPOINT'),
        'wsdl' => getenv('TSYS_MERCHANTWARE_API_WSDL')?
            getenv('TSYS_MERCHANTWARE_API_WSDL'):
            getenv('TSYS_MERCHANTWARE_API_ENDPOINT') . "?WSDL",
    ],

    // the soap/json transport adapter
    'transport' => [
        'trace' => getenv('TSYS_TRANSPORT_TRACE')? getenv('TSYS_TRANSPORT_TRACE') : 1, // enable soap client tracing
        'class' => getenv('TSYS_TRANSPORT_CLASS')? getenv('TSYS_TRANSPORT_CLASS') : PhpSoapClientTransport::class,
    ],
];