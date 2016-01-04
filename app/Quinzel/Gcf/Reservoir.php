<?php

namespace App\Quinzel\Gcf;

class Reservoir extends AbstractCategory
{
    public $category = 'reservoir';

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
        'distribution' => null,
        'lithology' => null,
        'primary' => null,
        'secondary' => null
    ];

    /**
     * Semua konstanta pengali nilai factor Source Rock.
     *
     * @var array
     */
    public $constants = [
        'distribution' => 0.2,
        'lithology' => 0.2,
        'primary' => 0.4,
        'secondary' => 0.2
    ];

    /**
     * Semua opsi beserta nilai factor Source Rock.
     *
     * @var array
     */
    public static $options = [
        'setting' => [
            'Aeolian' => 0,
            'Bathyal' => 0,
            'Coastal' => 0,
            'Continental Fan' => 0,
            'Delta Slope' => 0,
            'Delta Top' => 0,
            'Deltaic' => 0,
            'Fluvial' => 0,
            'Glacial' => 0,
            'Lacustrine' => 0,
            'Marine Shelf' => 0,
            'Marine Shoreface' => 0,
            'Reefal' => 0,
            'Paralic' => 0,
            'Platform Margin' => 0,
        ],
        'environment' => [
            'Aeolian Dune' => 0,
            'Alluvial Fan' => 0,
            'Barrier Bar' => 0,
            'Barrier Reef' => 0,
            'Deep Sea Sand Channel' => 0,
            'Deep Sea Sand Fan' => 0,
            'Deltaic Distributed Channel' => 0,
            'Deltaic Distributed Mud Bar' => 0,
            'Fluviatile Braided' => 0,
            'Fluviatile Meandering' => 0,
            'Issolated Reef' => 0,
            'Lagoon' => 0,
            'Patch Reef' => 0,
            'Financle Reef' => 0,
            'Platformal Reef' => 0,
            'Regressive Reer' => 0,
            'Regressive Sand' => 0,
            'Ridge' => 0,
            'Schoals Reef' => 0,
            'Tidal Flat' => 0,
            'Tidal Sand' => 0,
            'Transgressive Sand' => 0,
            'Others' => 0,
        ],
        'distribution' => [
            'Single Distribution' => 1,
            'Double Distribution' => 0.8,
            'Multiple Distribution' => 0.7,
        ],
        'continuity' => [
            'Extensive Spread' => 0,
            'Limited Spread' => 0,
            'Spread' => 0,
            'Tank' => 0,
            'Truncated' => 0,
        ],
        'lithology' => [
            'Siltstone' => 0.5,
            'Sandstone' => 1,
            'Reef Carbonate' => 1,
            'Platform Carbonate' => 0.5,
            'Coal' => 0.6,
            'Alternated Rocks' => 0.5,
            'Naturally Fractured' => 0.7,
            'Basement Fractured' => 0.7,
            'Others' => 0.3,
        ],
        'primary' => [
            '0 - 10' => 0.4,
            '11 - 15' => 0.6,
            '16 - 20' => 0.7,
            '21 - 30' => 0.9,
            '> 30' => 1,
        ],
        'secondary' => [
            'Vugs Porosity' => 0.4,
            'Fracture Porosity' => 0.9,
            'Integrated Porosity' => 1,
            'None' => 0,
        ]
    ];

    /**
     * Seluruh kemungkinan backward options untuk Reservoir
     *
     * @var array
     */
    public $backwardOptions = [
        'distribution' => [],
        'distribution' => [
            'Financle Reef' => 'Pinnacle Reef',
        ],
        'lithology' => [
            'Basement Fracture' => 'Basement Fractured',
        ],
        'primary' => [],
        'secondary' => [
            'Vugs porosity' => 'Vugs Porosity',
        ]
    ];

    public $pValue;

    public function __construct($distribution, $lithology, $primary, $secondary, $dataSource)
    {
        $this->setDataSource($dataSource);
        $this->factors['distribution'] = $distribution;
        $this->factors['lithology'] = $lithology;
        $this->factors['primary'] = $primary;
        $this->factors['secondary'] = $secondary;
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
        $distribution = $this->getFactorValue('distribution', $this->factors['distribution']);
        $lithology = $this->getFactorValue('lithology', $this->factors['lithology']);
        $primary = $this->getFactorValue('primary', $this->factors['primary']);
        $secondary = $this->getFactorValue('secondary', $this->factors['secondary']);

        $this->pValue = prescot($distribution + $lithology + $primary + $secondary);

        return $this->pValue;
    }
}