<?php
class Product{
    // id (integer type) : the unique identifier of the product
    public $id;
    //  name (string type): the name of the product
    public $name;
    // price (float type): the price of the product
    public $price;

    public function __construct($id,$name = null, $price = 0) 
    {
        $this->id = (int) $id;
        $this->name = (string) $name;
        $this->price = $price;
    }

    public function getFormattedPrice() {
        $formatted_price = number_format($this->price, 2);
        return $formatted_price;
    }
    public function showDetails() {
        echo "Product Details:\n";
        echo "- ID: {$this->id}\n";
        echo "- Name: {$this->name}\n";
        echo "- Price: $". "{$this->getFormattedPrice()}\n";
    }
}

$product = new Product(1,"T-shirt", 19.99 );
$product->showDetails();
