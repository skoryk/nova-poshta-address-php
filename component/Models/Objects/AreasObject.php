<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 26.09.2015
 * Time: 11:48
 */

namespace NovaPoshta_Address\Models\Objects;


class AreasObject
{
    private $Areas = [];

    public function addArea(AreaObject $area)
    {
        $this->Areas[$area->Ref] = $area;
    }

    /**
     * @param $ref
     * @return null|AreaObject
     */
    public function getArea($ref)
    {
        return isset($this->Areas[$ref]) ? $this->Areas[$ref] : null;
    }
}