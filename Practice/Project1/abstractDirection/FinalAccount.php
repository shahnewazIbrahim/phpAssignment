<?php 

namespace abstractDirection;
use abstractDirection\Profit;
// require'Profit.php';

class FinalAccount extends Profit {
    private $quantity = 0;
    private float $price = 0.00;

    public function __construct($quantity = 0, $price = 0.00) 
    {
        $this->quantity = $quantity;
        $this->price = $price;
        echo"done";
    }
    public function totalRevenue():float{}
    public function totalSale():int{}
    public function averagePrice():float{}
}

// $finalAccount = new FinalAccount();