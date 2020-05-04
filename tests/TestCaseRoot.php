<?php

namespace AcfabroTests;


use Acfabro\Tsys\Config;
use PHPUnit\Framework\TestCase;

class TestCaseRoot extends TestCase
{

    /**
     * @return Config
     */
    public function config()
    {
        $configData = include __DIR__ . '/../config/tsys.php';
        return new Config($configData);
    }

}