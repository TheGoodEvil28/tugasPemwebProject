<?php
class Product extends Model
{
    public function getProductById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function updateProduct($id, $data)
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("
            UPDATE products 
            SET category = ?, brand = ?, `condition` = ?, 
                color = ?, size = ?, fabric_type = ?, 
                description = ?, price = ? 
            WHERE id = ? AND user_id = ?
        ");

        $stmt->bind_param(
            "sssssssdii",
            $data['category'],
            $data['brand'],
            $data['condition'],
            $data['color'],
            $data['size'],
            $data['fabric_type'],
            $data['description'],
            $data['price'],
            $id,
            $userId
        );

        return $stmt->execute();
    }

    public function deleteProduct($id)
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $userId);
        return $stmt->execute();
    }
}
