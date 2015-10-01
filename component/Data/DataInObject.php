<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 27.09.2015
 * Time: 17:51
 */

namespace NovaPoshta_Address\Data;


use NovaPoshta_Address\Base\Helper;
use NovaPoshta_Address\Base\Indexes;
use NovaPoshta_Address\Models\Area;
use NovaPoshta_Address\Models\City;
use NovaPoshta_Address\Models\Objects\AreaObject;
use NovaPoshta_Address\Models\Objects\AreasObject;
use NovaPoshta_Address\Models\Objects\CityObject;
use NovaPoshta_Address\Models\Warehouse;

class DataInObject extends Data
{
    protected $Areas;
    protected $IndexCityInArea;
    protected $IndexWarehouseInCity;
    protected $IndexCityName;
    protected $IndexWarehouseNumberInCity;

    public function __construct()
    {
        $this->Areas = new AreasObject();
        $this->IndexCityInArea = new Indexes();
        $this->IndexWarehouseInCity = new Indexes();
        $this->IndexCityName = new Indexes(true);
        $this->IndexWarehouseNumberInCity = new Indexes();

        parent::__construct();
    }

    protected function addArea(Area $area)
    {
        $area = Helper::object2object($area, new AreaObject());
        $this->Areas->addArea($area);
    }

    protected function addCity(City $city)
    {
        /** @var CityObject $city */
        $city = Helper::object2object($city, new CityObject());
        $area = $this->Areas->getArea($city->Area);
        if($area){
            $area->addCity($city);
            $this->IndexCityInArea->set($city->Ref, $area->Ref);
        }
    }

    protected function addWarehouse(Warehouse $warehouse)
    {
        $city = $this->getCityByRef($warehouse->CityRef);
        $city->addWarehouse($warehouse);
        $this->IndexWarehouseInCity->set($warehouse->Ref, $city->Ref);
        /** @var Indexes $index */
        $index = $this->IndexWarehouseNumberInCity->get($city->Ref);
        if(!$index){
            $index = new Indexes();
            $this->IndexWarehouseNumberInCity->set($warehouse->CityRef, $index);
        }
        $index->set($warehouse->Number, $warehouse->Ref);
    }

    protected function addIndexCityName($nameCity, City $city)
    {
        $this->IndexCityName->set($nameCity, $city->Ref);
    }

    protected function getCityByRef($ref)
    {
        $areaRef = $this->IndexCityInArea->get($ref);
        if(!$areaRef){
            return;
        }
        $city = $this->Areas->getArea($areaRef)->getCity($ref);
        return $city;
    }

    public function getFindCities($name)
    {
        $indexCities = $this->IndexCityName->get($name);
        $cities = [];
        foreach($indexCities as $index){
            if($city = $this->getCityByRef($index)){
                $cities[$city->Ref] = Helper::object2object($city, new City());
            }
        }
        return array_values($cities);
    }

    public function getWarehouseByNumber($refCity, $number)
    {
        /** @var Indexes $warehouseIndexes */
        $warehouseIndexes = $this->IndexWarehouseNumberInCity->get($refCity);
        if(!$warehouseIndexes){
            return;
        }
        $warehouseRef = $warehouseIndexes->get($number);
        if(!$city = $this->getCityByRef($refCity)){
            return;
        }
        $warehouse = $city->getWarehouse($warehouseRef);
        return $warehouse;
    }
}