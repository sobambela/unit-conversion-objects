<?php
namespace RhinoAfrica\UnitConversionObjects\Services;

use RhinoAfrica\UnitConversionObjects\Interfaces\ConverterInterface;
use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;
use Illuminate\Http\Response;

/**
 * Uniy Conversion Service Class Object
 */
class UnitConversionService
{
//    /**
//     * @var UnitInterface $sourceUnit
//     */
//    private UnitInterface $sourceUnit;
//
//    /**
//     * @var ConverterInterface $unitConverter
//     */
//    private ConverterInterface $unitConverter;

    /**
     * @param $sourceUnit
     * @param $value
     * @return void
     * @throws \Exception
     */
    public function setSourceUnit($sourceUnit,$value): void
    {
        throw new \Exception("Incompatible source unit type for Converter.",Response::HTTP_UNPROCESSABLE_ENTITY);
    }

//    /**
//     * @param $sourceUnit
//     * @param $value
//     * @return void
//     * @throws \Exception
//     */
//    public function setSourceUnit($sourceUnit,$value): void
//    {
//        $className = 'RhinoAfrica\\UnitConversionObjects\\Units\\'.ucfirst($sourceUnit);
//        if (!class_exists($className)) {
//            throw new \Exception("Incompatible source unit type for Converter.",Response::HTTP_UNPROCESSABLE_ENTITY);
//        }
//
//        $this->sourceUnit = new $className();
//        $this->sourceUnit->setValue($value);
//        $converter = $this->sourceUnit->getUnitType();
//        $converterClassName = 'RhinoAfrica\\UnitConversionObjects\\Converters\\'.ucfirst($converter).'Converter';
//        if (!class_exists($converterClassName)) {
//            throw new \Exception("Incompatible target unit type for Converter.",Response::HTTP_UNPROCESSABLE_ENTITY);
//        }
//        $this->unitConverter = new $converterClassName();
//    }

//    /**
//     * @param string $targetType
//     * @return UnitInterface|null
//     */
//    public function convert(string $targetType): ?UnitInterface
//    {
//        return $this->unitConverter->convert($this->sourceUnit, $targetType);
//    }
}
