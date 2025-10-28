<?php 
// app/Discount/Strategies/VipDiscount.php

namespace App\Discount\Strategies;

use App\Discount\DiscountStrategy;
use Illuminate\Http\JsonResponse;
class SeasonalDiscount implements DiscountStrategy
{
    // Regra: R$45 de desconto em pedidos acima de R$ 300 durante a temporada
    public function calculate(float $orderAmount): float
    {
        if ($orderAmount > 300) {
            return $orderAmount - 45.00;
        }
        return $orderAmount - 10.00;

    }
}