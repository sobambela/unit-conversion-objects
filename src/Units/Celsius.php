<?php 
namespace RhinoAfrica\UnitConversionObjects\Units;

use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;

class Celsius extends BaseUnit
{
    public function __construct()
    {   
        // Unit type definition 
        $this->unitType = 'temperature';
    }
}