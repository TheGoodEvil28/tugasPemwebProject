<?php
require_once './controller/SellController.php';

$sellController = new SellController();

$page = isset($_GET['page']) ? $_GET['page'] : 'sell';

switch ($page) {
    case 'sell':
        $sellController->sell();
        break;
    case 'Product_detail':
        $sellController->detail();
        break;
    case 'confirm':
        $sellController->confirm();
        break;
    default:
        echo "404 Not Found";
        break;
}
?>
