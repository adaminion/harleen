<?php

namespace App\Quinzel\Gcf;

class Gcf
{
    /**
     * Source Rock class instance.
     *
     * @var object
     */
    public $sourceRock;

    /**
     * Reservoir class instance.
     *
     * @var object
     */
    public $reservoir;

    /**
     * Trap class instance.
     *
     * @var object
     */
    public $trap;

    /**
     * Dynamic class instance.
     *
     * @var object
     */
    public $dynamic;

    /**
     * Dibutuhkan 4 kategori, yaitu; Source Rock, Reservoir, Trap, Dynamic.
     *
     * @param object $sourceRock
     * @param object $reservoir
     * @param object $trap
     * @param object $dynamic
     * @return void
     */
    public function __construct($sourceRock, $reservoir, $trap, $dynamic)
    {
        $this->sourceRock = $sourceRock;
        $this->reservoir = $reservoir;
        $this->trap = $trap;
        $this->dynamic = $dynamic;
    }

    /**
     * Menghitung nilai RCI (Resources Classification Index) berdasarkan
     * klasifikasi yang diberikan, $class hanya dapat berisi;
     * 'Play', 'Lead', 'Drillable', 'Postdrill', 'Discovery'.
     *
     * @param string $class
     * @return float
     */
    public function rci($class)
    {
        if ($class != PLAY
            && $class != LEAD
            && $class != DRILLABLE
            && $class != POSTDRILL
            && $class != DISCOVERY
        ) {
            new FError('error', 'perhitungan', $this->category,
                "Klasifikasi {$class} tidak ditemukan");
        }

        $gcf = $this->gcf();
        $rci = 0;

        if ($class === PLAY) {
            $rci = $gcf * 0.2;
        } elseif ($class === LEAD) {
            $rci = 0.1 + ($gcf * 0.5);
        } elseif ($class === DRILLABLE) {
            $rci = 0.3 + ($gcf * 0.65);
        } elseif ($class === POSTDRILL) {
            $rci = 0.3 + ($gcf * 0.7);
        } elseif ($class === DISCOVERY) {
            $rci = 1.0;
        }

        return prescot($rci);
    }

    /**
     * Menghitung nilai GCF (Geological Chance Factor) dengan menggunakan
     * metode Otis.
     *
     * @return float
     */
    public function gcf()
    {
        return prescot($this->sourceRock->probability()
            * $this->reservoir->probability()
            * $this->trap->probability()
            * $this->dynamic->probability());
    }
}