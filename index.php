<?php
require './vendor/autoload.php';

use RhinoAfrica\UnitConversionObjects\Services\UnitConversionService;
use RhinoAfrica\UnitConversionObjects\Units\Meter;
use RhinoAfrica\UnitConversionObjects\Converters\LengthConverter;
use RhinoAfrica\UnitConversionObjects\Converters\TemperatureConverter;
use RhinoAfrica\UnitConversionObjects\Converters\WeightConverter;
use RhinoAfrica\UnitConversionObjects\Units\Celsius;
use RhinoAfrica\UnitConversionObjects\Units\Kelvin;
use RhinoAfrica\UnitConversionObjects\Units\Fahrenheit;
use RhinoAfrica\UnitConversionObjects\Units\Kilogram;
use RhinoAfrica\UnitConversionObjects\Units\Gram;
use RhinoAfrica\UnitConversionObjects\Units\Pound;
use RhinoAfrica\UnitConversionObjects\Units\Kilometer;
use RhinoAfrica\UnitConversionObjects\Units\Mile;

/** Meter convertions **/
// Initialize the source unit
$meter = new Meter();
$meter->setValue(500); // Set 500 meters

// Initialize the converter
$lengthConverter = new LengthConverter();

// Convert from Meter to Kilometer
$kilometer = $lengthConverter->convert($meter, 'kilometer');
echo $kilometer->getValue() . ' kilometers' . "<br>"; // Outputs the converted value

// Convert from Meter to Mile
$mile = $lengthConverter->convert($meter, 'mile');
echo $mile->getValue() . ' miles' . "<br>"; // Outputs the converted value
/* END Meter Convertions */

/** Kilometer convertions **/
// Initialize the source unit
$kilometer = new Kilometer();
$kilometer->setValue(1000); // Set 500 meters
// Initialize the converter
$lengthConverter = new LengthConverter();

// Convert from KiloMeter to Meter
$meter = $lengthConverter->convert($kilometer, 'meter');
echo $meter->getValue() . ' meters' . "<br>"; // Outputs the converted value

// Convert from Meter to Kilometer
$mile = $lengthConverter->convert($kilometer, 'mile');
echo $mile->getValue() . ' miles' . "<br>"; // Outputs the converted value
/* END Kilometer convertions */

/** Mile convertions **/
// Initialize the source unit
$mile = new Mile();
$mile->setValue(621.37); // Set 500 meters
// Initialize the converter
$lengthConverter = new LengthConverter();

// Convert from Mile to Meter
$meter = $lengthConverter->convert($mile, 'meter');
echo $meter->getValue() . ' meters' . "<br>"; // Outputs the converted value

// Convert from Mile to Kilometer
$kilometer = $lengthConverter->convert($mile, 'kilometer');
echo $kilometer->getValue() . ' kilometers' . "<br>"; // Outputs the converted value
/* END Mile convertions */

echo "Tempertures <br>";
/** Celsius convertions **/
// Initialize the source unit
$celsius = new Celsius();
$celsius->setValue(5); 
// Initialize the converter
$tempConverter = new TemperatureConverter();

// Convert from Celsius to Kelvin
$kelvin = $tempConverter->convert($celsius, 'kelvin');
echo $kelvin->getValue() . ' Kelvin' . "<br>"; // Outputs the converted value

// Convert from Celsius to Fahrenheit
$fahrenheit = $tempConverter->convert($celsius, 'fahrenheit');
echo $fahrenheit->getValue() . ' Fahrenheit' . "<br>"; // Outputs the converted value

/** Kelvin convertions **/
// Initialize the source unit
$kelvin = new Kelvin();
$kelvin->setValue(5); 
// Initialize the converter
$tempConverter = new TemperatureConverter();

// Convert from Kelvin to Celsius
$celsius = $tempConverter->convert($kelvin, 'celsius');
echo $celsius->getValue() . ' celsius' . "<br>"; // Outputs the converted value

// Convert from Kelvin to Fahrenheit
$fahrenheit = $tempConverter->convert($kelvin, 'fahrenheit');
echo $fahrenheit->getValue() . ' fahrenheit' . "<br>"; // Outputs the converted value
/* END Kelvin convertions */

/** Fahrenheit convertions **/
// Initialize the source unit
$fahrenheit = new Fahrenheit();
$fahrenheit->setValue(5); 
// Initialize the converter
$tempConverter = new TemperatureConverter();

// Convert from Fahrenheit to Celsius
$celsius = $tempConverter->convert($fahrenheit, 'celsius');
echo $celsius->getValue() . ' celsius' . "<br>"; // Outputs the converted value

// Convert from Fahrenheit to Kelvin
$kelvin = $tempConverter->convert($fahrenheit, 'kelvin');
echo $kelvin->getValue() . ' kelvin' . "<br>"; // Outputs the converted value
/* END Fahrenheit convertions */

/** Kilogram convertions **/
// Initialize the source unit
$kilogram = new Kilogram();
$kilogram->setValue(5); 
// Initialize the converter
$weightConverter = new WeightConverter();

// Convert from Kilogram to Gram
$kilogram = $weightConverter->convert($kilogram, 'gram');
echo $kilogram->getValue() . ' grams' . "<br>"; // Outputs the converted value

// Convert from Kilogram to Pounds
$pound = $weightConverter->convert($kilogram, 'pound');
echo $pound->getValue() . ' pound' . "<br>"; // Outputs the converted value
/* END Kilogram convertions */

/** Gram convertions **/
// Initialize the source unit
$gram = new Gram();
$gram->setValue(5); 
// Initialize the converter
$weightConverter = new WeightConverter();

// Convert from Kilogram to Gram
$kilogram = $weightConverter->convert($gram, 'kilogram');
echo $kilogram->getValue() . ' grams' . "<br>"; // Outputs the converted value

// Convert from Kilogram to Pounds
$pound = $weightConverter->convert($gram, 'pound');
echo $pound->getValue() . ' pound' . "<br>"; // Outputs the converted value
/* END Gram convertions */

/** Pound convertions **/
// Initialize the source unit
$pound = new Pound();
$pound->setValue(5); 
// Initialize the converter
$weightConverter = new WeightConverter();

// Convert from Pound to Gram
$gram = $weightConverter->convert($pound, 'gram');
echo $gram->getValue() . ' grams' . "<br>"; // Outputs the converted value

// Convert from Pounds to Kilograms
$kilogram = $weightConverter->convert($pound, 'kilogram');
echo $kilogram->getValue() . ' kilograms' . "<br>"; // Outputs the converted value
/* END Pound convertions */

echo 'Using the Service Object <br>';
// Initialize the Service Object
$service = new UnitConversionService();
$service->setSourceUnit('kilometer',1);

// Convert from Kilometers to Miles
$targetUnit = $service->convert('meter');
echo $targetUnit->getValue() . ' meters <br>';

$targetUnit = $service->convert('mile');
echo $targetUnit->getValue() . ' miles  <br>';


$service->setSourceUnit('kilogram',1);

// Convert from Kilometers to Miles
$targetUnit = $service->convert('gram');
echo $targetUnit->getValue() . ' grams <br>';

$targetUnit = $service->convert('pound');
echo $targetUnit->getValue() . ' pounds  <br>';

$service->setSourceUnit('celsius',100);

$targetUnit = $service->convert('kelvin');
echo $targetUnit->getValue() . ' kelvin  <br>';

$targetUnit = $service->convert('fahrenheit');
echo $targetUnit->getValue() . ' fahrenheit  <br>';

