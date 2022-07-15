<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\ExchangeRate;

interface ExchangeRepository
{
    /**
     * Find the exchange rate by the currency.
     *
     * @param string $to
     *
     * @return ExchangeRate
     */
    public function findExchangeRate(string $to): ExchangeRate;
}
