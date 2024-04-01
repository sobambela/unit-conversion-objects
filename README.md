# Unit Conversion Service Library

---

## Overview:

A standalone library that provides unit conversion functionality as a service. The library
should provide the caller the means to convert between different units of measurement like 
length (meters, kilometers, inches, feet), weight (kilograms, grams, pounds), and temperature 
(Celsius, Fahrenheit, Kelvin). The library should be easily extendable to support new unit 
types and units in future releases.

### System Requirements
1. PHP ^8.1.

### Installation and Setup:
The package has some composer depencies that need to be installed. Since the vendor folder is gitignored. Composer install will have to be run after cloning the package.

1. **Clone the repo:**
```
$ git clone git@github.com:rasrecruits/unit-conversion-objects.git
$ cd unit-conversion-objects
$ composer install
```
2. **Tests:**
Unit tests covering the major functionalities are located in the ./tests folder. These test all the available Converters and the Unit Conversion Service. There are 13 tests with 33 assertions. The command below will run through all the tests.
```
$ cd cd unit-conversion-objects
$ ./vendor/bin/phpunit tests
```

### Usage Examples:
The examples below demonstrate how to use the library. The first two examples demonstrates
how to convert different units. The third example demonstrates how the Service Object
can be instantiated in application logic to provide access to the Service class objects
and functionality.

#### Example 1: Converting Length - Meter to Kilometer
```
<?php
use RhinoAfrica\UnitConversionObjects\Units\Meter;
use RhinoAfrica\UnitConversionObjects\Converters\LengthConverter;

// Initialize the source unit
$meter = new Meter();
$meter->setValue(500); // Set 500 meters

// Initialize the converter
$lengthConverter = new LengthConverter();

// Convert from Meter to Kilometer
$kilometer = $lengthConverter->convert($meter, 'kilometer');
echo $kilometer->getValue() . ' kilometers'; // Outputs the converted value in kilometers
```

#### Example 2: Converting Weight - Kilogram to Pound
```
<?php
use RhinoAfrica\UnitConversionObjects\Units\Kilogram;
use RhinoAfrica\UnitConversionObjects\Converters\WeightConverter;

// Initialize the source unit
$kilogram = new Kilogram();
$kilogram->setValue(80); // Set 80 kilograms

// Initialize the converter
$weightConverter = new WeightConverter();

// Convert from Kilogram to Pound
$pound = $weightConverter->convert($kilogram, 'pound');
echo $pound->getValue() . ' pounds'; // Outputs the converted value in pounds
```

In these examples, the convert method of the respective converter class is
responsible for performing the conversion based on the source unit and the target
unit. The actual conversion logic would be implemented within each specific converter
class (like LengthConverter, WeightConverter, TemperatureConverter).

#### Example 3: Using the Service Object
```
<?php
use RhinoAfrica\UnitConversionObjects\Services\UnitConversionService;

// Initialize the Service Object
$service = new UnitConversionService();
$service->setSourceUnit('kilometer',60);

// Convert from Kilometers to Miles
$targetUnit = $service->convert('mile');
echo $targetUnit->getValue() . ' miles'; // Outputs the converted value in miles
```

The design allows for easy extension, so you can add more units and conversion logic as needed.

### Extending the Package (Adding more units):

1. **Adding a Unit file**: Below is an example of a Unit file that is needed when adding a new Unit to convert. Add a file **./src/Units/UnitName.php**

```
<?php 
namespace RhinoAfrica\UnitConversionObjects\Units;

use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;

class UnitName extends BaseUnit
{
    public function __construct()
    {   
        // Unit type definition 
        $this->unitType = 'temperature';
    }
}
```

