<?php if (empty($history_items)): ?>
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="fas fa-hands-helping"></i>
        </div>
        <h4>No Donations Yet</h4>
        <p>Your donation history will appear here when you make your first donation.</p>
        <a href="?c=Donate" class="donate-button">
            <i class="fas fa-tshirt"></i> Start Donating
        </a>
    </div>
<?php else: ?>
    <?php foreach ($history_items as $item): ?>
        <a href="?c=Donations&m=detail&id=<?= $item['id'] ?>" class="history-item">
            <img class="history-item-img" src="<?= $item['image'] ?>" alt="<?= $item['title'] ?>">
            <div class="history-item-details">
                <h3><?= $item['title'] ?></h3>
                <p>Donated on <?= date('F j, Y', strtotime($item['date'])) ?></p>
                <div class="donation-info">
                    <span class="status-<?=
                            ($item['status'] === 'received') ? 'done' : 
                            (($item['status'] === 'pending'|'processed') ? 'pending' : 
                            'other')
                            ?>">
                        <?= ucfirst($item['status']) ?>
                    </span>
                    <p class="recipient">
                        To: <?= $item['recipient_org'] ?? 'Unknown Organization' ?>
                    </p>
                </div>
            </div>
            <div class="history-item-price">
                Estimated Value: Rp <?= number_format($item['price'], 0, ',', '.') ?>
            </div>
        </a>
    <?php endforeach; ?>
<?php endif; ?>