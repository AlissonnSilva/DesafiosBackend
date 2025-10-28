<?php

// app/Services/OrderService.php

namespace App\Services;

use App\Discount\DiscountContext;
use App\Discount\Strategies\PercentageDiscount;
use App\Discount\Strategies\FixedDiscount;
use App\Discount\Strategies\VipDiscount;
use App\Discount\DiscountStrategy;
use App\Discount\Strategies\SeasonalDiscount;

class OrderService
{
    protected DiscountContext $discountContext;

    // Injeta o Contexto
    public function __construct(DiscountContext $discountContext)
    {
        $this->discountContext = $discountContext;
    }

    /**
     * Processa o pedido aplicando a regra de desconto definida.
     *
     * @param float $orderAmount
     * @param string $discountType ('fixed', 'percentage', 'vip')
     * @return array
     */
    public function processOrder(float $orderAmount, string $discountType): array
    {
        // 1. Lógica para escolher a Strategy (Poderia vir de um Factory ou mapeamento)
        $strategy = $this->getStrategyInstance($discountType);

        // 2. O Contexto recebe a Strategy em tempo de execução
        $this->discountContext->setStrategy($strategy);

        // 3. O Contexto calcula o desconto
        $discountAmount = $this->discountContext->calculateDiscount($orderAmount);

        $finalAmount = $orderAmount - $discountAmount;

        return [
            'original_amount' => $orderAmount,
            'discount_type' => $discountType,
            'discount_amount' => round($discountAmount, 2),
            'final_amount' => round($finalAmount, 2),
        ];
    }

    /**
     * Mapeia o tipo de string para a Strategy concreta (poderia ser uma Factory)
     * @throws \InvalidArgumentException
     */
    private function getStrategyInstance(string $type): DiscountStrategy
    {
        return match (strtolower($type)) {
            'fixed' => new FixedDiscount(),
            'percentage' => new PercentageDiscount(),
            'vip' => new VipDiscount(),
            default => throw new \InvalidArgumentException("Tipo de desconto inválido."),
            'seasonal' => new SeasonalDiscount(),
        };
    }
}
