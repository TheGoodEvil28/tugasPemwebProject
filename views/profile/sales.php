<?php if (empty($history_items)): ?>
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fas fa-hands-helping"></i>
        </div>
        <h4>No Sales Yet</h4>
        <p>Your sale history will appear here when you make your first sales.</p>
        <a href="sell.php" class="donate-button">
            <i class="fas fa-store"></i> Start Selling
        </a>
    </div>
<?php else: ?>
    <?php foreach ($history_items as $item): ?>
        <div class="history-item">
            <div class="history-item-content">
                <div class="history-item-link">
                    <img class="history-item-img" src="<?= $item['image'] ?? '/public/assets/default-placeholder.png' ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                    <div class="history-item-details">
                        <h3><?= htmlspecialchars($item['title']) ?></h3>
                        <p>Listed on <?= date('F j, Y', strtotime($item['date'])) ?></p>
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
                <button class="action-btn cancel-order <?= ($item['status'] === 'delivered' || $item['status'] === 'pending') ? 'disabled' : '' ?>"
                    data-modal-target="deleteProductModal"
                    data-item-id="<?= $item['id'] ?>">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
