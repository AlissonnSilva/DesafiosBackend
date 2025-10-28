<?php

// app/Discount/Strategies/PercentageDiscount.php

namespace App\Discount\Strategies;

use App\Discount\DiscountStrategy;

class PercentageDiscount implements DiscountStrategy
{
    private float $percentage = 0.15; // 15% de desconto

    public function calculate(float $orderAmount): float
    {
        return $orderAmount * $this->percentage;
    }
}
