<?php

/**
 * Create random string, $validChar consist of alphanumeric
 * minus identical character and number, default length of
 * returned string are 8.
 *
 * @return  string
 */
function createRandomString()
{
    $validChar = 'abcdefghkmnpqrtuvwxyzABCDEFGHKMNPQRTUVWXYZ346789';
    $stringLength = 8;
    $totalValidChars = strlen($validChar);
    $finalString = '';

    for ($i = 0; $i < $stringLength; $i++) {
        $finalString .= $validChar[mt_rand(1, $totalValidChars) - 1];
    }

    return $finalString;
}

/**
 * Quick and dirty conversion from Object to Array, this is dangerous
 * only used for query return AND only for 1-deep level.
 *
 * @param  object $data
 * @return array
 */
function objectToArray($data)
{
    foreach ($data as &$object) {
        $object = (array) $object;
    }

    return $data;
}

/**
 * Membuat judul navbar untuk kontraktor.
 *
 * @param  string $wkid
 * @return string
 */
function createNavTitle($wkid)
{
    $working_area_name = DB::table('working_area')
        ->where('id', '=', $wkid)
        ->value('working_area_name');

    $contractor_name = DB::table('contractor_working_area as cwa')
        ->leftJoin('contractor', 'cwa.contractor_id', '=', 'contractor.id')
        ->where('cwa.working_area_id', '=', $wkid)
        ->value('contractor.contractor_name');

    return $working_area_name . ' - ' . $contractor_name;
}