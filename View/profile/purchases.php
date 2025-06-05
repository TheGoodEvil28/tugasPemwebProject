<?php if (empty($history_items)): ?>
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fas fa-shopping-bag"></i>
        </div>
        <h4>No Purchases Yet</h4>
        <p>Your purchase history will appear here when you make your first purchase.</p>
        <a href="?c=Shop" class="donate-button">
            <i class="fas fa-shopping-cart"></i> Start Shopping
        </a>
    </div>
<?php else: ?>
    <?php foreach ($history_items as $item): ?>
        <div class="history-item">
            <div class="history-item-content">
                <a href="?c=Products&m=detail&id=<?= $item['id'] ?>" class="history-item-link">
                    <img class="history-item-img" src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
                    <div class="history-item-details">
                        <h3><?= $item['title'] ?></h3>
                        <p>Purchased on <?= date('F j, Y', strtotime($item['date'])) ?></p>
                        <span class="status-<?= $item['status'] === 'delivered' ? 'done' : 'pending' ?>">
                            <?= ucfirst($item['status']) ?>
                        </span>
                    </div>
                    <div class="history-item-price">
                        Rp <?= number_format($item['price'], 0, ',', '.') ?>
                    </div>
                </a>
            </div>

            <div class="history-item-actions">
                <!-- View Details button -->
                <a href="?c=Profile&m=viewProduct&id=<?= $item['id'] ?>" class="action-btn view-details" title="Product Details">
                    <i class="fas fa-eye"></i>
                </a>

                <!-- Update Order button -->
                <a href="<?= $item['status'] !== 'delivered' ? '?c=profile&m=updateOrder&id=' . $item['id'] : 'javascript:void(0);' ?>"
                    class="action-btn view-details <?= $item['status'] === 'delivered' ? 'disabled' : '' ?>"
                    title="<?= $item['status'] === 'delivered' ? 'Cannot update delivered orders' : 'Update Order' ?>"
                    <?= $item['status'] === 'delivered' ? 'onclick="return false;"' : '' ?>>
                    <i class="fas fa-edit"></i>
                </a>

                <!-- Delete Order button -->
                <button class="action-btn cancel-order 
                <?= $item['status'] === 'delivered' ? 'disabled' : '' ?>"
                    title="<?= $item['status'] === 'delivered' ? 'Cannot delete delivered orders' : 'Delete Order' ?>"
                    <?= $item['status'] === 'delivered' ? 'disabled' : '' ?>
                    data-modal-target="deleteModal-<?= $item['id'] ?>">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>

            <!-- Delete Order Confirmation Modal -->
            <div class="cancel-modal" id="deleteModal-<?= $item['id'] ?>">
                <div class="modal-center-helper">
                    <div class="modal-content">
                        <h3>Confirm Delete</h3>
                        <p>Are you sure you want to permanently delete this order?</p>
                        <div class="modal-buttons">
                            <button class="modal-cancel">No, Keep Order</button>
                            <a href="?c=Orders&m=delete&id=<?= $item['id'] ?>" class="modal-confirm">Yes, Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>