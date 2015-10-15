<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 26.09.2015
 * Time: 11:48
 */

namespace NovaPoshta_Address\Models\Objects;


use NovaPoshta_Address\Models\Area;

class AreaObject extends Area
{
    private $Cities = [];

    public function addCity(CityObject $item)
    {
        $this->Cities[$item->Ref] = $item;
    }

    /**
     * @param $ref
     * @return null|CityObject
     */
    public function getCity($ref)
    {
        return isset($this->Cities[$ref]) ? $this->Cities[$ref] : null;
    }

    public function getCities()
    {
        return $this->Cities;
    }
}