<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 29.09.2015
 * Time: 21:47
 */

namespace NovaPoshta_Address\Configs;


use NovaPoshta_Address\Base\AddressFile;

class FileCache extends Config
{
    private $file;

    public function __construct(AddressFile $addressFile)
    {
        $this->file = $addressFile;
    }

    public function getData()
    {
        if(file_exists($this->file->address)){
            $data = file_get_contents($this->file->address);
            $data = unserialize($data);
        } else {
            $data = parent::getData();
            file_put_contents($this->file->address, serialize($data), LOCK_EX);

        }
        return $data;
    }
} 