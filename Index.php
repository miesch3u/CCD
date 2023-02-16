<?php

use db\ConnectionFactory;

ConnectionFactory::setConfig("DBConfig.ini");
$action = (isset($_GET['action'])) ? $_GET['action'] : "";
$dispatch = new Dispatcher($action);
$dispatch->run();