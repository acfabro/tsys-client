<?php


namespace Acfabro\Tsys;


use Acfabro\Tsys\Util\EasyObject;
use Acfabro\Tsys\Util\WithDotNotationData;
use Adbar\Dot;

/**
 * Class PaymentData
 * @package Acfabro\Tsys
 *
 * @property string $Source String (Payment Data Source)	1-100	ALL	The method used to supply the payment data. READER or KEYED or PREVIOUSTRANSACTION or VAULT or WALLET
 * @property string $TrackData String	1-500	READER	The complete track data (all tracks) for the payment card returned from a card reader.
 * @property string $PinBlock String	0-100	READER	The PIN block received from a pinpad device.
 * @property string $PinKsn String	0-100	READER	The key serial number (KSN) associated with the PIN block received from a pinpad device.
 * @property string $ReaderEntryMode String	0-100	READER	The reader entry mode for this transaction. It can be either MAGNETICSTRIPE or PROXIMITY.
 * @property string $CardNumber String	13-19	KEYED, WALLET	The PAN or card number of the payment card. For wallets, this is the device issued PAN.
 * @property string $ExpirationDate String	4	KEYED, WALLET	The expiration date of the payment card in MMYY format. For wallets, this is the device issued expiration date.
 * @property string $Cardholder String	0-100	KEYED, WALLET	The cardholder name as it appears on the payment card.
 * @property string $AvsStreetAddress String	0-100	KEYED, WALLET, VAULT	The street address associated with the payment card for use in address verification system (AVS) checks.
 * @property string $AvsZipCode String	0, 5, or 9	KEYED, WALLET, VAULT	The ZIP Code associated with the payment card for use in address verification system (AVS) checks.
 * @property string $CardVerificationValue String	0-100	KEYED, VAULT	The security code (CVD, CVV, CVC, etc.) of the payment card for use in card verification (CV) checks.
 * @property string $EncryptedKeyedData String	1-540	KEYED	The output generated by an encrypted keypad.
 * @property string $Token String	1-100	PREVIOUSTRANSACTION	The token identifier returned from a previous transaction.
 * @property string $VaultToken String	1-40	VAULT	The token used to identify the payment method within the Merchantware Vault.
 * @property string $WalletId String	8	WALLET	The Identifier of the Wallet. Currently only supports the values "ApplePay" or "GooglePay"
 * @property string $PaymentCryptogram String	0-64	WALLET	The base-64 encoded payment cryptogram accompanying an ecommerce wallet transasction.
 * @property string $PaymentCryptogramType String	3	WALLET	The type of data represented in the payment cryptogram field. 3DS
 * @property string $EncryptedPaymentData String	0-10000	WALLET The encypted payment data generated for the wallet transaction, base-64 encoded (UTF-8 charset). The data to be encoded differs per wallet brand. For: Apple Pay: Encode the paymentData field from the PKPaymentToken object Google Pay: Encode the token field from the paymentMethodToken object.
 * @property string $EciIndicator String	0-2	WALLET	The electronic commerce indicator. A field that may accompany a wallet transaction. If present, this value must be passed. Otherwise, the transactoin fails.
 *
 */
class PaymentData
{
    use WithDotNotationData;

    protected $fields = [
        'Source', 'TrackData', 'PinBlock', 'PinKsn', 'ReaderEntryMode', 'CardNumber', 'ExpirationDate',
        'Cardholder', 'AvsStreetAddress', 'AvsZipCode', 'CardVerificationValue', 'EncryptedKeyedData',
        'Token', 'VaultToken', 'WalletId', 'PaymentCryptogram', 'PaymentCryptogramType',
        'EncryptedPaymentData', 'EciIndicator',
    ];
}