<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 26.09.2015
 * Time: 12:05
 */

namespace NovaPoshta_Address\Base;


class Helper
{
    public static function object2object($objectFrom, $objectTo)
    {
        foreach ($objectTo as $kAttr => $vAttr) {
            if (isset($objectFrom->$kAttr)) {
                $objectTo->{$kAttr} = $objectFrom->{$kAttr};
            }
        }

        return $objectTo;
    }

    public static function deleteScope($str)
    {
        $str = preg_replace('/\\s*\\([^()]*\\)\\s*/', '', $str);
        if($strNew = stristr($str, '(', true)){
            $str = $strNew;
        }
        $str = trim($str);
        return $str;
    }
}