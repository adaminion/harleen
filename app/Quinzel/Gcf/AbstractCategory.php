<?php

namespace App\Quinzel\Gcf;

abstract class AbstractCategory
{
    abstract public function probability();

    /**
     * Mengatur sumber data, dalam hal ini sumber data haruslah
     * 'Proven' atau 'Analog'.
     *
     * @param string $dataSource
     * @return void
     */
    public function setDataSource($dataSource)
    {
        if ($dataSource != 'Proven' && $dataSource != 'Analog') {
            new FError('error', 'perhitungan', $this->category,
                "dataSource haruslah Proven atau Analog, bukan $dataSource");
        }

        $this->dataSource = $dataSource;
    }

    /**
     * Mengambil nilai sumber data.
     *
     * @return string
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * Mengambil kumpulan opsi.
     *
     * @return array
     */
    public static function getOptions()
    {
        return $this->options;
    }

    /**
     * Mengambil kumpulan opsi untuk faktor tertentu
     *
     * @param  string $factor
     * @raturn array
     */
    public static function factorOptions($factor)
    {
        $options = array_keys(static::$options[$factor]);

        return array_combine($options, $options);
    }

    /**
     * Mengambil kumpulan nilai konstanta.
     *
     * @return array
     */
    public static function getConstants()
    {
        return $this->constants;
    }

    /**
     * Mengambil kumpulan faktor.
     *
     * @return array
     */
    public static function getFactors()
    {
        return $this->factors;
    }

    /**
     * Konversi nilai Proven ke Analog.
     *
     * @param float @provenValue
     * @return float
     */
    public function toAnalog($provenValue)
    {
        return 0.4 * $provenValue + 0.3;
    }

    /**
     * Mencari nilai faktor, jika $factorOption terdapat pada
     * opsi faktor maka hasilnya akan dikalikan terlebih dahulu
     * dengan konstanta faktor.
     *
     * Penentuan nilai faktor berpengaruh dengan $dataSource
     * jika $dataSource 'Analog' maka hasilnya akan dihitung
     * dengan method toAnalog().
     *
     * @param string $factor
     * @param string $factorOption
     * @return float
     */
    public function getFactorValue($factor, $factorOption)
    {
        if ($this->isFactorEmpty($factorOption)) {
            return 0.5;
        }

        // Cek jika $factorOption terdapat pada pada $factor yang diberikan
        if (!array_key_exists($factorOption, $this->options[$factor])) {
            // Jika $factorOption tidak terdapat pada $factor, maka lihat
            // apakah pada $backwardOptions dapat dimigrasikan dengan
            // opsi faktor yang baru
            if ($this->_isBackward($factor, $factorOption)) {
                $factorOption = $this->backwardOptions[$factor][$factorOption];
            } else {
                new FError('error', 'perhitungan', $this->category,
                    "Tidak ada opsi $factorOption pada $factor");
            }
        }

        if ($this->dataSource === 'Analog') {
            $value = $this->toAnalog($this->options[$factor][$factorOption]);
        } else {
            $value = $this->options[$factor][$factorOption];
        }

        return $value * $this->constants[$factor];
    }

    /**
     * Cek jika $value kosong, 'Not Available' dan 'Unknown' juga dianggap
     * nilai yang kosong.
     *
     * @param string $factorOption
     * @return boolean
     *
     */
    public function isFactorEmpty($factorOption)
    {
        if (empty($factorOption)
            || $factorOption === 'Not Available'
            || $factorOption === 'Unknown'
        ) {
            return true;
        }

        return false;
    }

    private function _isBackward($factor, $factorOption)
    {
        if (array_key_exists($factorOption, $this->backwardOptions[$factor])) {
            return true;
        }

        return false;
    }
}
