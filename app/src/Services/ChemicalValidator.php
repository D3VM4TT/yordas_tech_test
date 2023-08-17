<?php

namespace Yordas\App\Services;

class ChemicalValidator
{
    private const PATTERN_HIVE_ID = '/^ID\d{6}$/';

    private const PATTERN_CAS_NUMBER = '/^\d{2,7}-\d{2}-\d$/';

    public static function isValidHiveID(string $input): bool {
        return preg_match(self::PATTERN_HIVE_ID, $input) === 1;
    }

    // "7732-18-5";
    public static function isValidCASNumber(string $input): bool {
        if (preg_match(self::PATTERN_CAS_NUMBER, $input) !== 1) {
            return false;
        }

        $casParts = explode('-', $input);
        $casNumber = $casParts[0] . $casParts[1];
        $checkDigit = $casParts[2];

        $length = strlen($casNumber);
        $totalSum = 0;

        for ($i = 0; $i < $length; $i++) {
            $digit = (int)strrev($casNumber)[$i];
            $position = $i + 1;
            $totalSum += $digit * $position;
        }

        $trueCheckDigit = $totalSum % 10;

        return $trueCheckDigit === (int)$checkDigit;
    }
}
