<?php 
namespace RhinoAfrica\UnitConversionObjects\Units;

use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;

class Gram extends BaseUnit
{
    public function __construct()
    {   
        // Unit type definition 
        $this->unitType = 'weight';
    }
}