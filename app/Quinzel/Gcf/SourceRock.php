<?php

namespace App\Quinzel\Gcf;

class SourceRock extends AbstractCategory
{
    public $category = 'sourceRock';

    /**
     * Sumber data Source Rock, Proven atau Analog.
     *
     * @var string
     */
    public $dataSource;

    /**
     * Semua factor yang menyangkut perhitungan Source Rock.
     *
     * @var array
     */
    public $factors = [
        'kerogen' => null,
        'toc' => null,
        'hfu' => null,
        'maturity' => null,
        'other' => null
    ];

    /**
     * Semua konstanta pengali nilai factor Source Rock.
     *
     * @var array
     */
    public $constants = [
        'kerogen' => 0.15,
        'toc' => 0.3,
        'hfu' => 0.07,
        'maturity' => 0.45,
        'other' => 0.03
    ];

    /**
     * Semua opsi beserta nilai factor Source Rock.
     *
     * @var array
     */
    public static $options = [
        'kerogen' => [
            'I' => 1,
            'I/II' => 0.9,
            'II' => 0.8,
            'II/III' => 0.7,
            'III' => 0.6,
            'IV' => 0.1,
        ],
        'toc' => [
            '0 - 0.5' => 0.2,
            '0.6 - 1.0' => 0.6,
            '1.1 - 2.0' => 0.7,
            '2.1 - 4.0' => 0.8,
            '> 4' => 1
        ],
        'hfu' => [
            '0 - 1.0' => 0.5,
            '1.1 - 2.0' => 0.7,
            '2.1 - 3.0' => 0.9,
            '> 3.0' => 1
        ],
        'distribution' => [
            'Localized' => 0,
            'Multiple Limited' => 0,
            'Multiple Wide' => 0,
            'Single Limited' => 0,
            'Single Wide' => 0
        ],
        'continuity' => [
            'Bad' => 0,
            'Fair' => 0,
            'Good' => 0,
            'Very Good' => 0
        ],
        'maturity' => [
            'Immature' => 0.1,
            'Early Mature' => 0.4,
            'Mature' => 1,
            'Overmature' => 0.8,
        ],
        'other' => [
            'Yes' => 1,
            'No' => 0
        ],
    ];

    /**
     * Seluruh kemungkinan backward options untuk Source Rock
     *
     * @var array
     */
    public $backwardOptions = [
        'kerogen' => [
        ],
        'toc' => [
        ],
        'hfu' => [
            '<= 1.0' => '0 - 1.0',
        ],
        'maturity' => [
            'Over Mature' => 'Overmature',
        ],
        'other' => []
    ];

    /**
     * Menyimpan hasil perhitungan probabilitas
     *
     * @var float
     */
    public $pValue;

    public function __construct($kerogen, $toc, $hfu, $maturity, $other, $dataSource)
    {
        $this->setDataSource($dataSource);
        $this->factors['kerogen'] = $kerogen;
        $this->factors['toc'] = $toc;
        $this->factors['hfu'] = $hfu;
        $this->factors['maturity'] = $maturity;
        $this->factors['other'] = $other;
    }

    /**
     * Menghitung probabilitas Source Rock, output nilai maksimal
     * 1, sumber data 'Proven' atau 'Analog' berpengaruh pada
     * nilai yang akan dihitung.
     *
     * @return float
     */
    public function probability()
    {
        // Tidak perlu menghitung GCF jika Source Rock Maturity
        // terisi 'Immature'
        if ($this->factors['maturity'] === 'Immature') {
            return 0.125;
        }

        $kerogen = $this->getFactorValue('kerogen', $this->factors['kerogen']);
        $toc = $this->getFactorValue('toc', $this->factors['toc']);
        $hfu = $this->getFactorValue('hfu', $this->factors['hfu']);
        $maturity = $this->getFactorValue('maturity', $this->factors['maturity']);
        $other = $this->getFactorValue('other', $this->factors['other']);

        $this->pValue = prescot($kerogen + $toc + $hfu + $maturity + $other);

        return $this->pValue;
    }
}