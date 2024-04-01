<?php

namespace RhinoAfrica\UnitConversionObjects;

use PHPUnit\Framework\TestCase;
use RhinoAfrica\UnitConversionObjects\Converters\LengthConverter;
use RhinoAfrica\UnitConversionObjects\Units\Meter;
use RhinoAfrica\UnitConversionObjects\Units\Kilometer;
use RhinoAfrica\UnitConversionObjects\Units\Mile;

final class LengthConverterTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $kilogram = new Meter();
        $kilogram->setValue(5); 
        $this->assertSame((float)5, $kilogram->getValue());

        $gram = new Kilometer();
        $gram->setValue(6); 
        $this->assertSame((float)6, $gram->getValue());

        $gram = new Mile();
        $gram->setValue(7); 
        $this->assertSame((float)7, $gram->getValue());
    }

    public function testConvertFromMeter()
    {
        // Initialize the source unit
        $meter = new Meter();
        $meter->setValue(500); 

        // Initialize the converter
        $converter = new LengthConverter();

        // Convert from Meters to Kilometer
        $kilometer = $converter->convert($meter, 'kilometer');
        $this->assertSame(0.5, $kilometer->getValue());

        // Convert from Meters to Miles
        $mile = $converter->convert($meter, 'mile');
        $this->assertSame(0.31, $mile->getValue());
    }

    public function testConvertFromKilometer()
    {
        // Initialize the source unit
        $kilometer = new Kilometer();
        $kilometer->setValue(1000); 

        // Initialize the converter
        $converter = new LengthConverter();

        // Convert from Kilometers to Meters
        $meter = $converter->convert($kilometer, 'meter');
        $this->assertSame(1000000.0, $meter->getValue());

        // Convert from Kilometers to Miles
        $mile = $converter->convert($meter, 'mile');
        $this->assertSame(621.37, $mile->getValue());
    }

    public function testConvertFromMile()
    {
        // Initialize the source unit
        $mile = new Mile();
        $mile->setValue(621.37); 

        // Initialize the converter
        $converter = new LengthConverter();

        // Convert from Miles to Meters
        $meter = $converter->convert($mile, 'meter');
        $this->assertSame(999995.6, $meter->getValue());

        // Convert from Miles to Kilometers
        $kilometer = $converter->convert($meter, 'kilometer');
        $this->assertSame(1000.0, $kilometer->getValue());
    }
}