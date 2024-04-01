<?php
namespace RhinoAfrica\UnitConversionObjects\Converters;

use Illuminate\Http\Response;
use RhinoAfrica\UnitConversionObjects\Interfaces\UnitInterface;
use RhinoAfrica\UnitConversionObjects\Units\BaseUnit;
use RhinoAfrica\UnitConversionObjects\Units\Celsius;
use RhinoAfrica\UnitConversionObjects\Units\Kelvin;
use RhinoAfrica\UnitConversionObjects\Units\Fahrenheit;

/**
 * Conversion Strategy Class for Temperture conversion units, extending AbstractConverter
 */
class TemperatureConverter extends AbstractConverter
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
      
        if ($sourceType !== 'temperature') {
            throw new \Exception("Incompatible unit type for TemperatureConverter.");
        }

        switch ($sourceUnit::class) {
            case Celsius::class:
                return $this->convertFromCelsius($sourceValue, $targetUnit);
            case Kelvin::class:
                return $this->convertFromKelvin($sourceValue, $targetUnit);
            case Fahrenheit::class:
                return $this->convertFromFahrenheit($sourceValue, $targetUnit);
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
    private function convertFromCelsius(float $value, string $targetUnit): BaseUnit
    {
        switch ($targetUnit) {
            case 'celsius':
                $convertedValue = $value + 273.15;
                $target = new Celsius();
                break;
            case 'kelvin':
                $convertedValue = $value + 273.15;
                $target = new Kelvin();
                break;
            case 'fahrenheit':
                $convertedValue = ($value * (9/5)) + 32;
                $target = new Kelvin();
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
    private function convertFromKelvin(float $value, string $targetUnit): UnitInterface {
        switch ($targetUnit) {
            case 'celsius':
                $convertedValue = $value - 273.15;
                $target = new Celsius();
                break;
            case 'fahrenheit':
                $convertedValue = (($value - 273.15) * (9/5)) + 32;
                $target = new Kelvin();
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
     * @return UnitInterface
     * @throws \Exception
     */
    private function convertFromFahrenheit(float $value, string $targetUnit): UnitInterface {
        switch ($targetUnit) {
            case 'celsius':
                $convertedValue = ($value - 32) * 5/9;
                $target = new Celsius();
                break;
            case 'kelvin':
                $convertedValue = (($value -  32) * (5/9)) + 273.15 ;
                $target = new Kelvin();
                break;
            default:
                // throw new \Exception("Unsupported target unit.",Response::HTTP_UNPROCESSABLE_ENTITY);
                throw new \Exception("Unsupported target unit.",404);
        }
        $target->setValue(round($convertedValue,2));
        return $target;
    }
}