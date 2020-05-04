<?php


namespace Acfabro\Tsys;


interface TransactionResponseInterface
{
    /**
     * If the transaction has been approved
     * @return bool
     */
    public function isApproved();
}