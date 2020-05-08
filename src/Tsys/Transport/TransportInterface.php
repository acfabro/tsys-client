<?php


namespace Acfabro\Tsys\Transport;


interface TransportInterface
{
    public function initClient($wsdl, $args = null);

    public function call($method, $args);

    public function lastRequest($asString = false);

    public function lastResponse($asString = false);
}