<?php


namespace Acfabro\Tsys;


use Acfabro\Tsys\Util\EasyObject;
use Acfabro\Tsys\Util\WithDotNotationData;

/**
 * Class TransactionResponse45
 * @package Acfabro\Tsys
 *
 * @property string $ApprovalStatus	String	The status of the transaction, whether approved or declined. This value may also have other definitions depending on CardType and context.
 * @property string $Token	String	The identifier received by the Merchantware client when a transaction has been issued. This value may be used to lookup a specific transaction in the history log.
 * @property string $AuthorizationCode	String	Authorization Code issued by the processor upon receipt of a transaction.
 * @property string $TransactionDate	String (DateTime, UTC)	The date and time when a transaction is issued, in UTC time.
 * @property string $Amount	String (Double)	The amount of the transaction. If partial authorizations are enabled, this will be the authorized amount and may be different than the requested amount.
 * @property string $RemainingCardBalance	String (Double)	The amount of money that remains on a card branded gift card or FSA card.
 * @property string $CardNumber	String	A string representing the truncated card number of the payment card used in the transaction.
 * @property string $Cardholder	String	The cardholder associated with the payment card used in a transaction.
 * @property string $CardType	String (CardType Enumeration)	A value from the CardType enumeration indicating the type of payment card used in a transaction.
 * @property string $FsaCard	String (Boolean)	A value indicating if the transaction was processed against an FSA card.
 * @property string $ReaderEntryMode	String (ReaderEntryMode Enumeration)	A value from the ReaderEntryMode enumeration indicating the reader mode used to capture data.
 * @property string $AvsResponse	String	This is a string describing the result of an Address Verification System lookup.
 * @property string $CvResponse	String	A string describing the result of a Card Verification check.
 * @property string $ErrorMessage	String	A message indicating why the transaction could not be processed.
 * @property string $ExtraData	String	Contains extra information, when applicable.
 * @property string $FraudScoring	String	Contains fraud scoring information, including:
 * @property string $ExternalReference: Kount's unique transaction ID
 * @property string $Recommendation: Can be Decline, Approve, Review, or Escalate
 * @property string $Score: Risk score between 1-99, the higher the risk score, the greater the risk of fraud
 * @property string $Status: Can be Success or Failure
 * @property string $Rfmiq	String	Recency-Frequency-Monetary IQ. An anonymized identifier representing the payment card used in the transaction. This field is optional and may not be returned.
 * @property string $Invoice	Object	An optional field that contains various data for level three processing-rates.
 */
class TransactionResponse45 implements TransactionResponseInterface
{
    use WithDotNotationData;

    protected $fields = [
        'ApprovalStatus', 'Token', 'AuthorizationCode', 'TransactionDate', 'Amount',
        'RemainingCardBalance', 'CardNumber', 'Cardholder', 'CardType', 'FsaCard',
        'ReaderEntryMode', 'AvsResponse', 'CvResponse', 'ErrorMessage', 'ExtraData',
        'FraudScoring', 'ExternalReference', 'Recommendation', 'Score', 'Status', 'Rfmiq',
        'Invoice',
    ];

    public function isApproved()
    {
        // TODO: Implement isApproved() method.
    }
}