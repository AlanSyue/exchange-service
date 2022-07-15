<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Entities\ExchangeRate;
use App\Repositories\ExchangeRepository;
use Illuminate\Support\Facades\Storage;

class InMemoryExchangeRepository implements ExchangeRepository
{
    /**
     * The currencies data path.
     *
     * @var string
     */
    private const CURRENCIES_DATA_PATH = 'public/currencies.json';

    /**
     * The currencies data.
     *
     * @var array
     */
    private $currencies;

    /**
     * Create a new repository instance.
     */
    public function __construct()
    {
        $currencies_json = Storage::disk('local')->get(self::CURRENCIES_DATA_PATH);
        $this->currencies = json_decode($currencies_json, true);
    }

    /**
     * Find the exchange rate by the currency.
     *
     * @param string $to
     *
     * @return ExchangeRate
     */
    public function findExchangeRate(string $to): ExchangeRate
    {
        return new ExchangeRate($this->currencies[$to]);
    }
}
