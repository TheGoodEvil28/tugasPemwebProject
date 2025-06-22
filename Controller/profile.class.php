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
            // 'xp' => $accountModel->getXP()
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

    public function deleteProduct()
    {
        $id = $_GET['id'] ?? 0;
        $historyModel = $this->loadModel('History');

        if ($historyModel->deleteProduct($id)) {
            $_SESSION['success'] = 'Product deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete product';
        }

        header("Location: ?c=profile&m=sales");
        exit;
    }

    public function deleteOrder()
    {
        $id = $_GET['id'] ?? 0;
        $historyModel = $this->loadModel('History');

        if ($historyModel->deleteOrder($id)) {
            $_SESSION['success'] = 'Order deleted successfully!';
        } else {
            $_SESSION['error'] = 'Failed to delete order';
        }

        header("Location: ?c=profile&m=purchases");
        exit;
    }
}
