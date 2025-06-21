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

    public function updateOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = $_POST['order_id'] ?? null;

            // Only allow updates for non-delivered orders
            $currentOrder = $this->getOrderDetails($orderId);
            if ($currentOrder && $currentOrder['status'] !== 'delivered') {
                $updateData = [
                    'name' => $_POST['name'] ?? '',
                    'phone_number' => $_POST['phone_number'] ?? '',
                    'address_search' => $_POST['address_search'] ?? '',
                    'full_address' => $_POST['full_address'] ?? '',
                    'additional_details' => $_POST['additional_details'] ?? ''
                ];

                $orderModel = $this->loadModel('Order');
                if ($orderModel->updateOrder($orderId, $updateData)) {
                    $_SESSION['success'] = "Order updated successfully!";
                } else {
                    $_SESSION['error'] = "Failed to update order";
                }
            } else {
                $_SESSION['error'] = "Cannot update delivered orders";
            }
        }
        header("Location: ?c=Profile&m=purchases");
    }

    private function getOrderDetails($orderId)
    {
        $orderModel = $this->loadModel('Order');
        return $orderModel->getById($orderId);
    }

    // In ProfileController.php
    // In ProfileController.php
    public function updateProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;

            // Only allow updates for products that are still on sale
            $productModel = $this->loadModel('Product');
            $currentProduct = $productModel->getById($productId);

            if ($currentProduct) {
                $updateData = [
                    'title' => $_POST['title'] ?? '',
                    'price' => $_POST['price'] ?? 0,
                    'category' => $_POST['category'] ?? '',
                    'brand' => $_POST['brand'] ?? '',
                    'condition' => $_POST['condition'] ?? '',
                    'color' => $_POST['color'] ?? '',
                    'size' => $_POST['size'] ?? '',
                    'fabric_type' => $_POST['fabric_type'] ?? '',
                    'description' => $_POST['description'] ?? ''
                ];

                if ($productModel->update($productId, $updateData)) {
                    $_SESSION['success'] = "Product updated successfully!";
                } else {
                    $_SESSION['error'] = "Failed to update product";
                }
            } else {
                $_SESSION['error'] = "Product not found";
            }
        }
        header("Location: ?c=Profile&m=sales");
    }
}
