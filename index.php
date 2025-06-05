<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['active_account_id'])) {
    $_SESSION['active_account_id'] = 1; // Default to first account
}

$controller = $_GET['c'] ?? 'profile';
$method = $_GET['m'] ?? 'index'; // Default method is now 'index'

// Convert controller name to PascalCase for class name
$controllerClass = ucfirst($controller);

require_once "controller/controller.class.php";
require_once "controller/$controller.class.php";

// biar tahu klo error
$c = new $controllerClass();
if (method_exists($c, $method)) {
    $c->$method();
} else {
    die("Method $method gk ada di controller $controllerClass.");
}
