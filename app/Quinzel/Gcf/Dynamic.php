<?php

namespace App\Quinzel\Gcf;

class Dynamic extends AbstractCategory
{
    public $category = 'dynamic';

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
        'kitchen' => null,
        'tectonic' => null,
        'preservation' => null,
        'pathway' => null
    ];

    /**
     * Semua konstanta pengali nilai factor Source Rock.
     *
     * @var array
     */
    public $constants = [
        'kitchen' => 0.4,
        'tectonic' => 0.1,
        'preservation' => 0.25,
        'pathway' => 0.25
    ];

    /**
     * Semua opsi beserta nilai factor Source Rock.
     *
     * @var array
     */
    public static $options = [
        'migration' => [
            'Near By Well Discovery' => 0,
            'Oil Seep' => 0,
            'Oil Trace' => 0,
        ],
        'kitchen' => [
            'Very Near (0 - 2 Km)' => 1,
            'Near (2 - 5 Km)' => 0.9,
            'Middle (5 - 10 Km)' => 0.8,
            'Long (10 - 20 Km)' => 0.7,
            'Very Long (> 20 Km)' => 0.5,
        ],
        'tectonic' => [
            'Single Order' => 0.7,
            'Multiple Order' => 1,
        ],
        'preservation' => [
            'Not Occur' => 0.2,
            'Occur' => 1,
        ],
        'pathway' => [
            'Vertical' => 0.7,
            'Horizontal' => 0.8,
            'Multiple Directions' => 1,
        ]
    ];

    /**
     * Seluruh kemungkinan backward options untuk Trap
     *
     * @var array
     */
    public $backwardOptions = [
        'kitchen' => [],
        'tectonic' => [],
        'preservation' => [],
        'pathway' => [
            'Multiple Direction' => 'Multiple Directions'
        ]
    ];

    public $pValue;

    public function __construct($kitchen, $tectonic, $preservation, $pathway, $dataSource)
    {
        $this->setDataSource($dataSource);
        $this->factors['kitchen'] = $kitchen;
        $this->factors['tectonic'] = $tectonic;
        $this->factors['preservation'] = $preservation;
        $this->factors['pathway'] = $pathway;
    }

    /**
     * Menghitung probabilitas Source Rock, output nilai maksimal
     * 1, sumber data 'Proven' atau 'Analog' berpengaruh pada
     * nilai yang akan dihitung.
     *
     * @return flost
     */
    public function probability()
    {
        $kitchen = $this->getFactorValue('kitchen', $this->factors['kitchen']);
        $tectonic = $this->getFactorValue('tectonic', $this->factors['tectonic']);
        $preservation = $this->getFactorValue('preservation', $this->factors['preservation']);
        $pathway = $this->getFactorValue('pathway', $this->factors['pathway']);

        $this->pValue = prescot($kitchen + $tectonic + $preservation + $pathway);

        return $this->pValue;
    }
}