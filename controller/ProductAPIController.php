<?php
require_once __DIR__ . '/../model/Model.class.php';

require_once __DIR__ . '/../model/Product.model.php';

class ProductAPIController {

    public function getAll() {
        $product = new Product();
        $result = $product->getAllProducts();

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function getById($id) {
        $product = new Product();
        $data = $product->getById($id);

        if ($data) {
            header('Content-Type: application/json');
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(["error" => "Product not found"]);
        }
    }

    public function create() {
        // handle JSON or form-data upload
        $input = json_decode(file_get_contents('php://input'), true);

        if (!$input) {
            http_response_code(400);
            echo json_encode(["error" => "Invalid input"]);
            return;
        }

        $product = new Product(
            null, // no image in JSON
            '', // name not used
            $input['description'] ?? '',
            $input['category'] ?? '',
            $input['brand'] ?? '',
            $input['condition'] ?? '',
            $input['color'] ?? '',
            $input['size'] ?? '',
            $input['fabric'] ?? '',
            1 // default user ID
        );

        $productId = $product->save();

        http_response_code(201);
        echo json_encode(['success' => true, 'id' => $productId]);
    }

    public function updatePrice($id) {
        $input = json_decode(file_get_contents("php://input"), true);
        if (!isset($input['price'])) {
            http_response_code(400);
            echo json_encode(["error" => "Missing price"]);
            return;
        }

        $product = new Product();
        $product->updatePrice($id, $input['price']);

        echo json_encode(["success" => true]);
    }
}
