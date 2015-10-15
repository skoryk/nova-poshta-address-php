<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 27.09.2015
 * Time: 18:33
 */

namespace NovaPoshta_Address;


use NovaPoshta_Address\Configs\Config;
use NovaPoshta_Address\Data\Data;
use NovaPoshta_Address\Data\DataClientInterface;
use NovaPoshta_Address\Parse\CityAddress;
use NovaPoshta_Address\Parse\WarehouseAddress;

class Address implements DataClientInterface
{
    /** @var Data  */
    private $data;
    /** @var CityAddress  */
    private $cityAddress;
    private $warehouseAddress;

    public function __construct(Config $config = null)
    {
        if(!$config){
            $config = new Config();
        }
        $this->data = $config->getData();
        $this->cityAddress = new CityAddress($this->data);
        $this->warehouseAddress = new WarehouseAddress($this->data);
    }

    public function getFindCities($name)
    {
        $response = $this->cityAddress->getStringByCity($name);
        return $response;
    }

    public function getWarehouseByNumber($refCity, $number)
    {
        return $this->warehouseAddress->getStringByNumberWarehouse($refCity, $number);
    }

    public function getCities()
    {
        return $this->data->getCities();
    }

    public function getWarehouses($cityRef)
    {
        return $this->data->getWarehouses($cityRef);
    }
} 