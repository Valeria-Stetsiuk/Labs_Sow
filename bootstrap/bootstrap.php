<?php
require_once '../vendor/autoload.php';

use Dotenv\Dotenv;
use Josantonius\Session\Facades\Session;
Dotenv::createImmutable(__DIR__.'/../')->load();

if (!Session::isStarted()) {
    Session::start();
}
