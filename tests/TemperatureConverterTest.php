<?php

namespace RhinoAfrica\UnitConversionObjects;

use PHPUnit\Framework\TestCase;
use RhinoAfrica\UnitConversionObjects\Converters\TemperatureConverter;
use RhinoAfrica\UnitConversionObjects\Units\Celsius;
use RhinoAfrica\UnitConversionObjects\Units\Kelvin;
use RhinoAfrica\UnitConversionObjects\Units\Fahrenheit;

final class TemperatureConverterTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $kilogram = new Celsius();
        $kilogram->setValue(5); 
        $this->assertSame((float)5, $kilogram->getValue());

        $gram = new Kelvin();
        $gram->setValue(6); 
        $this->assertSame((float)6, $gram->getValue());

        $gram = new Fahrenheit();
        $gram->setValue(7); 
        $this->assertSame((float)7, $gram->getValue());
    }

    public function testConvertFromCelsius()
    {
        // Initialize the source unit
        $celsius = new Celsius();
        $celsius->setValue(5); 

        // Initialize the converter
        $converter = new TemperatureConverter();

        // Convert from Celsius to Kelvin
        $kelvin = $converter->convert($celsius, 'kelvin');
        $this->assertSame(278.15, $kelvin->getValue());

        // Convert from Celsius to Fahrenheit
        $fahrenheit = $converter->convert($celsius, 'fahrenheit');
        $this->assertSame(41.0, $fahrenheit->getValue());
    }

    public function testConvertFromKelvin()
    {
        // Initialize the source unit
        $kelvin = new Kelvin();
        $kelvin->setValue(5); 

        // Initialize the converter
        $converter = new TemperatureConverter();

        // Convert from Kelvin to Celsius
        $celsius = $converter->convert($kelvin, 'celsius');
        $this->assertSame(-268.15, $celsius->getValue());

        // Convert from Kelvin to Fahrenheit
        $fahrenheit = $converter->convert($kelvin, 'fahrenheit');
        $this->assertSame(-450.67, $fahrenheit->getValue());
    }

    public function testConvertFromFahrenheit()
    {
        // Initialize the source unit
        $fahrenheit = new Fahrenheit();
        $fahrenheit->setValue(5); 

        // Initialize the converter
        $converter = new TemperatureConverter();

        // Convert from Fahrenheit to Celsius
        $celsius = $converter->convert($fahrenheit, 'celsius');
        $this->assertSame(-15.0, $celsius->getValue());

        // Convert from Fahrenheit to Kelvin
        $kelvin = $converter->convert($fahrenheit, 'kelvin');
        $this->assertSame(258.15, $kelvin->getValue());
    }
}