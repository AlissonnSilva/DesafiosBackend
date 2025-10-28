<?php

// app/Discount/DiscountContext.php

namespace App\Discount;

class DiscountContext
{
    private DiscountStrategy $strategy;

    /**
     * O Contexto pode ser inicializado com uma Strategy padrão (opcional).
     * No Laravel, é mais comum a Strategy ser injetada pelo setter ou construtor.
     *
     * @param DiscountStrategy|null $strategy
     */
    public function __construct(DiscountStrategy $strategy = null)
    {
        if ($strategy) {
            $this->strategy = $strategy;
        }
    }

    /**
     * Permite que o Cliente altere a Strategy em tempo de execução.
     *
     * @param DiscountStrategy $strategy
     * @return void
     */
    public function setStrategy(DiscountStrategy $strategy): void
    {
        $this->strategy = $strategy;
    }

    /**
     * O Contexto delega o trabalho à Strategy sem saber qual é a regra específica.
     *
     * @param float $orderAmount
     * @return float
     */
    public function calculateDiscount(float $orderAmount): float
    {
        return $this->strategy->calculate($orderAmount);
    }
}
