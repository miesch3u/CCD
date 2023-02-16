<?php

require_once "vendor/autoload.php";

$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$dispatch = new Dispatcher($action);
$dispatch->run();