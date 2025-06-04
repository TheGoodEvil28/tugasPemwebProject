<?php
class Product {
    public $photo;
    public $name;
    public $description;
    public $category;
    public $brand;
    public $condition;
    public $color;
    public $size;
    public $typeFabric;
    public $price;

    public function __construct($photo, $name, $description, $category, $brand, $condition, $color, $size, $typeFabric) {
        $this->photo = $photo;
        $this->name = $name;
        $this->description = $description;
        $this->category = $category;
        $this->brand = $brand;
        $this->condition = $condition;
        $this->color = $color;
        $this->size = $size;
        $this->typeFabric = $type;
    }
}
?>