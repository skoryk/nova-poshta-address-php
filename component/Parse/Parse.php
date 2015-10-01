<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 30.09.2015
 * Time: 20:30
 */

namespace NovaPoshta_Address\Parse;


use NovaPoshta_Address\Data\Data;

abstract class Parse
{
    protected $data;

    public function __construct(Data &$data)
    {
        $this->data = $data;
    }

    protected function processString($str)
    {
        $str = ' ' . mb_strtolower($str) . ' ';
        $this->removeItems($str, $this::getSymbolsForRemove());
        $this->removeItems($str, $this::getMarksForRemote(), ' ');
        return $this->splitString($str);
    }

    protected function removeItems(&$str, $items, $betweenSymbol = '')
    {
        foreach($items as $item){
            $str = str_replace($betweenSymbol . $item . $betweenSymbol, ' ', $str);
        }
    }

    protected function splitString($str)
    {
        $str = preg_replace('/ {2,}/',' ',$str);
        $str = trim($str);
        return explode(' ', $str);
    }

    protected static function getSymbolsForRemove()
    {
        return [
            '.',
            ',',
            '(',
            ')',
        ];
    }

    protected function getMarksForRemote()
    {
        return [];
    }
}