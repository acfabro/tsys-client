<?php


namespace Acfabro\Tsys;


/**
 * Interface ClientInterface
 *
 * Definition of a Genius client
 *
 * @package Acfabro\Tsys
 */
interface ClientInterface
{
    /**
     * Generate a unique key (TransportKey) using the createTransaction
     * web service method to stage the transaction parameters.
     *
     * @param TransportRequest $request Request assoc array
     * @return TransportKey
     */
    public function stageTransaction(TransportRequest $request);
    public function voidTransaction(VoidRequest $request);
    public function detailsByTransportKey(string $transportKey);

    /**
     * Send a Sale request to merchantware api
     * @param PaymentData $paymentData
     * @param SaleRequest $request
     * @return mixed
     */
    public function merchantWareSale(PaymentData $paymentData, SaleRequest $request);

}