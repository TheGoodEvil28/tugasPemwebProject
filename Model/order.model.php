<?php
class Order extends Model
{
    public function getOrderById($id)
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("
            SELECT o.*, p.description AS product_title, p.price
            FROM orders o
            JOIN products p ON o.product_id = p.id
            WHERE o.id = ? AND o.user_id = ?
        ");
        $stmt->bind_param("ii", $id, $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateOrder($id, $data)
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("
            UPDATE orders 
            SET name = ?, phone_number = ?, 
                address_search = ?, full_address = ?, 
                additional_details = ?
            WHERE id = ? AND user_id = ?
        ");

        $stmt->bind_param(
            "sssssii",
            $data['name'],
            $data['phone_number'],
            $data['address_search'],
            $data['full_address'],
            $data['additional_details'],
            $id,
            $userId
        );

        return $stmt->execute();
    }
}
