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