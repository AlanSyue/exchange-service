<?php

declare(strict_types=1);

namespace Tests\Unit\Currency;

use App\Entities\Currency;
use App\Entities\CurrencyDto;
use App\Entities\ExchangeRate;
use App\Services\ExchangeService;
use App\Repositories\ExchangeRepository;
use Tests\TestCase;

class ExchangeServiceTest extends TestCase
{
    private $repo;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->repo = $this->createMock(ExchangeRepository::class);
    }

    /**
     * @dataProvider currenciesProvider
     *
     * Test exchange result.
     *
     * @param string $from
     * @param string $to
     * @param float  $amount
     * @param float  $expected
     *
     * @return void
     */
    public function testExchange(string $from, string $to, float $amount, float $expected)
    {
        $dto = new CurrencyDto($from, $to, $amount);
        $currencies_data = $this->getCurrenciesData();
        $exchange_rate = new ExchangeRate($currencies_data[$dto->from()]);

        $this->repo->expects($this->once())
            ->method('findExchangeRate')
            ->with($dto->from())
            ->will($this->returnValue($exchange_rate));

        $service = new ExchangeService($this->repo);
        $amount = $service->execute($dto);

        $this->assertEquals($expected, $amount);
    }

    /**
     * The data provider.
     *
     * @return array
     */
    public function currenciesProvider(): array
    {
        return [
            'Exchange TWD to JPY success' => [
                'from' => Currency::TWD,
                'to' => Currency::JPY,
                'amount' => 200,
                'expected' => 733.80
            ],
            'Exchange JPY to USD success' => [
                'from' => Currency::JPY,
                'to' => Currency::USD,
                'amount' => 2000000,
                'expected' => 17700
            ],
            'Exchange USD to TWD success' => [
                'from' => Currency::USD,
                'to' => Currency::TWD,
                'amount' => 30,
                'expected' => 913.32
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
