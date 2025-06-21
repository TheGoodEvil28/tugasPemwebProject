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
                <!-- View/Update Button -->
                <button class="action-btn view-update 
                    <?= $item['sale_status'] !== 'on sale' ? 'disabled' : '' ?>"
                    title="<?= $item['sale_status'] !== 'on sale' ? 'Cannot edit sold products' : 'View/Update Product' ?>"
                    <?= $item['sale_status'] !== 'on sale' ? 'disabled' : '' ?>
                    data-modal-target="viewUpdateModal-<?= $item['id'] ?>">
                    <i class="fas fa-eye"></i>
                </button>

                <!-- Delete Product button -->
                <button class="action-btn cancel-order 
                    <?= $item['sale_status'] !== 'on sale' ? 'disabled' : '' ?>"
                    title="<?= $item['sale_status'] !== 'on sale' ? 'Cannot remove sold products' : 'Delete Product' ?>"
                    <?= $item['sale_status'] !== 'on sale' ? 'disabled' : '' ?>
                    data-modal-target="deleteModal-<?= $item['id'] ?>">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>

            <!-- View/Update Product Modal -->
            <div class="cancel-modal" id="viewUpdateModal-<?= $item['id'] ?>">
                <div class="modal-center-helper" onclick="event.stopPropagation()">
                    <div class="modal-content" onclick="event.stopPropagation()">
                        <button class="modal-close" data-modal-close="viewUpdateModal-<?= $item['id'] ?>">&times;</button>

                        <div class="modal-body-container">
                            <h3>Product Information</h3>

                            <form method="POST" action="?c=Profile&m=updateProduct">
                                <input type="hidden" name="product_id" value="<?= $item['id'] ?>">

                                <!-- Product Status -->
                                <div class="form-group">
                                    <label>Product Status</label>
                                    <div class="readonly-value status-<?=
                                                                        ($item['sale_status'] === 'sold' && $item['status'] === 'delivered') ? 'done' : 'pending'
                                                                        ?>">
                                        <?= $item['sale_status'] === 'sold' ? 'Sold' : 'On Sale' ?>
                                    </div>
                                </div>

                                <!-- Product Image -->
                                <div class="form-group">
                                    <label>Product Image</label>
                                    <img src="<?= $item['image'] ?>" class="modal-product-img">
                                </div>

                                <!-- Product Details -->
                                <div class="bento-grid">
                                    <div class="bento-item">
                                        <label for="title-<?= $item['id'] ?>" class="bento-label">Title</label>
                                        <input type="text" id="title-<?= $item['id'] ?>" name="title"
                                            class="form-control" value="<?= htmlspecialchars($item['title'] ?? '') ?>"
                                            <?= $item['sale_status'] === 'sold' ? 'readonly' : '' ?>>
                                    </div>

                                    <div class="bento-item">
                                        <label for="price-<?= $item['id'] ?>" class="bento-label">Price</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" id="price-<?= $item['id'] ?>" name="price"
                                                class="form-control" value="<?= $item['price'] ?? 0 ?>"
                                                <?= $item['sale_status'] === 'sold' ? 'readonly' : '' ?>>
                                        </div>
                                    </div>

                                    <div class="bento-item">
                                        <label for="category-<?= $item['id'] ?>" class="bento-label">Category</label>
                                        <input type="text" id="category-<?= $item['id'] ?>" name="category"
                                            class="form-control" value="<?= htmlspecialchars($item['category'] ?? '') ?>"
                                            <?= $item['sale_status'] === 'sold' ? 'readonly' : '' ?>>
                                    </div>

                                    <div class="bento-item">
                                        <label for="brand-<?= $item['id'] ?>" class="bento-label">Brand</label>
                                        <input type="text" id="brand-<?= $item['id'] ?>" name="brand"
                                            class="form-control" value="<?= htmlspecialchars($item['brand'] ?? '') ?>"
                                            <?= $item['sale_status'] === 'sold' ? 'readonly' : '' ?>>
                                    </div>

                                    <div class="bento-item">
                                        <label for="condition-<?= $item['id'] ?>" class="bento-label">Condition</label>
                                        <select id="condition-<?= $item['id'] ?>" name="condition"
                                            class="form-select"
                                            <?= $item['sale_status'] === 'sold' ? 'disabled' : '' ?>>
                                            <option value="New" <?= ($item['item_condition'] ?? '') === 'New' ? 'selected' : '' ?>>New</option>
                                            <option value="Like New" <?= ($item['item_condition'] ?? '') === 'Like New' ? 'selected' : '' ?>>Like New</option>
                                            <option value="Good" <?= ($item['item_condition'] ?? '') === 'Good' ? 'selected' : '' ?>>Good</option>
                                            <option value="Fair" <?= ($item['item_condition'] ?? '') === 'Fair' ? 'selected' : '' ?>>Fair</option>
                                        </select>
                                    </div>

                                    <div class="bento-item">
                                        <label for="color-<?= $item['id'] ?>" class="bento-label">Color</label>
                                        <input type="text" id="color-<?= $item['id'] ?>" name="color"
                                            class="form-control" value="<?= htmlspecialchars($item['color'] ?? '') ?>"
                                            <?= $item['sale_status'] === 'sold' ? 'readonly' : '' ?>>
                                    </div>

                                    <div class="bento-item">
                                        <label for="size-<?= $item['id'] ?>" class="bento-label">Size</label>
                                        <input type="text" id="size-<?= $item['id'] ?>" name="size"
                                            class="form-control" value="<?= htmlspecialchars($item['size'] ?? '') ?>"
                                            <?= $item['sale_status'] === 'sold' ? 'readonly' : '' ?>>
                                    </div>

                                    <div class="bento-item">
                                        <label for="fabric_type-<?= $item['id'] ?>" class="bento-label">Fabric Type</label>
                                        <input type="text" id="fabric_type-<?= $item['id'] ?>" name="fabric_type"
                                            class="form-control" value="<?= htmlspecialchars($item['fabric_type'] ?? '') ?>"
                                            <?= $item['sale_status'] === 'sold' ? 'readonly' : '' ?>>
                                    </div>

                                    <div class="bento-item full-width">
                                        <label for="description-<?= $item['id'] ?>" class="bento-label">Description</label>
                                        <textarea id="description-<?= $item['id'] ?>" name="description"
                                            class="form-control" rows="3"
                                            <?= $item['sale_status'] === 'sold' ? 'readonly' : '' ?>><?=
                                                                                                        htmlspecialchars($item['description'] ?? '')
                                                                                                        ?></textarea>
                                    </div>
                                </div>

                                <div class="form-buttons">
                                    <button type="button" class="btn btn-outline-secondary modal-close" data-modal-close="viewUpdateModal-<?= $item['id'] ?>">Close</button>
                                    <?php if ($item['sale_status'] !== 'sold'): ?>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save me-2"></i> Save Changes
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Product Confirmation Modal -->
            <div class="cancel-modal" id="deleteModal-<?= $item['id'] ?>">
                <div class="modal-center-helper">
                    <div class="modal-content">
                        <button class="modal-close" data-modal-close="deleteModal-<?= $item['id'] ?>">&times;</button>
                        <h3>Confirm Delete</h3>
                        <p>Are you sure you want to permanently delete this product?</p>
                        <div class="modal-buttons">
                            <button class="modal-cancel" data-modal-close="deleteModal-<?= $item['id'] ?>">No, Keep Product</button>
                            <a href="?c=Products&m=delete&id=<?= $item['id'] ?>" class="modal-confirm">Yes, Delete</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>