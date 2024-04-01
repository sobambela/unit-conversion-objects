<?php

namespace RhinoAfrica\UnitConversionObjects;

use PHPUnit\Framework\TestCase;
use RhinoAfrica\UnitConversionObjects\Services\UnitConversionService;

final class UnitConversionServiceTest extends TestCase
{

    public function testUnitConverstions()
    {
        // Initialize the Service Object
        $service = new UnitConversionService();

        // Length Conversions
        $service->setSourceUnit('kilometer',1);

        // Convert from Kilometers to Meters
        $targetUnit = $service->convert('meter');
        $this->assertSame(1000.0, $targetUnit->getValue());

        // Convert from Kilometers to Miles
        $targetUnit = $service->convert('mile');
        $this->assertSame(0.62, $targetUnit->getValue());

        // Weight Conversions
        $service->setSourceUnit('kilogram',1);

        // Convert from Kilograms to Grams
        $targetUnit = $service->convert('gram');
        $this->assertSame(1000.0, $targetUnit->getValue());

        // Convert from Kilograms to Pounds
        $targetUnit = $service->convert('pound');
        $this->assertSame(2.21, $targetUnit->getValue());

        // Temperature Conversions
        $service->setSourceUnit('celsius',100);

        // Convert from Celsius to Kelvin
        $targetUnit = $service->convert('kelvin');
        $this->assertSame(373.15, $targetUnit->getValue());

        // Convert from Celsius to Fahrenheit
        $targetUnit = $service->convert('fahrenheit');
        $this->assertSame(212.0, $targetUnit->getValue());
    }
}