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
        <!-- <a href="sale-detail.php?id=<?= $item['id'] ?>" class="history-item"> -->
        <a class="history-item">
            <img class="history-item-img" src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
            <div class="history-item-details">
                <h3><?= $item['title'] ?></h3>
                <p>Sold on <?= date('F j, Y', strtotime($item['date'])) ?></p>
                <span class="status-<?=
                                    ($item['status'] === 'completed') ? 'done' : 
                                    (($item['status'] === 'pending'|'shipped') ? 'pending' : 
                                    'other')
                                    ?>">
                    <?= $item['status'] ?>
                </span>
            </div>
            <div class="history-item-price">
                Rp <?= number_format($item['price'], 0, ',', '.') ?>
            </div>
        </a>
    <?php endforeach; ?>
<?php endif; ?>