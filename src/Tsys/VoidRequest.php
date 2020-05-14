<?php


namespace Acfabro\Tsys;


use Acfabro\Tsys\Util\WithDotNotationData;

/**
 * Class VoidRequest
 * @package Acfabro\Tsys
 *
 * @property string Token String	0-100 The token identifier returned from a previous transaction. Note: Either Token or MerchantTransactionId is required.
 * @property string RegisterNumber String	0-100	The identifier for the register or point of sale device submitting the transaction.
 * @property string MerchantTransactionId String	0-100 The merchant-defined identifier for the transaction. Note: Either Token or MerchantTransactionId is required.
 * @property string CardAcceptorTerminalId String (Numeric)	0-16	The Mastercard Card Acceptor Terminal Identifierused to uniquely identify the terminal to the processor.
 */
class VoidRequest
{
    use WithDotNotationData;

    protected $fields = [
        'Token', 'RegisterNumber', 'MerchantTransactionId', 'CardAcceptorTerminalId',
    ];

}