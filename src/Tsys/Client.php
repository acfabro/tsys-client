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
    public function stageTransaction(TransportRequest $request)
    {
        // make the transport
        $transport = $this->makeTransport($this->config->get('endpoints.staging'));

        // assemble the payload data
        $payload = [
            'merchantName' => $this->merchantCredentials->getMerchantName(),
            'merchantSiteId' => $this->merchantCredentials->getMerchantSiteId(),
            'merchantKey' => $this->merchantCredentials->getMerchantKey(),
            'request' => $request->toArray(),
        ];

        // make the transport and send
        try {
            $result = $transport->call('CreateTransaction', $payload);
            if (!empty($result->CreateTransactionResult) && !empty($result->CreateTransactionResult->TransportKey)) {
                $this->log('debug', "CreateTransaction request: " . $transport->lastRequest());
                $this->log('debug', "CreateTransaction response: " . $transport->lastResponse());
                $this->log('debug', "CreateTransaction result: " . var_export($result, true));
                $this->transportKey = new TransportKey((array)$result->CreateTransactionResult);
                return $this->transportKey;
            } else {
                throw new \Exception("CreateTransaction returns invalid response: " . var_export($result, true));
            }
        } catch (\Exception $e) {
            $this->log('debug', "CreateTransaction request: " . $transport->lastRequest());
            $this->log('debug', "CreateTransaction response: " . $transport->lastResponse());
            $this->log('warning', "CreateTransaction invalid result: " . var_export($result, true));
            throw new TransactionException("CreateTransaction invalid result: " . $e->getMessage());
        }

    }

    /**
     * @param VoidRequest $request
     * @return TransactionResponse45
     * @throws \Exception
     */
    public function voidTransaction(VoidRequest $request)
    {
        // make the transport
        $transport = $this->makeTransport($this->config->get('endpoints.credit'));

        $payload = [
            'Credentials' => $this->merchantCredentials->toArray(),
            'Request' => $request->toArray()
        ];

        // make the transport and send
        $this->log('debug', "Calling Void: " . var_export($payload, true));
        try {
            $result = $transport->call('Void', $payload);
            if (!empty($result->VoidResult) && !empty($result->VoidResult->ApprovalStatus)) {
                $this->log('debug', "VoidResult request: " . $transport->lastRequest());
                $this->log('debug', "VoidResult: " . $transport->lastResponse());
                $this->log('debug', "VoidResult result: " . var_export($result, true));
                return new TransactionResponse45((array)$result->VoidResult);
            } else {
                throw new \Exception("VoidResult returns invalid response: " . var_export($result, true));
            }
        } catch (\Exception $e) {
            $this->log('debug', "VoidResult request: " . $transport->lastRequest());
            $this->log('debug', "VoidResult response: " . $transport->lastResponse());
            $this->log('warning', "VoidResult invalid result: " . var_export($result, true));
            throw new TransactionException("VoidResult invalid result: " . $e->getMessage());
        }
    }


    public function detailsByTransportKey(string $transportKey)
    {
        // make the transport
        $transport = $this->makeTransport($this->config->get('endpoints.reporting'));
        $payload = [
            'Name' => $this->merchantCredentials->getMerchantName(),
            'SiteID' => $this->merchantCredentials->getMerchantSiteId(),
            'Key' => $this->merchantCredentials->getMerchantKey(),
            'TransportKey' => $transportKey
        ];

        // make the transport and send
        $this->log('debug', "Calling DetailsByTransportKey: " . var_export($payload, true));
        try {
            $result = $transport->call('DetailsByTransportKey', $payload);
            if (!empty($result->DetailsByTransportKeyResult)) {
                $this->log('debug', "DetailsByTransportKey request: " . $transport->lastRequest());
                $this->log('debug', "DetailsByTransportKey: " . $transport->lastResponse());
                $this->log('debug', "DetailsByTransportKey result: " . var_export($result, true));
                return (array)$result->DetailsByTransportKeyResult;
            } else {
                throw new \Exception("DetailsByTransportKey returns invalid response: " . var_export($result, true));
            }
        } catch (\Exception $e) {
            $this->log('debug', "DetailsByTransportKey request: " . $transport->lastRequest());
            $this->log('debug', "DetailsByTransportKey response: " . $transport->lastResponse());
            $this->log('warning', "DetailsByTransportKey invalid result: " . var_export($result, true));
            throw new TransactionException("DetailsByTransportKey invalid result: " . $e->getMessage());
        }
    }

    /**
     * The Refund web method issues a credit card refund to a customer from a prior transaction reference. The
     * @param RefundRequest $request
     * @param PaymentData $paymentData
     * @return array
     * @throws TransactionException
     */
    public function refundTransaction(RefundRequest $request)
    {
        // make the transport
        $transport = $this->makeTransport($this->config->get('endpoints.reporting'));
        $payload = [
            'Credentials' => $this->merchantCredentials->toArray(),
            'Request' => $request->toArray(),
        ];

        // make the transport and send
        $this->log('debug', "Calling DetailsByTransportKey: " . var_export($payload, true));
        try {
            $result = $transport->call('DetailsByTransportKey', $payload);
            if (!empty($result->DetailsByTransportKeyResult)) {
                $this->log('debug', "DetailsByTransportKey request: " . $transport->lastRequest());
                $this->log('debug', "DetailsByTransportKey: " . $transport->lastResponse());
                $this->log('debug', "DetailsByTransportKey result: " . var_export($result, true));
                return (array)$result->DetailsByTransportKeyResult;
            } else {
                throw new \Exception("DetailsByTransportKey returns invalid response: " . var_export($result, true));
            }
        } catch (\Exception $e) {
            $this->log('debug', "DetailsByTransportKey request: " . $transport->lastRequest());
            $this->log('debug', "DetailsByTransportKey response: " . $transport->lastResponse());
            $this->log('warning', "DetailsByTransportKey invalid result: " . var_export($result, true));
            throw new TransactionException("DetailsByTransportKey invalid result: " . $e->getMessage());
        }
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
        $transport = $this->makeTransport();

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

    /**
     * @return Transport\TransportInterface
     * @throws \Exception
     */
    protected function makeTransport($endpoint)
    {
        return Transport\Factory::make(
            $this->config->get('transport.class'),
            $endpoint . '?WSDL',
            $this->config
        );
    }
}