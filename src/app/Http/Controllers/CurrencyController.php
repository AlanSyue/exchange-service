<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;
use App\Services\ExchangeService;
use App\Transformer\CurrencyTransformer;
use Illuminate\Http\JsonResponse;

class CurrencyController
{
    /**
     * Exchange the currencies.
     *
     * @return JsonResponse
     */
    public function exchange(
        CurrencyRequest $request,
        ExchangeService $service,
        CurrencyTransformer $transformer
    ): JsonResponse {
        $request->validated();
        $amount = $service->execute($request->toDTO());

        return response()->json($transformer->transform($amount));
    }
}
