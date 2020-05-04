<?php


namespace Acfabro\Tsys\Transport;


interface TransportInterface
{
    public function initClient($wsdl, $args = null);

    public function call($method, $args);
}