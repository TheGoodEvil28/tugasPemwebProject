<?php
// controller/SellController.php

class SellController {
    public function sell() {
        require_once 'view/Sell.php';
    }
    
    public function confirmation() {
        require_once 'view/Confirmation.php';
    }

    public function productDetail() {
        require_once 'view/Product_detail.php';
    }
}
?>
