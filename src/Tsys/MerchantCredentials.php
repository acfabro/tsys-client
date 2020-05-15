<?php


namespace Acfabro\Tsys;


class MerchantCredentials
{
    /**
     * @var string
     */
    private $MerchantName;

    /**
     * @var string
     */
    private $MerchantSiteId;

    /**
     * @var string
     */
    private $MerchantKey;

    public function __construct(Config $config)
    {
        $this->MerchantName = $config->get('auth.merchantName');
        $this->MerchantSiteId = $config->get('auth.merchantSiteId');
        $this->MerchantKey = $config->get('auth.merchantKey');
    }

    /**
     * @return string
     */
    public function getMerchantName(): string
    {
        return $this->MerchantName;
    }

    /**
     * @param string $MerchantName
     */
    public function setMerchantName(string $MerchantName): void
    {
        $this->MerchantName = $MerchantName;
    }

    /**
     * @return string
     */
    public function getMerchantSiteId(): string
    {
        return $this->MerchantSiteId;
    }

    /**
     * @param string $MerchantSiteId
     */
    public function setMerchantSiteId(string $MerchantSiteId): void
    {
        $this->MerchantSiteId = $MerchantSiteId;
    }

    /**
     * @return string
     */
    public function getMerchantKey(): string
    {
        return $this->MerchantKey;
    }

    /**
     * @param string $MerchantKey
     */
    public function setMerchantKey(string $MerchantKey): void
    {
        $this->MerchantKey = $MerchantKey;
    }

    public function toArray()
    {
        return [
            'MerchantName' => $this->MerchantName,
            'MerchantSiteId' => $this->MerchantSiteId,
            'MerchantKey' => $this->MerchantKey,
        ];
    }

}