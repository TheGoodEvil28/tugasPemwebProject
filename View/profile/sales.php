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
                    <img class="history-item-img" src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
                    <div class="history-item-details">
                        <h3><?= $item['title'] ?></h3>
                        <?php if ($item['sale_status'] === 'sold'): ?>
                            <p>Sold on <?= date('F j, Y', strtotime($item['date'])) ?></p>
                        <?php else: ?>
                            <p>Listed on <?= date('F j, Y', strtotime($item['product_created_at'])) ?></p>
                        <?php endif; ?>
                        <span class="status-<?=
                                            ($item['sale_status'] === 'sold' && $item['status'] === 'delivered') ? 'done' : 'pending'
                                            ?>">
                            <?= $item['sale_status'] === 'sold' ? ucfirst($item['status']) : 'On sale' ?>
                        </span>
                    </div>
                    <div class="history-item-price">
                        Rp <?= number_format($item['price'], 0, ',', '.') ?>
                    </div>
                </div>
            </div>

            <div class="history-item-actions">
                <button class="action-btn cancel-order"
                    data-modal-target="deleteProductModal"
                    data-item-id="<?= $item['id'] ?>">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>


        </div>
    <?php endforeach; ?>
<?php endif; ?>