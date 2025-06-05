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
                <a href="?c=Products&m=detail&id=<?= $item['id'] ?>" class="history-item-link">
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
                </a>
            </div>

            <div class="history-item-actions">

                <!-- Update Product button -->
                <a href="?c=Profile&m=updateProduct&id=<?= $item['id'] ?>"
                    class="action-btn view-details <?= $item['sale_status'] !== 'on sale' ? 'disabled' : '' ?>"
                    title="<?= $item['sale_status'] !== 'on sale' ? 'Cannot edit sold products' : 'Edit Product' ?>"
                    <?= $item['sale_status'] !== 'on sale' ? 'onclick="return false;"' : '' ?>>
                    <i class="fas fa-edit"></i>
                </a>

                <!-- Delete Product button -->
                <button class="action-btn cancel-order 
        <?= $item['sale_status'] !== 'on sale' ? 'disabled' : '' ?>"
                    title="<?= $item['sale_status'] !== 'on sale' ? 'Cannot remove sold products' : 'Delete Product' ?>"
                    <?= $item['sale_status'] !== 'on sale' ? 'disabled' : '' ?>
                    data-modal-target="deleteModal-<?= $item['id'] ?>">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>

            <!-- Delete Product Confirmation Modal -->
            <div class="cancel-modal" id="deleteModal-<?= $item['id'] ?>">
                <div class="modal-center-helper">
                    <div class="modal-content">
                        <h3>Confirm Delete</h3>
                        <p>Are you sure you want to permanently delete this product?</p>
                        <div class="modal-buttons">
                            <button class="modal-cancel">No, Keep Product</button>
                            <a href="?c=Products&m=delete&id=<?= $item['id'] ?>" class="modal-confirm">Yes, Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>