<?php
require_once __DIR__ . '/../model/Model.class.php';


// Koneksi database
$model = new Model();
$db = $model->connect();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $db->prepare("SELECT image_data, image_type FROM product_images WHERE product_id = ?");
    $stmt->execute([$id]);
    $image = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($image) {
        header("Content-Type: " . $image['image_type']);
        echo $image['image_data'];
        exit;
    }
}

http_response_code(404);
echo "Image not found.";
?>
