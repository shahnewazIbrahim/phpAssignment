<?php 
namespace abstractDirection;
abstract class Profit { 
    abstract public function totalRevenue() : float ;
    abstract public function totalSale():int; 
    abstract public function averagePrice():float; 
}

