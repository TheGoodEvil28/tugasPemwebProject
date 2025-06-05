<?php
class Profile extends Controller
{

    private function getProfileStats()
    {
        $historyModel = $this->loadModel('History');
        $accountModel = $this->loadModel('Account');

        return [
            'purchases' => count($historyModel->getPurchases()),
            'sales' => count($historyModel->getSales()),
            // 'donations' => count($historyModel->getDonations()),
            'xp' => $accountModel->getXP()
        ];
    }

    public function index()
    {
        header("Location:?c=profile&m=purchases");
    }

    public function purchases()
    {
        $historyModel = $this->loadModel('History');
        $data = [
            'active_tab' => 'purchases',
            'history_items' => $historyModel->getPurchases(),
            'user' => $this->loadModel('Account')->getUserProfile(),
            'stats' => $this->getProfileStats()
        ];
        $this->loadView('profile', $data);
    }

    public function sales()
    {
        $model = $this->loadModel('History');
        $data = [
            'active_tab' => 'sales',
            'history_items' => $model->getSales(),
            'user' => $this->loadModel('Account')->getUserProfile(),
            'stats' => $this->getProfileStats()
        ];
        $this->loadView('profile', $data);
    }


    public function edit()
    {
        // Only show edit form
        $model = $this->loadModel('account');
        $this->loadView('editProfile', [
            'user' => $model->getUserProfile()
        ]);
    }

    public function update()
    {
        $model = $this->loadModel('Account');
        $currentData = $model->getUserProfile();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updateData = [
                'display_name' => $_POST['display_name'] ?? $currentData['display_name'],
                'email' => $_POST['email'] ?? $currentData['email'],
                'phone' => $_POST['phone'] ?? $currentData['phone'],
                'profile_picture' => $_POST['profile_picture'] ?? $currentData['profile_picture']
            ];

            if ($model->updateProfile($updateData)) {
                $messages['success'] = 'Profile updated successfully!';
                $currentData = array_merge($currentData, $updateData);
            } else {
                $messages['error'] = 'Failed to update profile';
            }
        }

        header("Location:?c=profile&m=edit");
    }



    public function viewProduct()
    {
        $productId = $_GET['id'] ?? 0;
        $productModel = $this->loadModel('Product');

        // Get product details and image
        $product = $productModel->getProductWithImage($productId);

        if (!$product) {
            header("Location: ?c=profile&m=sales");
            exit;
        }

        $this->loadView('productDetail', [
            'product' => $product,
            'image' => $product['image_url'] ?? 'public/assets/default-product.jpg'
        ]);
    }
    public function updateProduct()
    {
        $id = $_GET['id'] ?? 0;
        $productModel = $this->loadModel('Product');
        $product = $productModel->getProductById($id);

        if (!$product) {
            header("Location: ?c=profile&m=sales");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updateData = [
                'category' => $_POST['category'],
                'brand' => $_POST['brand'],
                'condition' => $_POST['condition'],
                'color' => $_POST['color'],
                'size' => $_POST['size'],
                'fabric_type' => $_POST['fabric_type'],
                'description' => $_POST['description'],
                'price' => (float)$_POST['price']
            ];

            if ($productModel->updateProduct($id, $updateData)) {
                $_SESSION['success'] = 'Product updated successfully!';
                header("Location: ?c=profile&m=sales");
                exit;
            } else {
                $error = 'Failed to update product';
            }
        }

        $this->loadView('updateProduct', [
            'product' => $product,
            'error' => $error ?? null
        ]);
    }

    public function deleteProduct()
    {
        $id = $_GET['id'] ?? 0;
        $productModel = $this->loadModel('Product');

        if ($productModel->deleteProduct($id)) {
            $_SESSION['success'] = 'Product deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete product';
        }

        header("Location: ?c=profile&m=sales");
        exit;
    }

    public function updateOrder()
    {
        $orderId = $_GET['id'] ?? 0;
        $orderModel = $this->loadModel('Order');
        $order = $orderModel->getOrderById($orderId);

        if (!$order) {
            header("Location: ?c=profile&m=purchases");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $updateData = [
                'name' => $_POST['name'],
                'phone_number' => $_POST['phone_number'],
                'address_search' => $_POST['address_search'],
                'full_address' => $_POST['full_address'],
                'additional_details' => $_POST['additional_details']
            ];

            if ($orderModel->updateOrder($orderId, $updateData)) {
                $_SESSION['success'] = 'Order updated successfully!';
                header("Location: ?c=profile&m=purchases");
                exit;
            } else {
                $error = 'Failed to update order';
            }
        }

        $this->loadView('updateOrder', [
            'order' => $order,
            'error' => $error ?? null
        ]);
    }
}
