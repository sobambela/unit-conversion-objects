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

Ensure that your code is intuitive and well-documented so that others can easily 
understand how to use it and add their own types of conversions if necessary.

### Notes:

1. **Unit Consistency**: The converter checks if the source unit type is compatible
   with conversion tyoe requested.
2. **Extensibility**: You can add more case statements to each method to support 
   more units.
3. **Error Handling**: The converter throws exceptions if the source unit or target 
   unit is not supported.
4. **Unit Classes**: This example assumes that you have Meter, Kilometer, and Mile 
   classes that extend BaseUnit.

This structure ensures that adding a new unit conversion, like feet to meters, would
only require you to add a new case in the relevant methods and ensure that a
corresponding unit class exists. This design aligns with the principles of OOP, 
promoting extensibility and maintainability.

### Use Initiative

There's no need to follow all the same methodologies and functionality currently available
in this package. It's by no means perfect, but it's also not perfect for good reason. If you
truly understand the inner workings of this package, you should also have a good idea of how
to improve it. If you use initiative and make improvements to current functional flow, it
would be of incredible benefit for the outcome of the completed asssesment.

### Support
While we hope you are in the position to face a challenge and to figure things out when they
don't work according to how you would expect, we understand that tasks like these can take 
time. If you struggle with installation, setup or anything in documentation is confusing you,
please feel free to reach out at us directly at quintin@rhinoafrica.com. I will be happy to
assist to keep you moving.

### Hints / Converter Example

The following code can be used as reference for Converter Functionality

```
<?php
namespace RhinoAfrica\UnitConversionObjects\Converters;

use Illuminate\Http\Response;
use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;
use RhinoAfrica\UnitConversionObjects\Units\Kilometer;
use RhinoAfrica\UnitConversionObjects\Units\Meter;
use RhinoAfrica\UnitConversionObjects\Units\Mile;

/**
 * Conversion Strategy Class for Lenth conversion units, extending AbstractConverter
 */
class LengthConverter
    extends AbstractConverter
{

    /**
     * @param UnitInterface $sourceUnit
     * @param string $targetUnit
     * @return UnitInterface
     * @throws \Exception
     */
    public function convert(UnitInterface $sourceUnit, string $targetUnit): UnitInterface
    {
        $sourceValue = $sourceUnit->getValue();
        $sourceType = $sourceUnit->getUnitType();
        if ($sourceType !== 'length') {
            throw new \Exception("Incompatible unit type for LengthConverter.");
        }

        switch ($sourceUnit::class) {
            case Meter::class:
                return $this->convertFromMeter($sourceValue, $targetUnit);
            case Kilometer::class:
                return $this->convertFromKilometer($sourceValue, $targetUnit);
            case Mile::class:
                return $this->convertFromMile($sourceValue, $targetUnit);
            default:
                throw new \Exception("Unsupported source unit.");
        }
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return UnitInterface
     * @throws \Exception
     */
    private function convertFromMeter(float $value, string $targetUnit): UnitInterface
    {
        switch ($targetUnit) {
            case 'kilometer':
                $convertedValue = $value / 1000;
                $target = new Kilometer();
                break;
            case 'mile':
                $convertedValue = $value / 1609.34;
                $target = new Mile();
                break;
            default:
                throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $target->setValue($convertedValue);
        return $target;
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return UnitInterface
     * @throws \Exception
     */
    private function convertFromKilometer(float $value, string $targetUnit): UnitInterface {
        switch ($targetUnit) {
            case 'meter':
                $convertedValue = $value * 1000;
                $target = new Meter();
                break;
            case 'mile':
                $convertedValue = $value / 1.60934;
                $target = new Mile();
                break;
            default:
                throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $target->setValue($convertedValue);
        return $target;
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return UnitInterface
     * @throws \Exception
     */
    private function convertFromMile(float $value, string $targetUnit): UnitInterface {
        switch ($targetUnit) {
            case 'meter':
                $convertedValue = $value * 1609.34;
                $target = new Meter();
                break;
            case 'kilometer':
                $convertedValue = $value * 1.60934;
                $target = new Kilometer();
                break;
            default:
                throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $target->setValue($convertedValue);
        return $target;
    }
}
```