<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 26.09.2015
 * Time: 11:48
 */

namespace NovaPoshta_Address\Models\Objects;


use NovaPoshta_Address\Models\City;
use NovaPoshta_Address\Models\Warehouse;

class CityObject extends City
{
    /** @var Warehouse[] */
    private $Warehouses = [];

    public function addWarehouse(Warehouse $item)
    {
        $this->Warehouses[$item->Ref] = $item;
    }

    public function getWarehouse($ref)
    {
        return isset($this->Warehouses[$ref]) ? $this->Warehouses[$ref] : null;
    }

    public function getWarehouses()
    {
        return $this->Warehouses;
    }
}