<?php

namespace App\Quinn;

use DB;

class Resources
{
    /**
     * Data provider untuk halaman resources index, berdasarkan list
     * wilayah kerja dan jumlah resources masing-masing.
     *
     * @param  string $basinSeparator Separator untuk basin WK INDONESIA
     * @return array
     */
    public static function workingAreaTotal($basinSeparator = ',')
    {
        $data = DB::table('working_area as wk')
            ->select([
                'basin.sequence',
                'wk.working_area_name',
                DB::raw("GROUP_CONCAT(bwk.basin_name SEPARATOR '$basinSeparator')
                    as basin"),
                DB::raw("(SELECT COUNT(1) FROM play
                    WHERE working_area_id = wk.id) play"),
                DB::raw("(SELECT COUNT(1) FROM lead
                    WHERE working_area_id = wk.id) lead"),
                DB::raw("(SELECT COUNT(1) FROM drillable
                    WHERE working_area_id = wk.id) drillable"),
                DB::raw("(SELECT COUNT(1) FROM postdrill
                    WHERE working_area_id = wk.id) postdrill"),
                DB::raw("(SELECT COUNT(1) FROM discovery
                    WHERE working_area_id = wk.id) discovery"),
            ])
            ->leftJoin('basin_working_area as bwk', 'wk.id', '=', 'bwk.working_area_id')
            ->leftJoin('basin', 'bwk.basin_name', '=', 'basin.basin_name')
            ->groupBy('wk.id')
            ->orderBy('basin.sequence')
            ->get();

        return $data;
    }
}