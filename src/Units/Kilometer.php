<?php 
namespace RhinoAfrica\UnitConversionObjects\Units;

use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;

class Kilometer extends BaseUnit
{
    public function __construct()
    {   
        // Unit type definition 
        $this->unitType = 'length';
    }
}