<?php


namespace Acfabro\Tsys;


use Acfabro\Tsys\Error\NullRequiredPropertyException;
use Acfabro\Tsys\Error\UnrecognizedPropertyException;

/**
 * Class TransportRequest
 *
 * Request object for genius CreateTransaction
 *
 */
class TransportRequest
{
    /**
     * The transaction type for this transaction
     * @var string
     */
    private $TransactionType;

    /**
     * The desired amount for a transaction.
     * @var float
     */
    private $Amount;

    /**
     * A unique ID for the user running the transaction. POS can send
     * the server ID, clerk ID, employee ID, register ID or any other
     * ID that identifies the user or system running the transaction.
     * @var string
     */
    private $ClerkId;

    /**
     * The order or invoice number associated with the transaction.
     * @var string
     */
    private $OrderNumber;

    /**
     * The business name for the merchant as it should appear to the customer.
     * @var string
     */
    private $Dba;

    /**
     * The name of the software application sending the request.
     * @var string
     */
    private $SoftwareName;

    /**
     * The version number of the software application sending the request.
     * @var string
     */
    private $SoftwareVersion;

    /**
     * The merchant-defined identifier for the transaction.
     * @var string
     */
    private $TransactionId;

    /**
     * Terminal ID to uniquely identify the terminal to the processor.
     * The terminal ID must contain all numeric characters. If no value
     * is supplied, the last 2 digits of the Genius device serial number
     * will be used as a default value.
     * @var string
     */
    private $TerminalId;

    /**
     * Required for level 2 transactions. The customer-defined identifier
     * declaring a purchase order for the transaction.
     * @var string
     */
    private $PoNumber;

    /**
     * Override duplicate protection and allow the transaction to process normally.
     * @var bool
     */
    private $ForceDuplicate;

    /**
     * Required for level 2 transactions. The merchant-defined identifier for the
     * customer involved in the transaction.
     * @var string
     */
    private $CustomerCode;

    /**
     * Required for Level 2 transactions. The declared tax amount of the transaction,
     * this does not affect the Amount value.
     * @var float
     */
    private $TaxAmount;

    /**
     * An optional field used to specify the authorization code supplied by the
     * processor. Use only when TransactionType is FORCESALE.
     * @var string
     */
    private $AuthorizationCode;

    /**
     * An optional field used to specify various healthcare amounts for healthcare
     * based cards, such as Flexible Spending Accounts.
     * @var array|null
     */
    private $HealthCareAmountDetails;

    /**
     * An optional field used to specify the amount of the staged transaction that
     * is eligible for a tip. The Genius device displays this value to the customer
     * as well as the total value of the transaction. The EligibleAmount value is
     * used to calculate the tip when the customer taps the Percentage Tip button.
     * @var array|null
     */
    private $TipDetails;

    /**
     * An optional field used to specify the amount of the staged transaction that
     * is eligble for EBT SNAP. The Object contains the SnapAmount and the
     * SnapTaxAmount. Note: The SnapAmount excludes the SnapTaxAmount. The customer
     * does not have to pay tax on SNAP items.
     * @var array|null
     */
    private $EbtAmountDetails;

    /**
     * An optional field that you use to specify various data for Level 3 processing-rates.
     * @var array|null
     */
    private $Invoice;

    private $EntryMode;

    /**
     * Required fields when mass-assigning
     */
    private $__requiredFields = [
        'TransactionType',
        'Amount',
        'ClerkId',
        'OrderNumber',
        'Dba',
        'SoftwareName',
        'SoftwareVersion',
        'TransactionId',
        'ForceDuplicate',
        'CustomerCode',
        'PoNumber',
        'TaxAmount',
        'TerminalId',
        'EntryMode',
    ];

    /**
     * TransportRequest constructor.
     * @param array $data
     * @throws NullRequiredPropertyException
     * @throws UnrecognizedPropertyException
     */
    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            if (!property_exists(TransportRequest::class, $key)) {
                throw new UnrecognizedPropertyException("TransportRequest: Unrecognized property {$key}");
            }

            if (isset($this->__requiredFields[$key]) && $value == null) {
                throw new NullRequiredPropertyException("TransportRequest: Required field {$key} is null");
            }

