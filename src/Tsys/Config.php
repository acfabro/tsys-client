<?php


namespace Acfabro\Tsys;


use Adbar\Dot;

/**
 * Class Config
 *
 * configuration that is usable by both genius and merchantware clients
 *
 * @package Acfabro\Tsys
 */
class Config
{
    /**
     * @var Dot
     */
    private $data;

    public function __construct(array $config)
    {
        $this->data = new Dot($config);
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function getGeniusApiEndpoint()
    {
        if (isset($this->data['genius.api'])) {
            return $this->data['genius.api'];
        } else {
            throw new \Exception('TSYS_GENIUS_API_ENDPOINT not set');
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getTransportClass()
    {
        if (isset($this->data['transport.class'])) {
            return $this->data['transport.class'];
        } else {
            throw new \Exception('TSYS_TRANSPORT not set');
        }
    }

    public function get($name)
    {
        return $this->data->get($name);
    }

}