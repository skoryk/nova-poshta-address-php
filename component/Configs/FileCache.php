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
    const DAYS_UPDATE_FILE = 3;

    /** @var AddressFile  */
    private $file;

    public function __construct(AddressFile $addressFile)
    {
        $this->file = $addressFile;
    }

    public function getData()
    {
        if(file_exists($this->file->address)){
            $days = (time() - filectime($this->file->address)) / 86400;
            if($days > self::DAYS_UPDATE_FILE){
                $this->file->delete();
                return $this->getData();
            }
            $data = file_get_contents($this->file->address);
            $data = unserialize($data);
        } else {
            $data = parent::getData();
            file_put_contents($this->file->address, serialize($data), LOCK_EX);
        }
        return $data;
    }
} 