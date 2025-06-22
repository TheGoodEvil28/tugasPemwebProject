<?php
class History extends Model
{
    public function getSales()
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("
           SELECT 
            p.id,  
            COALESCE(o.created_at, p.created_at) AS date,
            p.price,
            p.description AS title,
            pi.image_data,
            pi.image_type,
            p.condition AS item_condition,
            COALESCE(o.status, 'on sale') AS status,
            p.created_at AS product_created_at,
            CASE 
                WHEN o.id IS NOT NULL THEN 'sold'
                ELSE 'on sale'
            END AS sale_status
        FROM products p
        LEFT JOIN orders o ON p.id = o.product_id
        LEFT JOIN (
            SELECT product_id, image_data, image_type 
            FROM product_images 
            WHERE id IN (
                SELECT MIN(id) 
                FROM product_images 
                GROUP BY product_id
            )
        ) pi ON p.id = pi.product_id
        WHERE p.user_id = ?
        GROUP BY p.id
    ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $sales = $result->fetch_all(MYSQLI_ASSOC);

        // Convert image data to base64
        foreach ($sales as &$sale) {
            if ($sale['image_data']) {
                $sale['image'] = 'data:' . $sale['image_type'] . ';base64,' . base64_encode($sale['image_data']);
            } else {
                $sale['image'] = null;
            }
            unset($sale['image_data'], $sale['image_type']);
        }

        return $sales;
    }

    public function getPurchases()
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("
        SELECT 
            o.id,
            o.created_at AS date,
            p.price,
            p.description AS title,
            pi.image_data,
            pi.image_type,
            p.condition AS item_condition,
            o.status
        FROM orders o
        JOIN products p ON o.product_id = p.id
        LEFT JOIN (
            SELECT product_id, image_data, image_type 
            FROM product_images 
            WHERE id IN (
                SELECT MIN(id) 
                FROM product_images 
                GROUP BY product_id
            )
        ) pi ON p.id = pi.product_id
        WHERE o.user_id = ?
    ");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $purchases = $result->fetch_all(MYSQLI_ASSOC);

        // Convert image data to base64
        foreach ($purchases as &$purchase) {
            if ($purchase['image_data']) {
                $purchase['image'] = 'data:' . $purchase['image_type'] . ';base64,' . base64_encode($purchase['image_data']);
            } else {
                $purchase['image'] = null;
            }
            unset($purchase['image_data'], $purchase['image_type']);
        }

        return $purchases;
    }






    public function deleteProduct($id)
    {
        $userId = $this->getActiveAccountId();
        
        // First delete product images
        $stmt = $this->db->prepare("DELETE FROM product_images WHERE product_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Then delete the product
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $userId);
        return $stmt->execute();
    }

    public function deleteOrder($id)
    {
        $userId = $this->getActiveAccountId();
        $stmt = $this->db->prepare("DELETE FROM orders WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $id, $userId);
        return $stmt->execute();
    }
}
