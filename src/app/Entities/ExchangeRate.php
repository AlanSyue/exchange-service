<?php

declare(strict_types=1);

namespace App\Entities;

class ExchangeRate
{
    /**
     * The exchange rate list.
     *
     * @var array
     */
    private $exchange_rate_list;

    /**
     * Create a new entity instance.
     *
     * @param array $exchange_rate_list
     */
    public function __construct(array $exchange_rate_list)
    {
        $this->exchange_rate_list = $exchange_rate_list;
    }

    /**
     * Exchange the currency.
     *
     * @param string $to
     * @param float $amount
     *
     * @return float
     */
    public function exchange(string $to, float $amount): float
    {
        $rate = $this->exchange_rate_list[$to];

        return round($amount * $rate, 2);
    }
}
