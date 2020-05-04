<?php


namespace Acfabro\Tsys\Transport;


use Acfabro\Tsys\Error\TransportException;
use Acfabro\Tsys\Util\HasPsrLogger;
use Psr\Log\LoggerInterface;
use SoapClient;
use SoapFault;

/**
 * Class PhpSoapClientTransport
 *
 * Uses PHP's native SoapClient as transport
 *
 * @package Acfabro\TSysGeniusClient\Transport
 */
class PhpSoapClientTransport implements TransportInterface
{
    use HasPsrLogger;

    /**
     * @var SoapClient
     */
    private $transport;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param $wsdl
     * @param $args
     * @throws TransportException
     */
    public function initClient($wsdl, $args = null)
    {
        try {
            // if a logger was passed
            if (isset($args['logger']) && $args['logger'] instanceof LoggerInterface) {
                $this->logger = $args['logger'];
            }

            // default SoapClient args
            if ($args === null) $args = ['trace' => 1]; // default args
            $this->transport = new SoapClient($wsdl, $args);

        } catch (SoapFault $e) {
            throw new TransportException("PhpSoapClientTransport: {$e->getMessage()}");
        }
    }

    /**
     * @param string $method
     * @param array $args
     * @return object
     * @throws TransportException
     */
    public function call($method, $args)
    {
        try {
            $response = $this->transport->$method($args);

            // logs the request and response
            $this->log('debug', 'PhpSoapClientTransport request', $this->transport->__getLastRequest());
            $this->log('debug', 'PhpSoapClientTransport response', $this->transport->__getLastResponse());

            // return the response
            return $response;

        } catch (\Exception $e) {
            throw new TransportException("PhpSoapClientTransport: {$e->getMessage()}");
        }
    }

}