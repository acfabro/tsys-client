<?php


namespace Acfabro\Tsys;


/**
 * Class TransportKey
 * @package Acfabro\Tsys
 */
class TransportKey
{
    /**
     * @var string
     */
    public $TransportKey;

    /**
     * @var string
     */
    public $ValidationKey;

    /**
     * @var array|null
     */
    public $Messages;

    public function __construct($data)
    {
        $this->TransportKey = $data['TransportKey'];
        $this->ValidationKey = $data['ValidationKey'];
        $this->Messages = $data['Messages'];
    }

    /**
     * @return string
     */
    public function getTransportKey(): string
    {
        return $this->TransportKey;
    }

    /**
     * @param string $TransportKey
     */
    public function setTransportKey(string $TransportKey): void
    {
        $this->TransportKey = $TransportKey;
    }

    /**
     * @return string
     */
    public function getValidationKey(): string
    {
        return $this->ValidationKey;
    }

    /**
     * @param string $ValidationKey
     */
    public function setValidationKey(string $ValidationKey): void
    {
        $this->ValidationKey = $ValidationKey;
    }

    /**
     * @return mixed
     */
    public function getMessages()
    {
        return $this->Messages;
    }

    /**
     * @param array|null $Messages
     */
    public function setMessages(?array $Messages): void
    {
        $this->Messages = $Messages;
    }

}