<?php


namespace Acfabro\Tsys;


use Acfabro\Tsys\Error\DuplicateTransactionException;
use Acfabro\Tsys\Error\TransactionException;
use Acfabro\Tsys\Util\HasPsrLogger;
use Psr\Log\LoggerInterface;

/**
 * Class Client
 *
 * A client for Genius, Merchantware
 *
 * @package Acfabro\Tsys
 */
class Client implements ClientInterface
{
    use HasPsrLogger;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var MerchantCredentials
     */
    private $merchantCredentials;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Client constructor.
     * @param Config $config
     * @param LoggerInterface|null $logger
     */
    public function __construct(Config $config, LoggerInterface $logger = null)
    {
        $this->config = $config;
        $this->merchantCredentials = new MerchantCredentials($config);
        $this->logger = $logger;
    }

    /**
     * @param TransportRequest $request
     * @return TransportKey
     */
    public function geniusStageTransaction(TransportRequest $request)
    {
        // make the transport
        $transport = Transport\Factory::make(
            $this->config->get('transport.class'),
            $this->config->get('genius.wsdl'),
            $this->config
        );

        // assemble the payload data
        $payload = [
            'merchantName' => $this->merchantCredentials->getMerchantName(),
            'merchantSiteId' => $this->merchantCredentials->getMerchantSiteId(),
            'merchantKey' => $this->merchantCredentials->getMerchantKey(),
            'request' => $request->toArray(),
        ];

        // make the transport and send
        $result = $transport->call('CreateTransaction', $payload);
        if (!empty($result->CreateTransactionResult)) {
            $this->transportKey = new TransportKey((array)$result->CreateTransactionResult);
            return $this->transportKey;
        }

        throw new TransactionException("CreateTransaction invalid result: " . var_export($result, true));
    }

    /**
     * @param PaymentData $paymentData
     * @param SaleRequest $request
     * @return TransactionResponse45
     * @throws \Exception
     */
    public function merchantWareSale(PaymentData $paymentData, SaleRequest $request)
    {
        $credentials = [
            'MerchantName' => $this->merchantCredentials->getMerchantName(),
            'MerchantSiteId' => $this->merchantCredentials->getMerchantSiteId(),
            'MerchantKey' => $this->merchantCredentials->getMerchantKey(),
        ];

        // make the transport
        $transport = Transport\Factory::make(
            $this->config->get('transport.class'),
            $this->config->get('merchantware.wsdl'),
            $this->config
        );

        // call the remote service
        $result = $transport->call('Sale', [
            'Credentials' => $credentials,
            'PaymentData' => $paymentData,
            'Request' => $request,
        ]);

        if (!$result || !$result->SaleResult) throw new \Exception("Sale invalid result");
        $response = new TransactionResponse45((array)$result->SaleResult);

        // check if transaction is duplicate
        if (strpos($response->ApprovalStatus, 'DUPLICATE') > 0) {
            throw new DuplicateTransactionException('MerchantWare Sale duplicate transaction');
        }

        return $response;
    }
}