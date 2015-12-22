<?php

namespace App\Quinn;

use DB;

class Resources
{
    /**
     * Data provider untuk halaman resources index, berdasarkan list
     * wilayah kerja dan jumlah resources masing-masing.
     *
     * @return array
     */
    public static function montageTable()
    {
        $data = DB::table('working_area as wk')
            ->select([
                'wk.working_area_name',
            ])
            ->get();

        return $data;
    }
}