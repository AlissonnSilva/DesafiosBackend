<?php

// app/Discount/DiscountStrategy.php

namespace App\Discount;

interface DiscountStrategy
{
/**

* Calcula o desconto.
*
* @param float $orderAmount O valor total do pedido.
* @return float O valor do desconto a ser aplicado.
*/
public function calculate(float $orderAmount): float;
}