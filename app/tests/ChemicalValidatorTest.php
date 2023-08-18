<?php

use PHPUnit\Framework\TestCase;
use Yordas\App\Services\ChemicalValidator;

class ChemicalValidatorTest extends TestCase
{

    public function testValidHiveID(): void
    {
        $this->assertTrue(ChemicalValidator::isValidHiveID('ID000001'));
        $this->assertTrue(ChemicalValidator::isValidHiveID('ID000002'));
        $this->assertTrue(ChemicalValidator::isValidHiveID('ID000003'));
    }

    public function testInvalidHiveID(): void
    {
        $this->assertFalse(ChemicalValidator::isValidHiveID('ID00000'));
        $this->assertFalse(ChemicalValidator::isValidHiveID('ID0000001'));
        $this->assertFalse(ChemicalValidator::isValidHiveID('INVALID_HIVE_ID'));
    }

    public function testValidCASNumber(): void
    {
        $this->assertTrue(ChemicalValidator::isValidCASNumber('7732-18-5'));
        $this->assertTrue(ChemicalValidator::isValidCASNumber('27039-77-6'));
    }

    public function testInvalidCASNumber(): void
    {
        $this->assertFalse(ChemicalValidator::isValidCASNumber('123-45-6'));
        $this->assertFalse(ChemicalValidator::isValidCASNumber('1234-56-78'));
        $this->assertFalse(ChemicalValidator::isValidCASNumber('1234-56'));
    }

}
