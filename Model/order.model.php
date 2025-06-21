<?php
// model/Order.model.php
class Order extends Model
{
    public function updateOrder($orderId, $updateData)
    {
        $validFields = ['name', 'phone_number', 'address_search', 'full_address', 'additional_details'];
        $setClauses = [];
        $types = '';
        $values = [];

        foreach ($updateData as $key => $value) {
            if (in_array($key, $validFields)) {
                $setClauses[] = "`$key` = ?";
                $types .= 's';
                $values[] = $value;
            }
        }

        if (empty($setClauses)) return false;

        $values[] = $orderId;
        $types .= 'i';

        $sql = "UPDATE orders SET " . implode(', ', $setClauses) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    public function getById($orderId)
    {
        $stmt = $this->db->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->bind_param("i", $orderId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
