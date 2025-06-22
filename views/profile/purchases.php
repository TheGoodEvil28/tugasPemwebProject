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
                <div class="history-item-link">
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
                </div>
            </div>

            <div class="history-item-actions">
                <button class="action-btn cancel-order <?= $item['status'] === 'delivered' ? 'disabled' : '' ?>"
                    data-modal-target="deleteOrderModal"
                    data-item-id="<?= $item['id'] ?>">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>