<?php

// model/Product.model.php
// model/Product.model.php
class Product extends Model
{
    public function update($productId, $updateData)
    {
        $validFields = [
            'title',
            'price',
            'category',
            'brand',
            'condition',
            'color',
            'size',
            'fabric_type',
            'description'
        ];

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

        $values[] = $productId;
        $types .= 'i';

        $sql = "UPDATE products SET " . implode(', ', $setClauses) . " WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param($types, ...$values);
        return $stmt->execute();
    }

    public function getById($productId)
    {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
