<?php

declare(strict_types=1);

namespace App\Entities;

class CurrencyDto
{
    /**
     * The string you have.
     *
     * @var string
     */
    private $from;

    /**
     * The string you want to exchange.
     *
     * @var string
     */
    private $to;

    /**
     * The string amount you have.
     *
     * @var float
     */
    private $amount;

    /**
     * Create a new DTO entity instance.
     *
     * @param string $from
     * @param string $to
     * @param float  $amount
     */
    public function __construct(string $from, string $to, float $amount)
    {
        $this->from = $from;
        $this->to = $to;
        $this->amount = $amount;
    }

    /**
     * Get the string you have.
     *
     * @return string
     */
    public function from(): string
    {
        return $this->from;
    }

    /**
     * Get the string you want to exchange.
     *
     * @return string
     */
    public function to(): string
    {
        return $this->to;
    }

    /**
     * Get the string amount you have.
     *
     * @return float
     */
    public function amount(): float
    {
        return $this->amount;
    }
}
