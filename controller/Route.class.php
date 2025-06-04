<?php

class Route extends Controller {
    function index() {
        $this->loadView('index.php');
    }
    function shop() {
        $this->loadView('shop.php');
    }
    function shop2() {
        $this->loadView('shop3.php');
    }
    function shop3() {
        $this->loadView('shop8.php');
    }
    function sell() {
        $this->loadView('sell.php');

    }
    function profile() {
        $this->loadView('profile.php');
    }
}