<?php

require '../vendor/autoload.php';

use Yordas\App\Services\BankHolidayAPI;
use Yordas\App\Services\BankHolidayDisplay;
use Yordas\App\Services\ChemicalValidator;

$valid_hive_id = 'ID123456';
$invalid_hive_id = 'ID12345';

var_dump(ChemicalValidator::isValidHiveID($valid_hive_id));
var_dump(ChemicalValidator::isValidHiveID($invalid_hive_id));


// 6417
// 7 x 1 = 7
// 1 x 2 = 2
// 4 x 3 = 12
// 6 x 4 = 24
// 7 + 2 + 12 + 24 = 45
// 45 / 10 = 4.5

var_dump(ChemicalValidator::isValidCASNumber('7732-18-5'));
var_dump(ChemicalValidator::isValidCASNumber('7732-18-6'));
var_dump(ChemicalValidator::isValidCASNumber('7732123-18-6'));
var_dump(ChemicalValidator::isValidCASNumber('7-18-6'));
var_dump(ChemicalValidator::isValidCASNumber('64-17-5'));

$apiUrl = "https://www.gov.uk/bank-holidays.json";
$api = new BankHolidayAPI($apiUrl);
$futureBankHolidays = $api->getFutureBankHolidays();
var_dump($futureBankHolidays);

