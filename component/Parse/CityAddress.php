<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 30.09.2015
 * Time: 20:29
 */

namespace NovaPoshta_Address\Parse;


use NovaPoshta_Address\Models\City;

class CityAddress extends Parse
{
    /**
     * @param $address
     * @return array
     */
    public function getStringByCity($address)
    {
        $words = $this->processString($address);

        $cities = [];
        foreach($words as $word){
            /** @var array $citiesResponse */
            if($citiesResponse = $this->data->getFindCities($word)){
                /** @var City $city */
                foreach($citiesResponse as $city){
                    $cities[$city->Ref] = $city;
                }
            }
        }

        return array_values($cities);
    }

    protected function getMarksForRemote()
    {
        return [
            'р-н',
            'обл',
            'область',
            'г',
            'м',
            'смт',
            'украина',
            'с',
            'пгт',
        ];
    }
} 