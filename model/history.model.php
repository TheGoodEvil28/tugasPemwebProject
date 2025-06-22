<?php
class History extends Model
{
    public function getDonations()
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("
            SELECT 
                d.id,
                d.donation_date AS date,
                i.price,
                i.title,
                i.image,
                i.item_condition,
                d.recipient_org,
                d.status
            FROM donations d
            JOIN items i ON d.item_id = i.id
            WHERE d.user_id = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getSales()
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("
            SELECT 
                s.id,
                s.sale_date AS date,
                s.sale_price AS price,
                i.title,
                i.image,
                i.item_condition,
                s.status
            FROM sales s
            JOIN items i ON s.item_id = i.id
            WHERE s.user_id = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getPurchases()
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("
            SELECT 
                p.id,
                p.purchase_date AS date,
                p.purchase_price AS price,
                i.title,
                i.image,
                i.item_condition,
                p.status
            FROM purchases p
            JOIN items i ON p.item_id = i.id
            WHERE p.user_id = ?
        ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}
