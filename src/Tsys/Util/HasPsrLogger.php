<?php


namespace Acfabro\Tsys\Util;


use Psr\Log\LoggerInterface;

/**
 * Trait HasPsrLogger
 * @package Acfabro\Tsys\Util
 * @property LoggerInterface $logger
 */
trait HasPsrLogger
{
    public function log($level, $message, $context = [])
    {
        if ($this->logger instanceof LoggerInterface) {
            $this->logger->$level($message, $context);
        }
    }
}