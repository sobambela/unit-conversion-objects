<?php
namespace RhinoAfrica\UnitConversionObjects\Interfaces;

use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;

/**
 * Interface for the converter containing a method signature as follows:
 *  convert(UnitInterface $sourceUnit, string $targetUnit): UnitInterface
 */
interface ConverterInterface
{
    public function convert(UnitInterface $sourceUnit, string $targetUnit): UnitInterface;
}
