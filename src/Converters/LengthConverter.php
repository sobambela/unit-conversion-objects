<?php
namespace RhinoAfrica\UnitConversionObjects\Converters;

use Illuminate\Http\Response;
use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;
use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;
use RhinoAfrica\UnitConversionObjects\Units\Kilometer;
use RhinoAfrica\UnitConversionObjects\Units\Meter;
use RhinoAfrica\UnitConversionObjects\Units\Mile;

/**
 * Conversion Strategy Class for Lenth conversion units, extending AbstractConverter
 */
class LengthConverter extends AbstractConverter
{

    /**
     * @param UnitInterface $sourceUnit
     * @param string $targetUnit
     * @return UnitInterface
     * @throws \Exception
     */
    public function convert(BaseUnit $sourceUnit, string $targetUnit): BaseUnit
    {
        $sourceValue = $sourceUnit->getValue();
        $sourceType = $sourceUnit->getUnitType();
      
        if ($sourceType !== 'length') {
            throw new \Exception("Incompatible unit type for LengthConverter.");
        }

        switch ($sourceUnit::class) {
            case Meter::class:
                return $this->convertFromMeter($sourceValue, $targetUnit);
            case Kilometer::class:
                return $this->convertFromKilometer($sourceValue, $targetUnit);
            case Mile::class:
                return $this->convertFromMile($sourceValue, $targetUnit);
            default:
                throw new \Exception("Unsupported source unit.");
        }
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return UnitInterface
     * @throws \Exception
     */
    private function convertFromMeter(float $value, string $targetUnit): BaseUnit
    {
        switch ($targetUnit) {
            case 'kilometer':
                $convertedValue = $value / 1000;
                $target = new Kilometer();
                break;
            case 'mile':
                $convertedValue = $value / 1609.34;
                $target = new Mile();
                break;
            default:
                throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
                // throw new \Exception("Unsupported target unit.",404);
        }
        $target->setValue(round($convertedValue,2));
        return $target;
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return UnitInterface
     * @throws \Exception
     */
    private function convertFromKilometer(float $value, string $targetUnit): UnitInterface {
        switch ($targetUnit) {
            case 'meter':
                $convertedValue = $value * 1000;
                $target = new Meter();
                break;
            case 'mile':
                $convertedValue = $value / 1.60934;
                $target = new Mile();
                break;
            default:
                // throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
                throw new \Exception("Unsupported target unit.",404);
        }
        $target->setValue(round($convertedValue,2));
        return $target;
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return UnitInterface
     * @throws \Exception
     */
    private function convertFromMile(float $value, string $targetUnit): UnitInterface {
        switch ($targetUnit) {
            case 'meter':
                $convertedValue = $value * 1609.34;
                $target = new Meter();
                break;
            case 'kilometer':
                $convertedValue = $value * 1.60934;
                $target = new Kilometer();
                break;
            default:
                // throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
                throw new \Exception("Unsupported target unit.",404);
        }
        $target->setValue(round($convertedValue,2));
        return $target;
    }
}