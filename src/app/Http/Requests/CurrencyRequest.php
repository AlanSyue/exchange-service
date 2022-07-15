<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Entities\Currency;
use App\Entities\CurrencyDto;
use Illuminate\Foundation\Http\FormRequest;

class CurrencyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $available_currencies = implode(',', Currency::AVAILABLE_CURRENCIES);

        return [
            'from' => "required|string|in:{$available_currencies}",
            'to' => "required|string|in:{$available_currencies}",
            'amount' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ];
    }

    /**
     * Transform the request data to DTO.
     *
     * @return CurrencyDto
     */
    public function toDTO(): CurrencyDto
    {
        return new CurrencyDto($this->from, $this->to, $this->amount);
    }
}
