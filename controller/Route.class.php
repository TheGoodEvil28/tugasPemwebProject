<?php
require_once __DIR__ . '/../model/Model.class.php';
class Route extends Controller {

    function index() {
        $this->loadView('index');
    }

   public function shop() {
    $productModel = $this->loadModel('Product');
    $products = $productModel->getAllProducts(); // misal ambil semua data produk

    $this->loadView('shop', ['products' => $products]);
}




    public function shop2() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $product = $this->loadModel('Product');
        $productData = $product->getById($id);

        if ($productData) {
            $this->loadView('shop2', ['product' => $productData]);
        } else {
            echo "Product not found!";
        }
    } else {
        echo "No product ID provided!";
    }
}


    function shop3() {
        $this->loadView('shop3');
    }

    public function sell() {
        $this->loadView('sell');
    }

    public function profile() {
    $this->loadView('profile'); // or however your app loads views
}

    
public function editProfile() {
        $product = $_SESSION['product'];
    $this->loadView('editProduct', ['product' => $product]);
}

    public function confirmation() {
    session_start();

    if (isset($_SESSION['product'])) {
        $product = $_SESSION['product'];
        $this->loadView('confirmation', ['product' => $product]);
    } else {
        echo "No product data to confirm.";
    }
}


    public function productDetail() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve form data
            $category = $_POST['category'] ?? '';
            $brand = $_POST['brand'] ?? '';
            $condition = $_POST['condition'] ?? '';
            $color = $_POST['color'] ?? '';
            $size = $_POST['size'] ?? '';
            $fabric = $_POST['fabric'] ?? '';
            $description = $_POST['description'] ?? '';
            $user = $_POST['user'] ?? '';


            // Handle photo upload
            $photoData = null;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $photoData = [
                    'data' => file_get_contents($_FILES['photo']['tmp_name']),
                    'type' => $_FILES['photo']['type']
                ];
            }

            // Save product to DB
            $product = $this->loadModel('Product', [
                $photoData,
                '', // no name used
                $description,
                $category,
                $brand,
                $condition,
                $color,
                $size,
                $fabric,
                $user = 1
            ]);

            $productId = $product->save();

            if ($productId) {
                $_SESSION['product_id'] = $productId;
                header('Location: ?c=Route&m=productDetailPage&id=' . $productId);

                exit;
            } else {
                echo "Error saving product. Please try again.";
                exit;
            }
        } else {
            echo "Invalid request!";
            exit;
        }
    }

   public function productDetailPage() {
    session_start();

    // ⬇️ FIX: Cek apakah id ada
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $product = $this->loadModel('Product');
        $productData = $product->getById($id);

        if ($productData) {
            $this->loadView('product_detail', ['product' => $productData]);
        } else {
            echo "Product not found!";
        }
    } else {
        echo "No product ID provided!";
    }
}

public function serveImage() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $db = (new Model())->connect();

        $stmt = $db->prepare("SELECT image_data, image_type FROM product_images WHERE product_id = ?");
        $stmt->execute([$id]);
        $image = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($image && !empty($image['image_data'])) {
            // Clean any output buffering
            while (ob_get_level()) {
                ob_end_clean();
            }

            header("Content-Type: " . $image['image_type']);
            header("Content-Length: " . strlen($image['image_data']));
            echo $image['image_data'];
            exit;
        }
    }

    // Fallback to default image
    $defaultImagePath = __DIR__ . '/../resource/images/default-placeholder.png';
    if (file_exists($defaultImagePath)) {
        while (ob_get_level()) {
            ob_end_clean();
        }

        header("Content-Type: image/png");
        readfile($defaultImagePath);
        exit;
    }

    http_response_code(404);
    echo "Image not found.";
}





    public function saveProduct() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['product_id'])) {
            $price = $_POST['price'];

            $product = $this->loadModel('Product');
            $productId = $_SESSION['product_id'];
            $product->updatePrice($productId, $price);

            // Optionally clear the session product_id if no longer needed
            unset($_SESSION['product_id']);

            header('Location: ?c=Route&m=confirmation');
            exit;
        } else {
            echo "Invalid request!";
            exit;
        }
    }

   public function saveOrder() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $productId = $_POST['product_id'];
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $addressSearch = $_POST['address_search'];
        $fullAddress = $_POST['full_address'];
        $additionalDetails = $_POST['additional_details'];

        // Insert into DB
        $db = (new Model())->connect();
        $stmt = $db->prepare("INSERT INTO orders (product_id, name, phone_number, address_search, full_address, additional_details) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$productId, $name, $phone, $addressSearch, $fullAddress, $additionalDetails]);

        header('Location: ?c=Route&m=shop3'); // redirect to next step
        exit;
    } else {
        echo "Invalid request!";
    }
}

public function editProduct() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $product = $this->loadModel('Product');
        $productData = $product->getById($id);

        if ($productData) {
            $this->loadView('edit_product', ['product' => $productData]);
        } else {
            echo "Product not found.";
        }
    } else {
        echo "No product ID provided.";
    }
}





}
