<?php 
namespace RhinoAfrica\UnitConversionObjects\Units;

use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;

class Pound extends BaseUnit
{
    public function __construct()
    {   
        // Unit type definition 
        $this->unitType = 'weight';
    }
}