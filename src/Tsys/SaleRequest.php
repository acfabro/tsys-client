<?php


namespace Acfabro\Tsys;


use Acfabro\Tsys\Util\WithDotNotationData;

/**
 * Class SaleRequest
 *
 * @package Acfabro\Tsys
 *
 * @property String $Amount	(Double)	0-100	The amount of the sale.
 * @property String $CashbackAmount	(Double)	0-20	The optional amount the customer received as cash back from the transaction when performing sales using a debit card.
 * @property String $SurchargeAmount	(Double)	0-20	The optional surcharge fee or amount charged for the transaction when performing sales using a debit card.
 * @property String $TaxAmount	(Double)	0-100	The declared tax amount of the transaction.
 * @property array $HealthCareAmountDetails	(Not Required)	The health care amount details used when processing FSA cards.
 * @property String $InvoiceNumber	0-8	The invoice or order number associated with the transaction.
 * @property String $PurchaseOrderNumber	0-100	The customer-defined identifier declaring a purchase order for the transaction.
 * @property String $CustomerCode	0-100	The merchant-defined identifier for the customer involved in the transaction.
 * @property String $RegisterNumber	0-100	The identifier for the register or point of sale device submitting the transaction.
 * @property String $MerchantTransactionId	0-100	The merchant-defined identifier for the transaction.
 * @property String $CardAcceptorTerminalId	(Numeric)	0-16	The Mastercard Card Acceptor Terminal Identifier used to uniquely identify the terminal to the processor.
 * @property String $EnablePartialAuthorization	(bool)	0-5	Allow for only part of the total Amount to be authorized during the sale.
 * @property String $ForceDuplicate	(bool)	0-5	Overrides duplicate protection and allow the transaction to process normally.
 * @property String $EcommerceTransactionIndicator	0-3	This field has been deprecated. Do not use.
 * @property Object $Invoice	-	An optional field that you use to specify various data the merchant needs to include for level three processing-rates. *
 */
class SaleRequest
{
    use WithDotNotationData;

    protected $fields = [
        'Amount', 'CashbackAmount', 'SurchargeAmount', 'TaxAmount', 'HealthCareAmountDetails',
        'InvoiceNumber', 'PurchaseOrderNumber', 'CustomerCode', 'RegisterNumber', 'MerchantTransactionId',
        'CardAcceptorTerminalId', 'EnablePartialAuthorization', 'ForceDuplicate',
        'EcommerceTransactionIndicator', 'Invoice',
    ];
}
