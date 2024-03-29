<?php
namespace RhinoAfrica\UnitConversionObjects\Units;

use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;

/**
 * An abstract class implementing UnitInterface, providing basic value get/set operations,
 * leaving unit-specific implementation to child classes.
 */
abstract class BaseUnit implements UnitInterface
{
    /**
     * @var float $value
     */
    protected float $value;

    /**\
     * @var string $unitType
     */
    protected ?string $unitType = null;

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    } 

    /**
     * @return void
     */
    public function setValue(float $value): void
    {
        $this->value = $value;
    } 

    /**
     * @return string
     */
    public function getUnitType(): string
    {
        return $this->unitType;
    } 
}
