<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CurrencyRequest;

class CurrencyController
{
    /**
     * Exchange the currencies.
     *
     * @return void
     */
    public function exchange(CurrencyRequest $request)
    {
        $request->validated();
    }
}
