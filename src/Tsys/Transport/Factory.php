<?php


namespace Acfabro\Tsys\Transport;


use Acfabro\Tsys\Config;

class Factory
{
    /**
     * @param string $class
     * @param string $endpoint
     * @param Config $config
     * @return TransportInterface
     * @throws \Exception
     */
    public static function make(string $class, string $endpoint, Config $config)
    {
        if (class_exists($class)) {
            /** @var TransportInterface $transport */
            $transport = new $class;
            $transport->initClient($endpoint, ['trace' => $config->get('transport.trace')]);

            return $transport;
        }

        throw new \Exception("Transport not found {$class}");
    }
}