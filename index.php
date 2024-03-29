<?php
require './vendor/autoload.php';

use RhinoAfrica\UnitConversionObjects\Units\Meter;
use RhinoAfrica\UnitConversionObjects\Converters\LengthConverter;
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
echo $kilometer->getValue() . ' kilometers' . "<br>"; // Outputs the converted value in kilometers

// Convert from Meter to Mile
$mile = $lengthConverter->convert($meter, 'mile');
echo $mile->getValue() . ' miles' . "<br>"; // Outputs the converted value in kilometers
/* END Meter Convertions */

/** Kilometer convertions **/
// Initialize the source unit
$kilometer = new Kilometer();
$kilometer->setValue(1000); // Set 500 meters
// Initialize the converter
$lengthConverter = new LengthConverter();

// Convert from KiloMeter to Meter
$meter = $lengthConverter->convert($kilometer, 'meter');
echo $meter->getValue() . ' meters' . "<br>"; // Outputs the converted value in kilometers

// Convert from Meter to Kilometer
$mile = $lengthConverter->convert($kilometer, 'mile');
echo $mile->getValue() . ' miles' . "<br>"; // Outputs the converted value in kilometers
/* END Kilometer convertions */

/** Mile convertions **/
// Initialize the source unit
$mile = new Mile();
$mile->setValue(621.37); // Set 500 meters
// Initialize the converter
$lengthConverter = new LengthConverter();

// Convert from KiloMeter to Meter
$meter = $lengthConverter->convert($mile, 'meter');
echo $meter->getValue() . ' meters' . "<br>"; // Outputs the converted value in kilometers

// Convert from Meter to Kilometer
$kilometer = $lengthConverter->convert($mile, 'kilometer');
echo $kilometer->getValue() . ' kilometers' . "<br>"; // Outputs the converted value in kilometers
/* END Kilometer convertions */