<?php

declare(strict_types=1);

namespace App\Entities;

class Currency
{
    /**
     * The New Taiwan Dollar currency code.
     *
     * @var string
     */
    public const TWD = 'TWD';

    /**
     * The Japanese Yen currency code.
     *
     * @var string
     */
    public const JPY = 'JPY';

    /**
     * The US Dollar currency code.
     *
     * @var string
     */
    public const USD = 'USD';

    /**
     * Get the currencies which can be exchanged.
     *
     * @return array
     */
    public const AVAILABLE_CURRENCIES = [
        self::TWD,
        self::JPY,
        self::USD,
    ];
}