            $this->$key = $value;
        }

        $this->EntryMode = 'Undefined';
    }

    /**
     * @return string
     */
    public function getTransactionType(): string
    {
        return $this->TransactionType;
    }

    /**
     * @param string $TransactionType
     */
    public function setTransactionType(string $TransactionType): void
    {
        $this->TransactionType = $TransactionType;
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->Amount;
    }

    /**
     * @param float $Amount
     */
    public function setAmount(float $Amount): void
    {
        $this->Amount = $Amount;
    }

    /**
     * @return string
     */
    public function getClerkId(): string
    {
        return $this->ClerkId;
    }

    /**
     * @param string $ClerkId
     */
    public function setClerkId(string $ClerkId): void
    {
        $this->ClerkId = $ClerkId;
    }

    /**
     * @return string
     */
    public function getOrderNumber(): string
    {
        return $this->OrderNumber;
    }

    /**
     * @param string $OrderNumber
     */
    public function setOrderNumber(string $OrderNumber): void
    {
        $this->OrderNumber = $OrderNumber;
    }

    /**
     * @return string
     */
    public function getDba(): string
    {
        return $this->Dba;
    }

    /**
     * @param string $Dba
     */
    public function setDba(string $Dba): void
    {
        $this->Dba = $Dba;
    }

    /**
     * @return string
     */
    public function getSoftwareName(): string
    {
        return $this->SoftwareName;
    }

    /**
     * @param string $SoftwareName
     */
    public function setSoftwareName(string $SoftwareName): void
    {
        $this->SoftwareName = $SoftwareName;
    }

    /**
     * @return string
     */
    public function getSoftwareVersion(): string
    {
        return $this->SoftwareVersion;
    }

    /**
     * @param string $SoftwareVersion
     */
    public function setSoftwareVersion(string $SoftwareVersion): void
    {
        $this->SoftwareVersion = $SoftwareVersion;
    }

    /**
     * @return string
     */
    public function getTransactionId(): string
    {
        return $this->TransactionId;
    }

    /**
     * @param string $TransactionId
     */
    public function setTransactionId(string $TransactionId): void
    {
        $this->TransactionId = $TransactionId;
    }

    /**
     * @return string
     */
    public function getTerminalId(): string
    {
        return $this->TerminalId;
    }

    /**
     * @param string $TerminalId
     */
    public function setTerminalId(string $TerminalId): void
    {
        $this->TerminalId = $TerminalId;
    }

    /**
     * @return string
     */
    public function getPoNumber(): string
    {
        return $this->PoNumber;
    }

    /**
     * @param string $PoNumber
     */
    public function setPoNumber(string $PoNumber): void
    {
        $this->PoNumber = $PoNumber;
    }

    /**
     * @return bool
     */
    public function isForceDuplicate(): bool
    {
        return $this->ForceDuplicate;
    }

    /**
     * @param bool $ForceDuplicate
     */
    public function setForceDuplicate(bool $ForceDuplicate): void
    {
        $this->ForceDuplicate = $ForceDuplicate;
    }

    /**
     * @return string
     */
    public function getCustomerCode(): string
    {
        return $this->CustomerCode;
    }

    /**
     * @param string $CustomerCode
     */
    public function setCustomerCode(string $CustomerCode): void
    {
        $this->CustomerCode = $CustomerCode;
    }

    /**
     * @return float
     */
    public function getTaxAmount(): float
    {
        return $this->TaxAmount;
    }

    /**
     * @param float $TaxAmount
     */
    public function setTaxAmount(float $TaxAmount): void
    {
        $this->TaxAmount = $TaxAmount;
    }

    /**
     * @return string
     */
    public function getAuthorizationCode(): string
    {
        return $this->AuthorizationCode;
    }

    /**
     * @param string $AuthorizationCode
     */
    public function setAuthorizationCode(string $AuthorizationCode): void
    {
        $this->AuthorizationCode = $AuthorizationCode;
    }

    /**
     * @return array|null
     */
    public function getHealthCareAmountDetails(): ?array
    {
        return $this->HealthCareAmountDetails;
    }

    /**
     * @param array|null $HealthCareAmountDetails
     */
    public function setHealthCareAmountDetails(?array $HealthCareAmountDetails): void
    {
        $this->HealthCareAmountDetails = $HealthCareAmountDetails;
    }

    /**
     * @return array|null
     */
    public function getTipDetails(): ?array
    {
        return $this->TipDetails;
    }

    /**
     * @param array|null $TipDetails
     */
    public function setTipDetails(?array $TipDetails): void
    {
        $this->TipDetails = $TipDetails;
    }

    /**
     * @return array|null
     */
    public function getEbtAmountDetails(): ?array
    {
        return $this->EbtAmountDetails;
    }

    /**
     * @param array|null $EbtAmountDetails
     */
    public function setEbtAmountDetails(?array $EbtAmountDetails): void
    {
        $this->EbtAmountDetails = $EbtAmountDetails;
    }

    /**
     * @return array|null
     */
    public function getInvoice(): ?array
    {
        return $this->Invoice;
    }

    /**
     * @param array|null $Invoice
     */
    public function setInvoice(?array $Invoice): void
    {
        $this->Invoice = $Invoice;
    }

    /**
     * @return string[]
     */
    public function getRequiredFields(): array
    {
        return $this->__requiredFields;
    }

    /**
     * @param string[] $__requiredFields
     */
    public function setRequiredFields(array $__requiredFields): void
    {
        $this->__requiredFields = $__requiredFields;
    }

    /**
     * Return this object as array
     * @return array
     */
    public function toArray()
    {
        $return = [];
        foreach ($this as $key => $value) {
            // skip this->__* properties
            if (substr($key, 0, 2) == '__') continue;

            $return[$key] = $value;
        }

        return $return;
    }

    /**
     * @return mixed
     */
    public function getEntryMode()
    {
        return $this->EntryMode;
    }

    /**
     * @param mixed $EntryMode
     */
    public function setEntryMode($EntryMode): void
    {
        $this->EntryMode = $EntryMode;
    }

}
