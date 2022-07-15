<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Services\ExchangeService;

class CurrencyController
{
    /**
     * Exchange the currencies.
     *
     * @return void
     */
    public function exchange(CurrencyRequest $request, ExchangeService $service)
    {
        $request->validated();
        $amount = $service->execute($request->toDTO());
    }
}
