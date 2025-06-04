<?php
// index.php

$controller = $_GET['c'] ?? 'SellController'; // default: SellController
$method     = $_GET['m'] ?? 'sell';            // default: sell method

// Load file controller
require_once "controller/$controller.php";

// Pastikan kelas controller ada
if (class_exists($controller)) {
    $c = new $controller();

    // Pastikan method ada di controller
    if (method_exists($c, $method)) {
        $c->$method(); // Panggil method
    } else {
        echo "Method <b>$method</b> tidak ditemukan di <b>$controller</b>.";
    }
} else {
    echo "Controller <b>$controller</b> tidak ditemukan.";
}
?>
