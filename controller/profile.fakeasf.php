public function purchases()
{
    $historyModel = $this->loadModel('History');
    $data = [
        'active_tab' => 'purchases',
        'history_items' => $historyModel->getPurchases(),
        ...
    ];
    $this->loadView('profile', $data);
}

public function sales()
{
    $model = $this->loadModel('History');
    $data = [
        'active_tab' => 'sales',
        'history_items' => $model->getSales(),
        ...
    ];
    $this->loadView('profile', $data);
}

public function donation()
{
    $model = $this->loadModel('History');
    $data = [
        'active_tab' => 'donation',
        'history_items' => $model->getDonations(),
    ...
    ];
    $this->loadView('profile', $data);
}