<?php
namespace RhinoAfrica\UnitConversionObjects\Interfaces;

use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;

/**
 * Interface for the converter containing a method signature as follows:
 *  convert(UnitInterface $sourceUnit, string $targetUnit): UnitInterface
 */
interface ConverterInterface
{
    public function convert(BaseUnit $sourceUnit, string $targetUnit): BaseUnit;
}
