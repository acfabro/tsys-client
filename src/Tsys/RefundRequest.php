<?php


namespace Acfabro\Tsys;


use Acfabro\Tsys\Util\WithDotNotationData;

/**
 * Class RefundRequest
 *
 * The Refund web method issues a credit card refund to a customer from a prior transaction reference
 *
 * @package Acfabro\Tsys
 *
 * @var string $Amount String (Double)	0-100	The amount to refund.
 * @var string $InvoiceNumber String	0-8	The invoice or order number associated with the transaction.
 * @var string $RegisterNumber String	0-100	The identifier for the register or point of sale device submitting the transaction.
 * @var string $MerchantTransactionId String	0-100	The merchant-defined identifier for the transaction.
 * @var string $CardAcceptorTerminalId String (Numeric)	0-16	The Mastercard Card Acceptor Terminal Identifierused to uniquely identify the terminal to the processor.
 * @var string $EcommerceTransactionIndicator String	0-3	This field has been deprecated. Do not use.
 * *
 */
class RefundRequest
{
    use WithDotNotationData;

    protected $fields = [
        'Amount', 'InvoiceNumber', 'RegisterNumber', 'MerchantTransactionId',
        'CardAcceptorTerminalId', 'EcommerceTransactionIndicator',
    ];
}