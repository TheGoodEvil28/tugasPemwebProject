<?php
class History extends Model
{
    public function getPurchases()
{
    $userId = $this->getActiveAccountId();
    $stmt = $this->db->prepare("
        SELECT 
            o.id,
            o.created_at AS date,
            p.price,
            p.category AS title,
            CONCAT('index.php?c=Route&m=serveImage&id=', p.id) AS image,
            p.condition AS item_condition,
            o.status
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE o.user_id = :user_id
    ");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


    public function getSales()
{
    $userId = $this->getActiveAccountId();
    $stmt = $this->db->prepare("
        SELECT 
            o.id,
            o.created_at AS date,
            p.price,
            p.category AS title,
            CONCAT('index.php?c=Route&m=serveImage&id=', p.id) AS image,
            p.condition AS item_condition,
            o.status
        FROM orders o
        JOIN products p ON o.product_id = p.id
        WHERE p.user = :user_id
    ");
    $stmt->execute(['user_id' => $userId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function deleteProduct($productId)
{
    $this->db->prepare("DELETE FROM product_images WHERE product_id = ?")->execute([$productId]);
    $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
    return $stmt->execute([$productId]);
}

    public function deleteOrder($orderId)
{
    $stmt = $this->db->prepare("DELETE FROM orders WHERE id = ?");
    return $stmt->execute([$orderId]);
}

    public function getDonations()
    {
        // BELUM ADA TABEL donations — return kosong
        return [];
    }
}

