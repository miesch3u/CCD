<?php

use mywishlist\db\ConnectionFactory;
use mywishlist\Dispatcher;
session_start();
require_once "vendor/autoload.php";

ConnectionFactory::setConfig("DBConfig.ini");
$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$dispatch = new Dispatcher($action);
$dispatch->run();