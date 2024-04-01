<?php 
namespace RhinoAfrica\UnitConversionObjects\Units;

use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;

class Kelvin extends BaseUnit
{
    public function __construct()
    {   
        // Unit type definition 
        $this->unitType = 'temperature';
    }
}