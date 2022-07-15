<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Entities\Currency;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CurrencyControllerTest extends TestCase
{
    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('local');
        Storage::disk('local')->put('public/currencies.json', json_encode($this->getCurrenciesData()));
    }

    /**
     * @dataProvider responseProvider
     *
     * Test the api response.
     *
     * @param array $data
     * @param array $expected
     *
     * @return void
     */
    public function testResponse(array $data, array $expected)
    {
        $this->json('POST', '/api/currencies/exchange', $data)
            ->assertStatus($expected['status_code'])
            ->assertJson($expected['response'], true);
    }

    /**
     * The data provider.
     *
     * @return array
     */
    public function responseProvider(): array
    {
        return [
            'Exchange TWD to JPY success' => [
                'data' => [
                    'from' => Currency::TWD,
                    'to' => Currency::JPY,
                    'amount' => 200,
                ],
                'expected' => [
                    'status_code' => Response::HTTP_OK,
                    'response' => [
                        'data' => [
                            'amount' => '733.80',
                        ],
                    ],
                ],
            ],
            'Exchange JPY to USD success 1' => [
                'data' => [
                    'from' => Currency::JPY,
                    'to' => Currency::USD,
                    'amount' => 2000000,
                ],
                'expected' => [
                    'status_code' => Response::HTTP_OK,
                    'response' => [
                        'data' => [
                            'amount' => '17,700.00',
                        ],
                    ],
                ],
            ],
            'Exchange USD to TWD success' => [
                'data' => [
                    'from' => Currency::USD,
                    'to' => Currency::TWD,
                    'amount' => 30,
                ],
                'expected' => [
                    'status_code' => Response::HTTP_OK,
                    'response' => [
                        'data' => [
                            'amount' => '913.32',
                        ],
                    ],
                ],
            ],
            'Post data value invalid' => [
                'data' => [
                    'from' => 'HK',
                    'to' => 'ZAR',
                    'amount' => -100,
                ],
                'expected' => [
                    'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'response' => [
                        'message' => 'The given data was invalid.',
                        'errors' => [
                            'from' => [
                                'The selected from is invalid.',
                            ],
                            'to' => [
                                'The selected to is invalid.',
                            ],
                            'amount' => [
                                'The amount format is invalid.',
                            ],
                        ],
                    ],
                ],
            ],
            'Post data key invalid' => [
                'data' => [
                    'a' => 'HK',
                    'b' => 'ZAR',
                ],
                'expected' => [
                    'status_code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'response' => [
                        'message' => 'The given data was invalid.',
                        'errors' => [
                            'from' => [
                                'The from field is required.',
                            ],
                            'to' => [
                                'The to field is required.',
                            ],
                            'amount' => [
                                'The amount field is required.',
                            ],
                        ],
                    ],
                ],
            ],
        ];
    }

    /**
     * Get the currencies data.
     *
     * @return array
     */
    private function getCurrenciesData(): array
    {
        return [
            "TWD" => [
                "TWD" => 1,
                "JPY" => 3.669,
                "USD" => 0.03281,
            ],
            "JPY" => [
                "TWD" => 0.26956,
                "JPY" => 1,
                "USD" => 0.00885,
            ],
            "USD" => [
                "TWD" => 30.444,
                "JPY" => 111.801,
                "USD" => 1,
            ],
        ];
    }
}
