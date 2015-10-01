<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 30.09.2015
 * Time: 20:29
 */

namespace NovaPoshta_Address\Parse;


use NovaPoshta_Address\Models\City;

class WarehouseAddress extends Parse
{
    public function getStringByNumberWarehouse($refCity, $number)
    {
        $number = preg_replace('/[^0-9]/', '', $number . '');

        return $this->data->getWarehouseByNumber($refCity, $number);
    }
}