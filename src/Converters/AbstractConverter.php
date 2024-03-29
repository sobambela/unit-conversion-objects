<?php
namespace RhinoAfrica\UnitConversionObjects\Converters;

use RhinoAfrica\UnitConversionObjects\Interfaces\ConverterInterface;
use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;

/**
 * An abstract class that implements ConverterInterface, providing a template method convert(...) for conversion and
 * delegating unit-specific conversion steps to child classes.
 */
abstract class AbstractConverter implements ConverterInterface
{
    protected $sourceUnit;
    protected $targetUnit;


    public function __construct(UnitInterface $sourceUnit, string $targetUnit)
    {
        $this->sourceUnit = $sourceUnit;
        $this->targetUnit = $targetUnit;
    }

    abstract public function convert(UnitInterface $sourceUnit, string $targetUnit): UnitInterface;
}
