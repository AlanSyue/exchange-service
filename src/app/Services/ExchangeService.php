<?php

declare(strict_types=1);

namespace App\Services;

use App\Entities\CurrencyDto;
use App\Repositories\ExchangeRepository;

class ExchangeService
{
    /**
     * The exchange repository instance.
     *
     * @var ExchangeRepository
     */
    private $repo;

    /**
     * Create a new service instance.
     *
     * @param ExchangeRepository $repo
     */
    public function __construct(ExchangeRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Execute the service.
     *
     * @param CurrencyDto $dto
     *
     * @return float
     */
    public function execute(CurrencyDto $dto): float
    {
        $exchange_rate = $this->repo->findExchangeRate($dto->from());

        return $exchange_rate->exchange($dto->to(), $dto->amount());
    }
}
