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
    return DB::table('working_area')
        ->where('id', '=', $wkid)
        ->value('working_area_name');
}

/**
 * Membuat nama Play dari data reservoir dan trap yang diberikan.
 *
 * @param  string $litho
 * @param  string $formation
 * @param  string $formationLvl
 * @param  string $agePeriod
 * @param  string $ageEpoch
 * @param  string $env
 * @param  string $trap
 * @return string
 */
function createPlayName($litho, $formation, $formationLvl, $agePeriod, $ageEpoch, $env, $trap)
{
    $name = '';

    if (!empty($litho)) {
        $name .= $litho . '-';
    }

    if (!empty($formationLvl)) {
        $name .= $formationLvl . ' ';
    }

    if (!empty($formation)) {
        $name .= $formation . '-';
    }

    if (!empty($ageEpoch)) {
        $name .= $ageEpoch . ' ';
    }

    if (!empty($agePeriod)) {
        $name .= $agePeriod . '-';
    }

    if (!empty($env)) {
        $name .= $env . '-';
    }

    if (!empty($trap)) {
        $name .= $trap;
    }

    return $name;
}

/**
 * Mengambil nama action yang telah dipanggil sebelumnya.
 *
 * @return string
 */
function actionName()
{
    return substr(Route::currentRouteAction(),
        strpos(Route::currentRouteAction(), '@') + 1);
}

/**
 * Mengambil nama controller dan menghilangkan string 'Controller'
 *
 * @return string
 */
function controllerName()
{
    return current(explode('Controller',
        explode("\\", Route::currentRouteAction())[3]));
}

/**
 * Mengambil tahun RPS berjalan.
 *
 * @return array
 */
function getActiveRPSYear()
{
    return DB::table('sys_year')
        ->where('is_active', '=', 1)
        ->first();
}

/**
 * Merubah name input html "parent[child]" menjadi "parent.child".
 *
 * @param  string $name
 * @return string
 */
function squareToDot($name)
{
    $name = str_replace('[', '.', $name);
    return str_replace(']', '', $name);
}

/**
 * Mengambil input terakhir array dalam string, "parent[child]"
 * mengembalikan "child".
 *
 * @param  string $name String dalam bentuk array
 * @param  string $append Untuk menambahkan string di akhir $name
 * @return string
 */
function extractSquare($name, $append = null, $omit = null)
{
    $name = array_values(
        array_slice(
            explode('.', squareToDot($name)), -1, 1, true))[0];

    if ($append) {
        $name = $name . $append;
    }

    if ($omit) {
        $name = str_replace($omit, '', $name);
    }

    return $name;
}