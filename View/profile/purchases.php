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
                <!-- View/Update Button -->
                <button class="action-btn view-details <?= $item['status'] === 'delivered' ? 'disabled' : '' ?>"
                    data-modal-target="viewUpdateModal-<?= $item['id'] ?>"
                    title="View Details & Update">
                    <i class="fas fa-eye"></i>
                </button>

                <!-- Delete Order Button -->
                <button class="action-btn cancel-order 
                    <?= $item['status'] === 'delivered' ? 'disabled' : '' ?>"
                    title="<?= $item['status'] === 'delivered' ? 'Cannot delete delivered orders' : 'Delete Order' ?>"
                    <?= $item['status'] === 'delivered' ? 'disabled' : '' ?>
                    data-modal-target="deleteModal-<?= $item['id'] ?>">
                    <i class="fas fa-trash-alt"></i>
                </button>
            </div>

            <div class="cancel-modal" id="viewUpdateModal-<?= $item['original_id'] ?>">
                <div class="modal-center-helper" onclick="event.stopPropagation()">
                    <div class="modal-content" onclick="event.stopPropagation()">
                        <button class="modal-close">&times;</button>

                        <div class="modal-body-container">
                            <div class="modal-columns">
                                <!-- Product Section -->
                                <div class="product-details">
                                    <div class="section-header" onclick="toggleProductDetails(this)">
                                        <h3>
                                            <i class="fas fa-box-open me-2"></i> Product Information
                                            <i class="fas fa-chevron-down toggle-icon"></i>
                                        </h3>
                                    </div>

                                    <div class="collapsible-content">
                                        <img src="<?= $item['image'] ?>" class="modal-product-img"
                                            <div class="bento-grid">
                                        <div class="bento-item">
                                            <div class="bento-label">Description</div>
                                            <div class="bento-value"><?= htmlspecialchars($item['full_description'] ?? '') ?></div>
                                        </div>
                                        <div class="bento-item">
                                            <div class="bento-label">Category</div>
                                            <div class="bento-value"><?= htmlspecialchars($item['category'] ?? '') ?></div>
                                        </div>
                                        <div class="bento-item">
                                            <div class="bento-label">Brand</div>
                                            <div class="bento-value"><?= htmlspecialchars($item['brand'] ?? '') ?></div>
                                        </div>
                                        <div class="bento-item">
                                            <div class="bento-label">Condition</div>
                                            <div class="bento-value"><?= htmlspecialchars($item['item_condition'] ?? '') ?></div>
                                        </div>
                                        <div class="bento-item">
                                            <div class="bento-label">Color</div>
                                            <div class="bento-value"><?= htmlspecialchars($item['color'] ?? '') ?></div>
                                        </div>
                                        <div class="bento-item">
                                            <div class="bento-label">Size</div>
                                            <div class="bento-value"><?= htmlspecialchars($item['size'] ?? '') ?></div>
                                        </div>
                                        <div class="bento-item">
                                            <div class="bento-label">Fabric</div>
                                            <div class="bento-value"><?= htmlspecialchars($item['fabric_type'] ?? '') ?></div>
                                        </div>
                                        <div class="bento-item">
                                            <div class="bento-label">Listed Date</div>
                                            <div class="bento-value"><?= date('M d, Y', strtotime($item['product_listed_date'] ?? 'now')) ?></div>
                                        </div>
                                        <div class="bento-item">
                                            <div class="bento-label">Price</div>
                                            <div class="bento-value">Rp <?= number_format($item['original_price'] ?? 0, 0, ',', '.') ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Section -->
                            <div class="order-details">
                                <div class="section-header">
                                    <h3>
                                        <i class="fas fa-truck me-2"></i> Order Information
                                    </h3>
                                </div>

                                <form method="POST" action="?c=Profile&m=updateOrder">
                                    <input type="hidden" name="order_id" value="<?= $item['original_id'] ?>">

                                    <div class="form-group">
                                        <label>Order Status</label>
                                        <div class="readonly-value status-<?= $item['original_status'] === 'delivered' ? 'done' : 'pending' ?>">
                                            <?= ucfirst($item['original_status']) ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="name-<?= $item['original_id'] ?>">Recipient Name</label>
                                        <input type="text" id="name-<?= $item['original_id'] ?>" name="name"
                                            class="form-control" value="<?= htmlspecialchars($item['recipient_name'] ?? '') ?>"
                                            <?= $item['original_status'] === 'delivered' ? 'readonly' : '' ?>>
                                    </div>

                                    <div class="form-group">
                                        <label for="phone-<?= $item['original_id'] ?>">Phone Number</label>
                                        <input type="text" id="phone-<?= $item['original_id'] ?>" name="phone_number"
                                            class="form-control" value="<?= htmlspecialchars($item['phone_number'] ?? '') ?>"
                                            <?= $item['original_status'] === 'delivered' ? 'readonly' : '' ?>>
                                    </div>

                                    <div class="form-group">
                                        <label for="address_search-<?= $item['original_id'] ?>">Address Search</label>
                                        <input type="text" id="address_search-<?= $item['original_id'] ?>" name="address_search"
                                            class="form-control" value="<?= htmlspecialchars($item['address_search'] ?? '') ?>"
                                            <?= $item['original_status'] === 'delivered' ? 'readonly' : '' ?>>
                                    </div>

                                    <div class="form-group">
                                        <label for="full_address-<?= $item['original_id'] ?>">Full Address</label>
                                        <textarea id="full_address-<?= $item['original_id'] ?>" name="full_address"
                                            class="form-control" rows="3"
                                            <?= $item['original_status'] === 'delivered' ? 'readonly' : '' ?>><?=
                                                                                                                htmlspecialchars($item['full_address'] ?? '')
                                                                                                                ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="additional_details-<?= $item['original_id'] ?>">Additional Details</label>
                                        <textarea id="additional_details-<?= $item['original_id'] ?>" name="additional_details"
                                            class="form-control" rows="2"
                                            <?= $item['original_status'] === 'delivered' ? 'readonly' : '' ?>><?=
                                                                                                                htmlspecialchars($item['shipping_notes'] ?? '')
                                                                                                                ?></textarea>
                                    </div>

                                    <div class="form-buttons">
                                        <button type="button" class="btn btn-outline-secondary modal-close">Cancel</button>
                                        <?php if ($item['original_status'] !== 'delivered'): ?>
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
            </div>
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