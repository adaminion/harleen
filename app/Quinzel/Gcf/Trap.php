<?php

namespace App\Quinzel\Gcf;

class Trap extends AbstractCategory
{
    public $category = 'trap';

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
        'continuity' => null,
        'sealType' => null,
        'geometry' => null,
        'trapType' => null
    ];

    /**
     * Semua konstanta pengali nilai factor Source Rock.
     *
     * @var array
     */
    public $constants = [
        'distribution' => 0.35,
        'continuity' => 0.25,
        'sealType' => 0.2,
        'geometry' => 0.1,
        'trapType' => 0.1
    ];

    /**
     * Semua opsi beserta nilai factor Source Rock.
     *
     * @var array
     */
    public static $options = [
        'distribution' => [
            'Single Distribution Impermeable Rocks' => 0.6,
            'Double Distribution Impermeable Rocks' => 0.8,
            'Multiple Distribution Impermeable Rocks' => 1,
        ],
        'continuity' => [
            'Tank' => 0.4,
            'Truncated' => 0.5,
            'Limited Spread' => 0.7,
            'Spread' => 0.9,
            'Extensive Spread' => 1,
        ],
        'sealType' => [
            'Primary' => 0.8,
            'Diagenetic' => 0.9,
            'Alternate Tectonic Mech' => 1,
        ],
        'geometry' => [
            'Anticline Hangingwall' => 0.9,
            'Anticline Footwall' => 1,
            'Anticline Pericline' => 0.9,
            'Anticline Dome' => 0.9,
            'Anticline Nose' => 0.9,
            'Anticline Unqualified' => 0.9,
            'Faulted Anticline Hangingwall' => 0.8,
            'Faulted Anticline Footwall' => 0.8,
            'Faulted Anticline Pericline' => 0.8,
            'Faulted Anticline Dome' => 0.8,
            'Faulted Anticline Nose' => 0.8,
            'Faulted Anticline Unqualified' => 0.8,
            'Tilted Hangingwall' => 0.7,
            'Tilted Fault Block Footwall' => 0.7,
            'Tilted Fault Block Terrace' => 0.7,
            'Tilted Fault Block Unqualified' => 0.7,
            'Horst Simple' => 0.6,
            'Horst Faulted' => 0.6,
            'Horst Complex' => 0.6,
            'Horst Unqualified' => 0.6,
            'Wedge Tilted' => 0.5,
            'Wedge Felxtured' => 0.5,
            'Wedge Radial' => 0.5,
            'Wedge Marginal' => 0.5,
            'Wedge Faulted' => 0.5,
            'Wedge Onlap' => 0.5,
            'Wedge Subcrop' => 0.5,
            'Wedge Unqualified' => 0.5,
            'Abutment Hangingwall' => 0.4,
            'Abutment Footwall' => 0.4,
            'Abutment Pericline' => 0.4,
            'Abutment Terrace' => 0.4,
            'Abutment Complex' => 0.4,
            'Abutment Unqualified' => 0.4,
            'Irregular Hangingwall' => 0.4,
            'Irregular Footwall' => 0.4,
            'Irregular Pericline' => 0.4,
            'Irregular Dome' => 0.4,
            'Irregular Terrace' => 0.4,
            'Irregular Unqualified' => 0.4,
        ],
        'trapType' => [
            'Structural Tectonic Extensional' => 0.6,
            'Structural Tectonic Compressional Thin Skinned' => 0.9,
            'Structural Tectonic Compressional Inverted' => 1,
            'Structural Tectonic Strike Slip' => 1,
            'Structural Tectonic Unqualified' => 0.8,
            'Structural Drape' => 0.8,
            'Structural Compactional' => 0.8,
            'Structural Diapiric Salt' => 0.7,
            'Structural Diapiric Mud' => 0.7,
            'Structural Diapiric Unqualified' => 0.7,
            'Structural Gravitational' => 0.6,
            'Structural Unqualified' => 0.6,
            'Stratigraphic Depositional Pinch Out' => 0.6,
            'Stratigraphic Depositional Shale Out' => 0.6,
            'Stratigraphic Depositional Facies Limited' => 0.6,
            'Stratigraphic Depositional Reef' => 1,
            'Stratigraphic Depositional Unqualified' => 0.6,
            'Stratigraphic Unconformity Subcrop' => 0.6,
            'Stratigraphic Unconformity Onlap' => 0.6,
            'Stratigraphic Unconformity Unqualified' => 0.6,
            'Stratigraphic Other Diagenetic' => 0.6,
            'Stratigraphic Other Tar Mat' => 0.6,
            'Stratigraphic Other Gas Hydrate' => 0.6,
            'Stratigraphic Other Permafrost' => 0.6,
            'Stratigraphic Unqualified' => 0.6,
        ],
        'closure' => [
            '2-Way' => 0,
            '3-Way' => 0,
            '4-Way' => 0,
        ],
    ];

    /**
     * Seluruh kemungkinan backward options untuk Trap
     *
     * @var array
     */
    public $backwardOptions = [
        'distribution' => [],
        'continuity' => [],
        'sealType' => [],
        'geometry' => [
            'Faulted' => 'Faulted Anticline Unqualified',
            'Faulted Anticline Unqualifed' => 'Faulted Anticline Unqualified',
            'Wedge TilTed' => 'Wedge Tilted',
        ],
        'trapType' => [
            'Stratigraphic Depositional Pinch-out' => 'Stratigraphic Depositional Pinch Out',
            'Stratigraphic Depositional Shale-out' => 'Stratigraphic Depositional Shale Out',
            'Stratigraphic Depositional Facies-limited' => 'Stratigraphic Depositional Facies Limited',
        ],
    ];

    public $pValue;

    public function __construct($distribution, $continuity, $sealType, $geometry, $trapType, $dataSource)
    {
        $this->setDataSource($dataSource);
        $this->factors['distribution'] = $distribution;
        $this->factors['continuity'] = $continuity;
        $this->factors['sealType'] = $sealType;
        $this->factors['geometry'] = $geometry;
        $this->factors['trapType'] = $trapType;
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
        $continuity = $this->getFactorValue('continuity', $this->factors['continuity']);
        $sealType = $this->getFactorValue('sealType', $this->factors['sealType']);
        $geometry = $this->getFactorValue('geometry', $this->factors['geometry']);
        $trapType = $this->getFactorValue('trapType', $this->factors['trapType']);

        $this->pValue = prescot($distribution + $continuity + $sealType + $geometry + $trapType);

        return $this->pValue;
    }
}