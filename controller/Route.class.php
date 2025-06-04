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
    public function sell() {
        require_once 'views/Sell.php';
    }
    
    public function confirmation() {
        require_once 'views/Confirmation.php';
    }

    public function productDetail() {
        require_once 'views/Product_detail.php';
    }
    // function sell() {
    //     $this->loadView('sell.php');

    // }
    // function profile() {
    //     $this->loadView('profile.php');
    // }'
    
    
}