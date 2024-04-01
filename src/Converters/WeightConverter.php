<?php
namespace RhinoAfrica\UnitConversionObjects\Converters;

use Illuminate\Http\Response;
use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;
use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;
use RhinoAfrica\UnitConversionObjects\Units\Gram;
use RhinoAfrica\UnitConversionObjects\Units\Kilogram;
use RhinoAfrica\UnitConversionObjects\Units\Pound;

/**
 * Conversion Strategy Class for Temperture conversion units, extending AbstractConverter
 */
class WeightConverter extends AbstractConverter
{

    /**
     * @param BaseUnit $sourceUnit
     * @param string $targetUnit
     * @return BaseUnit
     * @throws \Exception
     */
    public function convert(BaseUnit $sourceUnit, string $targetUnit): BaseUnit
    {
        $sourceValue = $sourceUnit->getValue();
        $sourceType = $sourceUnit->getUnitType();
      
        if ($sourceType !== 'weight') {
            throw new \Exception("Incompatible unit type for WeightConverter.");
        }

        switch ($sourceUnit::class) {
            case Gram::class:
                return $this->convertFromGram($sourceValue, $targetUnit);
            case Kilogram::class:
                return $this->convertFromKilogram($sourceValue, $targetUnit);
            case Pound::class:
                return $this->convertFromPound($sourceValue, $targetUnit);
            default:
                throw new \Exception("Unsupported source unit.");
        }
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return BaseUnit
     * @throws \Exception
     */
    private function convertFromGram(float $value, string $targetUnit): BaseUnit
    {
        switch ($targetUnit) {
            case 'kilogram':
                $convertedValue = $value / 1000;
                $target = new Kilogram();
                break;
            case 'pound':
                $convertedValue = $value / 453.6;
                $target = new Pound();
                break;
            default:
                throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $target->setValue(round($convertedValue,3));
        return $target;
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return BaseUnit
     * @throws \Exception
     */
    private function convertFromKilogram(float $value, string $targetUnit): BaseUnit
    {
        switch ($targetUnit) {
            case 'gram':
                $convertedValue = $value * 1000;
                $target = new Gram();
                break;
            case 'pound':
                $convertedValue = $value * 2.205;
                $target = new Pound();
                break;
            default:
                throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $target->setValue(round($convertedValue,2));
        return $target;
    }

    /**
     * @param float $value
     * @param string $targetUnit
     * @return BaseUnit
     * @throws \Exception
     */
    private function convertFromPound(float $value, string $targetUnit): BaseUnit
    {
        switch ($targetUnit) {
            case 'gram':
                $convertedValue = $value * 453.6;
                $target = new Pound();
                break;
            case 'kilogram':
                $convertedValue = $value / 2.205;
                $target = new Kilogram();
                break;
            default:
                throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $target->setValue(round($convertedValue,3));
        return $target;
    }
}