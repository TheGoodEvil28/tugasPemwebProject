<?php
if (session_status() === PHP_SESSION_NONE) session_start();
if (!isset($_SESSION['active_account_id'])) {
    $_SESSION['active_account_id'] = 1; // Default to first account
}

//  untuk cek session active_account_id
// echo '<div style=" background-color: #fff; padding: 10px; z-index: 1000; border: 1px solid #ccc;">
//         Active Account: ' . (isset($_SESSION['active_account_id']) ? $_SESSION['active_account_id'] : 'None') . '
//     </div>';

//   untuk cek controller dan method yang diakses
// echo '<div style=" background-color: #fff; padding: 10px; z-index: 1000; border: 1px solid #ccc;"> 
//         Controller: ' . (isset($_GET['c']) ? htmlspecialchars($_GET['c']) : 'Profile') . ' | 
//         Method: ' . (isset($_GET['m']) ? htmlspecialchars($_GET['m']) : 'index') . '
//     </div>';


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
