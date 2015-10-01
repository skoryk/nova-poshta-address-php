<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 27.09.2015
 * Time: 18:12
 */

namespace NovaPoshta_Address\Data;


use NovaPoshta_Address\Models\City;
use NovaPoshta_Address\Models\Warehouse;

interface DataClientInterface
{
    /**
     * @param string $name
     * @return City[]
     */
    public function getFindCities($name);

    /**
     * @param string $refCity
     * @param int $number
     * @return Warehouse
     */
    public function getWarehouseByNumber($refCity, $number);
} 