<?php

declare(strict_types=1);

namespace App\Transformer;

class CurrencyTransformer
{
    /**
     * Transform the data to the response format.
     *
     * @param float $amount
     *
     * @return array
     */
    public function transform(float $amount): array
    {
        return [
            'data' => [
                'amount' => number_format($amount, 2, '.', ','),
            ],
        ];
    }
}
