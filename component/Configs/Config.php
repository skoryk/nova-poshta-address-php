<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 29.09.2015
 * Time: 21:43
 */

namespace NovaPoshta_Address\Configs;


use NovaPoshta_Address\Data\DataInObject;

class Config
{
    public function __construct()
    {

    }

    public function getData()
    {
        $data = new DataInObject();
        $data->initData();
        return $data;
    }
}