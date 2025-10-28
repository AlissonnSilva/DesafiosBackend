<?php 
// app/Discount/Strategies/VipDiscount.php

namespace App\Discount\Strategies;

use App\Discount\DiscountStrategy;

class VipDiscount implements DiscountStrategy
{
    // Regra: 5% + R$ 5,00 fixos, mas só se o pedido for maior que R$ 100
    public function calculate(float $orderAmount): float
    {
        if ($orderAmount > 100) {
            return ($orderAmount * 0.05) + 5.00;
        }
        return 0.00;
    }
}
