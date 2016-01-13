<?php

namespace App\Quinzel\Petro;

class FormationVolumeFactor
{
    protected $lowGasSG = 0.7341;
    protected $bestGasSG = 0.8285;
    protected $highGasSG = 0.9229;

    protected $lowApi = 36.5734;
    protected $bestApi = 37.5445;
    protected $highApi = 38.5157;

    public function bg($depth, $gasDensity = 'best')
    {
        $pressure = $this->pressure($depth);
        $temperature = $this->temperature($depth, 'Rankine');

        if ($gasDensity === 'low') {
            $gasSG = $this->lowGasSG;
        } elseif ($gasDensity === 'best') {
            $gasSG = $this->bestGasSG;
        } elseif ($gasDensity === 'high') {
            $gasSG = $this->highGasSG;
        }

        $z = $this->gasDeviationFactorCalc($pressure, $temperature, $gasSG);
        return 0.02827 * $z * $temperature / $pressure; // FVF
    }

    public function bo($depth, $oilDensity = 'best')
    {
        $pressure = $this->pressure($depth);
        $temp = $this->temperature($depth, 'Fahrenheit');

        $oilSG = 1;
        $oilApi = 10;
        $result = 1;

        if ($oilDensity === 'low') {
            $oilApi = $this->highApi;
            $oilSG = $this->convertToSG($this->highApi);
            $gasSG = $this->lowGasSG;
        } elseif ($oilDensity === 'high') {
            $oilApi = $lowApi;
            $oilSG = $this->convertToSG($this->lowApi);
            $gasSG = $highGasSG;
        } else {
            $oilApi = $this->bestApi;
            $oilSg = $this->convertToSG($this->bestApi);
            $gasSG = $this->bestGasSG;
        }

        $rs = $this->solutionGasRatio($pressure, $temp, $gasSG, $oilApi);
        $bob = $this->boBubblePoint($rs, $oilSG, $gasSG, $rs, $temp);
        $pb = $this->bubblePointPressureCalc($oilApi, $gasSG, $rs, $temp);
        $co = $this->oilCompressibilityCalc();

        if ($pressure > $pb) {
            $result = $bob * exp(-$co * ($pressure - $pb));
        } else {
            $result = $bob;
        }

        return $result;
    }

    private function gasDeviationFactorCalc($pressure, $temp, $gasSG)
    {
        $z = 1; // Ideal gas
        $y = 0.001; // Initial value

        // Perhitungan Pseudo parameter menggunakan Standing's Correlation
        $tpr = $this->pseudoReducedTemp($temp, $gasSG);
        $ppr = $this->pseudoReducedPressure($pressure, $gasSG);
        $t = $this->tConstant($tpr);

        $a = $this->aConstant($t);
        $x1 = $this->x1Constant($t);
        $x2 = $this->x2Constant($t);
        $x3 = $this->x3Constant($t);
        $yf = 1.0;

        $counterStrike = 0;
        while ($yf > pow(10, -8) && $counterStrike < 1000) {
            $yf = $this->yFunction($y, $ppr, $a, $x1, $x2, $x3);
            $dyf = $this->dyFunction($y, $x1, $x2, $x3);
            $y = $y - ($yf / $dyf);
            $counterStrike += 1;
        }

        if ($counterStrike >= 1000) {
            var_dump("Solusi menjadi divergent");die();
        }

        return $a * $ppr / $y;
    }

    private function yFunction($y, $ppr, $a, $x1, $x2, $x3)
    {
        $part1 = $a * $ppr;
        $part2 = ($y + pow($y, 2.0) + pow($y, 3.0) + pow($y, 4.0)) / pow(1 - $y, 4.0);
        $part3 = 2.0 * $x1 * $y;
        $part4 = $x2 * $x3 * pow($y, $x3 - 1);

        return -$part1 + $part2 - $part3 + $part4;
    }

    private function dyFunction($y, $x1, $x2, $x3)
    {
        $part1 = (1.0 + 4.0 * $y + 4.0 * pow($y, 2.0) - 4.0 * pow($y, 3.0) + pow($y, 4.0)) / pow(1 - $y, 4.0);
        $part2 = 2.0 * $x1 * $y;
        $part3 = $x2 * $x3 * pow($y, $x3 - 1);

        return $part1 - $part2 + $part3;
    }

    private function tConstant($tpr)
    {
        return 1.0 / $tpr;
    }

    private function aConstant($t)
    {
        return 0.06125 * $t * exp(-1.2 * (1 - $t) * (1 - $t));
    }

    private function x1Constant($t)
    {
        return 14.76 * $t - 9.76 * $t * $t + 4.58 * $t * $t * $t;
    }

    private function x2Constant($t)
    {
        return 90.7 * $t - 242.2 * $t * $t + 4.4 * $t * $t * $t;
    }

    private function x3Constant($t)
    {
        return 2.18 + 2.82 * $t;
    }

    private function pseudoReducedTemp($temp, $gasSG)
    {
        return $temp / $this->pseudoCriticalTemp($gasSG);
    }

    private function pseudoReducedPressure($pressure, $gasSG)
    {
        return $pressure / $this->pseudoCriticalPressure($gasSG);
    }

    private function pseudoCriticalTemp($gasSG)
    {
        if ($gasSG < 0.75) {
            return 168 + 325 * $gasSG - 12.5 * $gasSG * $gasSG;
        } elseif ($gasSG = 1) {
            return 445.5;
        } else {
            return 187 * 330 * $gasSG = 71.5 * $gasSG * $gasSG;
        }
    }

    private function pseudoCriticalPressure($gasSG)
    {
        if ($gasSG == 1) {
            return 746.6;
        } elseif ($gasSG < 0.75) {
            return 677 + 15 * $gasSG - 37.5 * $gasSG * $gasSG;
        } else {
            return 706 + 51.7 * $gasSG - 11.1 * $gasSG * $gasSG;
        }
    }

    private function pressure($depth)
    {
        return 0.401 * $depth + 65.332;
    }

    public function temperature($depth, $tempType)
    {
        $temp = 0.023 * $depth + 120.41;

        if ($tempType === 'Rankine') {
            return $temp + 459.67;
        } else {
            return $temp;
        }
    }

    private function convertToSG($api)
    {
        return 141.5 / (131.5 + $api);
    }

    private function convertToApi($oilSG)
    {
        return 141.5 / $oilSG - 131.5;
    }

    private function solutionGasRatio($pressure, $temp, $gasSG, $oilApi)
    {
        return $gasSG * pow((0.055 * $pressure + 1.4) * pow(10, 0.0125 * $oilApi) / pow(10, 0.00091 * $temp), 1.205);
    }

    private function boBubblePoint($rs, $oilSG, $gasSG, $temp)
    {
        $a = $rs * pow($gasSG / $oilSG, 0.5) + 1.25 * $temp;

        return 0.9759 + (1.2 * pow(10, -4)) * pow($a, 1.2);
    }

    private function bubblePointPressureCalc($oilApi, $gasSG, $rs, $temp)
    {
        return 18.2 * pow($rs / $gasSG, 0.83) * pow(10, 0.00091 * $temp - 0.0125 * $oilApi) - 1.4;
    }

    private function oilCompressibilityCalc()
    {
        return 5 * pow(10, -5);
    }
}
