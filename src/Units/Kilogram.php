<?php 
namespace RhinoAfrica\UnitConversionObjects\Units;

use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;

class Kilogram extends BaseUnit
{
    public function __construct()
    {   
        // Unit type definition 
        $this->unitType = 'weight';
    }
}