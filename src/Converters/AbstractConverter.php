<?php
namespace RhinoAfrica\UnitConversionObjects\Converters;

use RhinoAfrica\UnitConversionObjects\Interfaces\ConverterInterface;
use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;
use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;

/**
 * An abstract class that implements ConverterInterface, providing a template method convert(...) for conversion and
 * delegating unit-specific conversion steps to child classes.
 */
abstract class AbstractConverter implements ConverterInterface
{
    protected $sourceUnit;
    protected $targetUnit;

    abstract public function convert(BaseUnit $sourceUnit, string $targetUnit): BaseUnit;
}
