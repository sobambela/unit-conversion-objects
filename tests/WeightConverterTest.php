<?php

namespace RhinoAfrica\UnitConversionObjects;

use PHPUnit\Framework\TestCase;
use RhinoAfrica\UnitConversionObjects\Converters\WeightConverter;
use RhinoAfrica\UnitConversionObjects\Units\Gram;
use RhinoAfrica\UnitConversionObjects\Units\Kilogram;
use RhinoAfrica\UnitConversionObjects\Units\Pound;

final class WeightConverterTest extends TestCase
{

    public function testGettersAndSetters()
    {
        $kilogram = new Kilogram();
        $kilogram->setValue(5); 
        $this->assertSame((float)5, $kilogram->getValue());

        $gram = new Gram();
        $gram->setValue(6); 
        $this->assertSame((float)6, $gram->getValue());

        $gram = new Gram();
        $gram->setValue(7); 
        $this->assertSame((float)7, $gram->getValue());
    }

    public function testConvertFromKilogram()
    {
        // Initialize the source unit
        $kilogram = new Kilogram();
        $kilogram->setValue(5); 

        // Initialize the converter
        $weightConverter = new WeightConverter();

        // Convert from Kilograms to Grams
        $kilogram = $weightConverter->convert($kilogram, 'gram');
        $this->assertSame(5000.0, $kilogram->getValue());

        // Convert from Kilograms to Pounds
        $pound = $weightConverter->convert($kilogram, 'pound');
        $this->assertSame(11.023, $pound->getValue());
    }

    public function testConvertFromGram()
    {
        // Initialize the source unit
        $gram = new Gram();
        $gram->setValue(5); 

        // Initialize the converter
        $weightConverter = new WeightConverter();

        // Convert from Grams to Kilograms
        $kilogram = $weightConverter->convert($gram, 'kilogram');
        $this->assertSame(0.005, $kilogram->getValue());

        // Convert from Grams to Pounds
        $pound = $weightConverter->convert($gram, 'pound');
        $this->assertSame(0.011, $pound->getValue());
    }
    
    public function testConvertFromPound()
    {
        // Initialize the source unit
        $pound = new Pound();
        $pound->setValue(5); 

        // Initialize the converter
        $weightConverter = new WeightConverter();

        // Convert from Pounds to Gram
        $gram = $weightConverter->convert($pound, 'gram');
        $this->assertSame(2268.0, $gram->getValue());

        // Convert from Pounds to Kilograms
        $kilogram = $weightConverter->convert($pound, 'kilogram');
        $this->assertSame(2.268, $kilogram->getValue());
    }
}