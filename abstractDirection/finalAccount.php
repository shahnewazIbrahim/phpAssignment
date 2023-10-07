<?php 

namespace abstractDirection;
use abstractDirection\Profit;
require'./Practice/Project1/public/index.php';
require'Profit.php';

class FinalAccount extends Profit {
    public function totalRevenue():float{
        
    }
    public function totalSale():int{}
    public function averagePrice():float{}
}

new FinalAccount();