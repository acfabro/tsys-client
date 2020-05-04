<?php

require_once __DIR__ . '/../vendor/autoload.php';

// load the .env at root dir
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();
