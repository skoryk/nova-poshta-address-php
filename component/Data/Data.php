<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 27.09.2015
 * Time: 17:45
 */

namespace NovaPoshta_Address\Data;


use NovaPoshta\ApiModels\Address;
use NovaPoshta\Models\DataContainerResponse;
use NovaPoshta_Address\Base\Helper;
use NovaPoshta_Address\Models\Area;
use NovaPoshta_Address\Models\City;
use NovaPoshta_Address\Models\Warehouse;
use DateTime;

abstract class Data
{
    /** @var  DateTime */
    private $dateInit;

    abstract protected function addArea(Area $area);
    abstract protected function addCity(City $city);
    abstract protected function addWarehouse(Warehouse $warehouse);
    abstract protected function addIndexCityName($nameCity, City $city);

    /**
     * @param $name
     * @return array
     */
    abstract public function getFindCities($name);

    /**
     * @param $refCity
     * @param $number
     * @return Warehouse
     */
    abstract public function getWarehouseByNumber($refCity, $number);

    public function __construct()
    {

    }

    private function addIndexCity(City $city)
    {
        foreach(['', 'Ru'] as $lang){
            $description = mb_strtolower(Helper::deleteScope($city->{'Description' . $lang}));
            $descriptions = explode(' ', $description);
            foreach($descriptions as $description){
                $this->addIndexCityName($description, $city);
            }
        }
    }

    protected function initAreas(array $areas)
    {
        foreach ($areas as $item) {
            $oArea = Helper::object2object($item, new Area());
            $this->addArea($oArea);
        }
    }

    protected function initCities(array $cities)
    {
        foreach ($cities as $item) {
            $oCity = Helper::object2object($item, new City());
            $this->addCity($oCity);
            $this->addIndexCity($oCity);
        }

    }

    protected function initWarehouses(array $warehouses)
    {
        foreach ($warehouses as $item) {
            $warehouse = Helper::object2object($item, new Warehouse());
            $this->addWarehouse($warehouse);
        }
    }

    public function initData()
    {
        Address::batch();
        $data = [
            Address::getAreas() => 'Areas',
            Address::getCities() => 'Cities',
            Address::getWarehouses() => 'Warehouses',
        ];
        $result = Address::getResponseBatch();
        /** @var DataContainerResponse $itemResponse */
        foreach($result as $key => $itemResponse){
            if (!$itemResponse->success) {
                return;
            }
            $this->{'init' . $data[$key]}($itemResponse->data);
        }

        $this->dateInit = new DateTime();
    }

    public function getDateTime()
    {
        return $this->dateInit;
    }
}