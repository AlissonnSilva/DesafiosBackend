<?php

// app/Discount/Strategies/FixedDiscount.php

namespace App\Discount\Strategies;

use App\Discount\DiscountStrategy;

class FixedDiscount implements DiscountStrategy
{
private float $fixedValue = 10.00; // Desconto de R$ 10,00

public function calculate(float $orderAmount): float
{
// Aplica o desconto fixo, garantindo que não seja maior que o pedido
return min($this->fixedValue, $orderAmount);
}
}