<?php

namespace AcfabroTests\Feature;

use Acfabro\Tsys\Client;
use Acfabro\Tsys\Error\DuplicateTransactionException;
use Acfabro\Tsys\PaymentData;
use Acfabro\Tsys\SaleRequest;
use Acfabro\Tsys\TransactionResponse45;
use Acfabro\Tsys\TransportKey;
use Acfabro\Tsys\TransportRequest;
use AcfabroTests\TestCaseRoot;

class ClientTest extends TestCaseRoot
{
    public function testCanCreateClient()
    {
        $client = new Client($this->config());

        $this->assertInstanceOf(Client::class, $client);
    }

    public function testGeniusSuccessfulCreateTransaction()
    {
        $client = new Client($this->config());
        $response = $client->geniusStageTransaction(new TransportRequest([
            'TransactionType' => "SALE",
            'Amount' => 1.01,
            'ClerkId' => "1",
            'OrderNumber' => "INV1234",
            'Dba' => "TEST MERCHANT",
            'SoftwareName' => "Test Software",
            'SoftwareVersion' => "1.0",
            'TerminalId' => "01",
            'PoNumber' => "PO1234",
            'TaxAmount' => "0.10",
            'EntryMode' => "SWIPE",
            'ForceDuplicate' => true,
        ]));

        print PHP_EOL;
        print "Got TransportKey: {$response->getTransportKey()}" . PHP_EOL;
        print "Got ValidationKey: {$response->getValidationKey()}" . PHP_EOL;
        print "Got Messages: " . print_r($response->getMessages(), true) . PHP_EOL;
        $this->assertInstanceOf(TransportKey::class, $response);
    }

    public function testMerchantWareCanSale()
    {
        $client = new Client($this->config());
        $response = $client->merchantWareSale(
            new PaymentData([
                'Source' => 'Keyed',
                'CardNumber' => '4113601974804222',
                'ExpirationDate' => '0223',
                'CardHolder' => 'John Doe',
                'AvsStreetAddress' => '1 Federal Street',
                'AvsZipCode' => '02110',
                'CardVerificationValue' => '158',
            ]),
            new SaleRequest([
                'Amount' => (float)(rand(100, 10000) / 100),
                'CashbackAmount' => 0.00,
                'SurchargeAmount' => 0.00,
                'TaxAmount' => 0.00,
                'InvoiceNumber' => rand(10000, 99999),
                'PurchaseOrderNumber' => rand(10000, 99999),
                'CustomerCode' => 20,
                'RegisterNumber' => 35,
                'MerchantTransactionId' => rand(10000, 999999),
                'CardAcceptorTerminalId' => 3,
                'EnablePartialAuthorization' => false,
                'ForceDuplicate' => false,
            ])
        );

        $this->assertInstanceOf(TransactionResponse45::class, $response);
        print PHP_EOL . "testMerchantWareCanSale: " . $response->ApprovalStatus . PHP_EOL;
    }

    public function testMerchantWareCanCatchDuplicate()
    {
        $paymentData = new PaymentData([
            'Source' => 'Keyed',
            'CardNumber' => '4113601974804222',
            'ExpirationDate' => '0223',
            'CardHolder' => 'John Doe',
            'AvsStreetAddress' => '1 Federal Street',
            'AvsZipCode' => '02110',
            'CardVerificationValue' => '158',
        ]);
        $saleRequest = new SaleRequest([
            'Amount' => 1.10,
            'CashbackAmount' => 0.00,
            'SurchargeAmount' => 0.00,
            'TaxAmount' => 0.00,
            'InvoiceNumber' => 199,
            'PurchaseOrderNumber' => 199,
            'CustomerCode' => 20,
            'RegisterNumber' => 35,
            'MerchantTransactionId' => 199,
            'CardAcceptorTerminalId' => 3,
            'EnablePartialAuthorization' => false,
            'ForceDuplicate' => false,
        ]);

        $client = new Client($this->config());

        try {
            $client->merchantWareSale($paymentData, $saleRequest);
        } catch (DuplicateTransactionException $e) {
            // ignore first exception, catch the duplicate on the next
        }

        try {
            $client->merchantWareSale($paymentData, $saleRequest);
        } catch (DuplicateTransactionException $e) {
            // if we arrive here, test passes
            $this->assertTrue(true);
            return;
        }

        // if we arrive here, test fails
        $this->assertFalse(true);
    }

}