Follwing this, a Converter class needs to accompany the new unit file. This is done by adding **./src/Converters/UnitNameConverter.php** that has the following structure:
```
<?php
namespace RhinoAfrica\UnitConversionObjects\Converters;

use Illuminate\Http\Response;
use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;
use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;
use RhinoAfrica\UnitConversionObjects\Units\Celsius;
use RhinoAfrica\UnitConversionObjects\Units\Kelvin;
use RhinoAfrica\UnitConversionObjects\Units\Fahrenheit;
use RhinoAfrica\UnitConversionObjects\Units\UnitName;

/**
 * Conversion Strategy Class for Temperture conversion units, extending AbstractConverter
 */
class UnitNameConverter extends AbstractConverter
{

    /**
     * @param BaseUnit $sourceUnit
     * @param string $targetUnit
     * @return BaseUnit
     * @throws \Exception
     */
    public function convert(BaseUnit $sourceUnit, string $targetUnit): BaseUnit
    {
        $sourceValue = $sourceUnit->getValue();
        $sourceType = $sourceUnit->getUnitType();
      
        if ($sourceType !== 'temperature') {
            throw new \Exception("Incompatible unit type for TemperatureConverter.");
        }

        switch ($sourceUnit::class) {
            case Celsius::class:
                return $this->convertFromCelsius($sourceValue, $targetUnit);
            case Kelvin::class:
                return $this->convertFromKelvin($sourceValue, $targetUnit);
            case Fahrenheit::class:
                return $this->convertFromFahrenheit($sourceValue, $targetUnit);
            case UnitName::class:
                return $this->convertFromUnitName($sourceValue, $targetUnit);
            default:
                throw new \Exception("Unsupported source unit.");
        }
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return BaseUnit
     * @throws \Exception
     */
    private function convertFromCelsius(float $value, string $targetUnit): BaseUnit
    {
        switch ($targetUnit) {
            case 'celsius':
                $convertedValue = $value + 273.15;
                $target = new Celsius();
                break;
            case 'kelvin':
                $convertedValue = $value + 273.15;
                $target = new Kelvin();
                break;
            case 'fahrenheit':
                $convertedValue = ($value * (9/5)) + 32;
                $target = new Kelvin();
                break;
            default:
                throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
                // throw new \Exception("Unsupported target unit.",404);
        }
        $target->setValue(round($convertedValue,2));
        return $target;
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return BaseUnit
     * @throws \Exception
     */
    private function convertFromKelvin(float $value, string $targetUnit): BaseUnit 
    {
        switch ($targetUnit) {
            case 'celsius':
                $convertedValue = $value - 273.15;
                $target = new Celsius();
                break;
            case 'fahrenheit':
                $convertedValue = (($value - 273.15) * (9/5)) + 32;
                $target = new Kelvin();
                break;
            default:
                throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $target->setValue(round($convertedValue,2));
        return $target;
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return BaseUnit
     * @throws \Exception
     */
    private function convertFromFahrenheit(float $value, string $targetUnit): BaseUnit 
    {
        switch ($targetUnit) {
            case 'celsius':
                $convertedValue = ($value - 32) * 5/9;
                $target = new Celsius();
                break;
            case 'kelvin':
                $convertedValue = (($value -  32) * (5/9)) + 273.15 ;
                $target = new Kelvin();
                break;
            default:
                // throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
                throw new \Exception("Unsupported target unit.",404);
        }
        $target->setValue(round($convertedValue,2));
        return $target;
    }

    /*
    * @param float $value
     * @param string $targetUnit
     * @return BaseUnit
     * @throws \Exception
     */
    private function convertFromUnitName(float $value, string $targetUnit): BaseUnit 
    {
        switch ($targetUnit) {
            case 'new-temperature-unit':
                $convertedValue = (($value -  32) * (5/9)) + 273.15 ;
                $target = new UnitName();
                break;
            default:
                // throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
                throw new \Exception("Unsupported target unit.",404);
        }
        $target->setValue(round($convertedValue,2));
        return $target;
    }
}
```
The above is an example of adding a new Unit of Temperature called UnitName. 
1. UnitName must first be imported. 
2. Extend the switch statement to include this UnitName
3. Create an acompanying convertFromUnitName function to handle the conversions.
