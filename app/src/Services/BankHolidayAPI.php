<?php

namespace Yordas\App\Services;

use DateTime;

class BankHolidayAPI
{
    public function __construct(private string $apiUrl) {}

    public function getBankHolidays() {
        $response = file_get_contents($this->apiUrl);
        return json_decode($response, true);
    }

    public function getFutureBankHolidays() {
        $data = $this->getBankHolidays();
        $today = new DateTime();
        $countries = array_keys($data);

        $futureBankHolidays = [];

        foreach ($countries as $country) {
            foreach ($data[$country]['events'] as $event) {
                $eventDate = new DateTime($event['date']);

                if ($eventDate >= $today) {
                    $futureBankHolidays[$country][] = $event;
                }
            }
        }

        return $futureBankHolidays;
    }
}
