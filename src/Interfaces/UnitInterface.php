<?php
namespace RhinoAfrica\UnitConversionObjects\Interfaces;

/**
 * Common interface for all units, containing the following method signatures:
 *   getValue(): float, setValue(float $value): void and getUnitType(): string
 */
interface UnitInterface
{
    public function getValue(): float;
    public function setValue(float $value): void;
    public function getUnitType(): string;
}
