<?php

/**
 * Create random string, $validChar consist of alphanumeric
 * minus identical character and number, default length of
 * returned string are 8.
 *
 * @return string
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
 * @param object $data
 * @return array
 */
function objectToArray($data)
{
    foreach ($data as &$object) {
        $object = (array) $object;
    }

    return $data;
}
