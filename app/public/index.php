<?php

require '../vendor/autoload.php';

use Yordas\App\Services\BankHolidayAPI;
use Yordas\App\Services\ChemicalValidator;


// QUESTION 1.a
echo "QUESTION 1.a \n";
$valid_hive_id = 'ID123456';
$invalid_hive_id = 'ID12345';
var_dump(ChemicalValidator::isValidHiveID($valid_hive_id));
var_dump(ChemicalValidator::isValidHiveID($invalid_hive_id));

// QUESTION 1.b
echo "QUESTION 1.b \n";
var_dump(ChemicalValidator::isValidCASNumber('7732-18-5'));
var_dump(ChemicalValidator::isValidCASNumber('7732-18-6'));
var_dump(ChemicalValidator::isValidCASNumber('7732123-18-6'));
var_dump(ChemicalValidator::isValidCASNumber('7-18-6'));
var_dump(ChemicalValidator::isValidCASNumber('64-17-5'));


// QUESTION 2
echo "QUESTION 2 \n";
$apiUrl = "https://www.gov.uk/bank-holidays.json";
$api = new BankHolidayAPI($apiUrl);
$futureBankHolidays = $api->getFutureBankHolidays();
var_dump($futureBankHolidays);

// QUESTION 3
/**
 * *** BUG ***
 * We are looping over the customFieldIds and logging the mostRecentValue based on the mostRecentValueDate
 * the most recent value date is '2022-10-14' so its not adding the next custom field in the $valuesForRecord with the date '2022-10-13'
 * so the most recent value of "Supplier: New Chemicals Ltd" is being shown twice in the customFieldIds loop
 */
echo "QUESTION 3 \n";
//$customFieldIds = [1,2,3];
//
//$valuesForRecord = [
//    [
//        'custom_field_id' => 1,
//        'date' => new DateTime('2022-10-13'),
//        'value' => 'SKU: 1234'
//    ],
//    [
//        'custom_field_id' => 2,
//        'date' => new DateTime('2022-10-13'),
//        'value' => 'Supplier: Example Chemicals Ltd'
//    ],
//    [
//        'custom_field_id' => 2,
//        'date' => new DateTime('2022-10-14'),
//        'value' => 'Supplier: New Chemicals Ltd'
//    ],
//    [
//        'custom_field_id' => 3,
//        'date' => new DateTime('2022-10-13'),
//        'value' => 'Quantity: 200 L drum'
//    ],
//];


//$mostRecentValue = '';
//$mostRecentValueDate = null;
//
//foreach ($customFieldIds as $customFieldId) {
//    foreach ($valuesForRecord as $value) {
//
//        if ($value['custom_field_id'] === $customFieldId) {
//            // the most recent value date is '2022-10-14' so its not adding the next custom field with the date '2022-10-13'
//            if ($value['date'] > $mostRecentValueDate) {
//                $mostRecentValue = $value['value'];
//                $mostRecentValueDate = $value['date'];
//            }
//
//
//        }
//
//
//
//
//    }
//    printf("$mostRecentValue \n");
//    echo "</br>";
//}

// QUESTION 3 FIXED
$customFieldIds = [1, 2, 3];
$customFields = [
    [
        'custom_field_id' => 1,
        'date' => new DateTime('2022-10-13'),
        'value' => 'SKU: 1234'
    ],
    [
        'custom_field_id' => 2,
        'date' => new DateTime('2022-10-13'),
        'value' => 'Supplier: Example Chemicals Ltd'
    ],
    [
        'custom_field_id' => 2,
        'date' => new DateTime('2022-10-14'),
        'value' => 'Supplier: New Chemicals Ltd'
    ],
    [
        'custom_field_id' => 3,
        'date' => new DateTime('2022-10-13'),
        'value' => 'Quantity: 200 L drum'
    ],
];


$newCustomFields = [];
foreach ($customFields as $customField) {
    if (!isset($newCustomFields[$customField['custom_field_id']])) {
        $newCustomFields[$customField['custom_field_id']] = $customField;
    } else {
        if ($customField['date'] > $newCustomFields[$customField['custom_field_id']]['date']) {
            $newCustomFields[$customField['custom_field_id']] = $customField;
        }
    }
}

var_dump($newCustomFields);


// QUESTION 4
//SELECT
//    substances.name AS Substance,
//    COALESCE(GROUP_CONCAT(DISTINCT cas_numbers.value ORDER BY cas_numbers.value ASC), 'N/A') AS CAS_Numbers,
//    COALESCE(GROUP_CONCAT(DISTINCT ec_numbers.value ORDER BY ec_numbers.value ASC), 'N/A') AS EC_Numbers
//FROM substances
//         LEFT JOIN substance_cas_numbers ON substances.id = substance_cas_numbers.substance_id
//         LEFT JOIN cas_numbers ON substance_cas_numbers.cas_number_id = cas_numbers.id
//         LEFT JOIN substance_ec_numbers ON substances.id = substance_ec_numbers.substance_id
//         LEFT JOIN ec_numbers ON substance_ec_numbers.ec_number_id = ec_numbers.id
//GROUP BY substances.id, substances.name;





















