
<?php

if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['active_account_id'])) {
    $_SESSION['active_account_id'] = 1; // Default to first account
}

$controller = $_GET['c']?? 'Route';
$method = $_GET['m']??'index';

require_once 'controller/Controller.class.php';
require_once "controller/$controller.class.php";
require_once __DIR__ . '/controller/Route.class.php';

//run$
$c = new $controller;
$c ->$method();

// require_once 'model/Model.class.php';