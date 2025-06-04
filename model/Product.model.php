<?php
class Product extends Model {
    

    public $photo, $name, $description, $category, $brand, $condition, $color, $size, $typeFabric, $price, $user;

    public function __construct(
        $photo = null,
        $name = null,
        $description = null,
        $category = null,
        $brand = null,
        $condition = null,
        $color = null,
        $size = null,
        $typeFabric = null,
        $user = null
    ) {
        parent::__construct(); // ✅ Ensures $this->db is set!

        $this->photo = $photo;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->brand = $brand;
        $this->condition = $condition;
        $this->color = $color;
        $this->size = $size;
        $this->typeFabric = $typeFabric;
        $this ->user = $user;
    }

    public function save() {
        $stmt = $this->db->prepare("INSERT INTO products (category, brand, `condition`, color, size, fabric_type, description, created_at, user) VALUES (?, ?, ?, ?, ?, ?, ?,?, NOW())");
        $stmt->execute([
            $this->category,
            $this->brand,
            $this->condition,
            $this->color,
            $this->size,
            $this->typeFabric,
            $this->description,
            $this ->user
        ]);
        $productId = $this->db->lastInsertId();

        if ($this->photo) {
            $imgStmt = $this->db->prepare("INSERT INTO product_images (product_id, image_data, image_type, created_at) VALUES (?, ?, ?, NOW())");
            $imgStmt->bindParam(1, $productId, PDO::PARAM_INT);
            $imgStmt->bindParam(2, $this->photo['data'], PDO::PARAM_LOB);
            $imgStmt->bindParam(3, $this->photo['type'], PDO::PARAM_STR);
            $imgStmt->execute();
        }

        return $productId;
    }

    public function updatePrice($productId, $price) {
        $stmt = $this->db->prepare("UPDATE products SET price = ? WHERE id = ?");
        $stmt->execute([$price, $productId]);
    }

    public function getById($id)
{
    $stmt = $this->db->prepare("SELECT p.*, pi.image_data, pi.image_type FROM products p
                                 LEFT JOIN product_images pi ON p.id = pi.product_id
                                 WHERE p.id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function getAllProducts() {
    $query = "SELECT p.*, pi.id as image_id
              FROM products p
              LEFT JOIN product_images pi ON p.id = pi.product_id";
    $stmt = $this->db->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}
?>
