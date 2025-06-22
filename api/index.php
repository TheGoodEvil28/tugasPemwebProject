<?php
require_once '../controller/ProductAPIController.php';

$uri = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
$method = $_SERVER['REQUEST_METHOD'];

if ($uri[0] === 'api' && $uri[1] === 'products') {
    $controller = new ProductAPIController();

    if ($method === 'GET' && isset($uri[2])) {
        $controller->getById($uri[2]);
    } elseif ($method === 'GET') {
        $controller->getAll();
    } elseif ($method === 'POST') {
        $controller->create();
    } elseif ($method === 'PUT' && isset($uri[2]) && $uri[3] === 'price') {
        $controller->updatePrice($uri[2]);
    } else {
        http_response_code(405);
        echo json_encode(["error" => "Invalid request method or path"]);
    }

    exit;
}
