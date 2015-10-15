<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 27.09.2015
 * Time: 17:58
 */

namespace NovaPoshta_Address\Base;


class AddressFile
{
    public $address;

    public function delete()
    {
        unlink($this->address);
    }
} 