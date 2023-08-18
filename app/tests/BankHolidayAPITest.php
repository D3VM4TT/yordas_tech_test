<?php

use PHPUnit\Framework\TestCase;
use Yordas\App\Services\BankHolidayAPI;

class BankHolidayAPITest extends TestCase
{
    public function testGetBankHolidays(): void
    {
        $mockResponse = [
            'us' => [
                'events' => [
                    ['date' => '2023-12-25', 'name' => 'Christmas Day'],
                    ['date' => '2023-01-01', 'name' => 'New Year\'s Day'],
                ],
            ],
        ];

        $mockApiUrl = 'https://example.com/mock-api';

        // Create a partial mock for BankHolidayAPI, only mocking getBankHolidays
        $mockHttpClient = $this->getMockBuilder(BankHolidayAPI::class)
            ->setConstructorArgs([$mockApiUrl])
            ->onlyMethods(['getBankHolidays']) // Specify the method to mock
            ->getMock();

        $mockHttpClient->expects($this->once())
            ->method('getBankHolidays')
            ->willReturn($mockResponse);

        $this->assertSame($mockResponse, $mockHttpClient->getBankHolidays());
    }

    public function testGetFutureBankHolidays(): void
    {
        $mockResponse = [
            'us' => [
                'events' => [
                    ['date' => '2024-08-19', 'name' => 'Event A (future)'],
                    ['date' => '2022-12-25', 'name' => 'Event B (past)'],
                ],
            ],
        ];

        $mockApiUrl = 'https://example.com/mock-api';

        $mockBankHolidayApi = $this->getMockBuilder(BankHolidayAPI::class)
            ->setConstructorArgs([$mockApiUrl])
            ->onlyMethods(['getBankHolidays'])
            ->getMock();

        $mockBankHolidayApi->expects($this->once())
            ->method('getBankHolidays')
            ->willReturn($mockResponse);


        $expectedFutureEvents = [
            'us' => [
                ['date' => '2024-08-19', 'name' => 'Event A (future)']
            ]
        ];

        $this->assertSame($expectedFutureEvents, $mockBankHolidayApi->getFutureBankHolidays());
    }


}
