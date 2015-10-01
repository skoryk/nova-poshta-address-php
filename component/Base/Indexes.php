<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 26.09.2015
 * Time: 11:55
 */

namespace NovaPoshta_Address\Base;


class Indexes
{
    private $data = [];
    private $repeatIndex;

    public function __construct($repeatIndex = false)
    {
        $this->repeatIndex = $repeatIndex;
    }

    public function set($index, $value)
    {
        $this->prepareIndex($index);
        if ($this->repeatIndex && !isset($this->data[$index])) {
            $this->data[$index] = [$value];
        } elseif ($this->repeatIndex) {
            $this->data[$index][] = $value;
        } else {
            $this->data[$index] = $value;
        }
    }

    public function get($index)
    {
        $this->prepareIndex($index);
        if (isset($this->data[$index])) {
            return $this->data[$index];
        } elseif ($this->repeatIndex) {
            return [];
        }
        return null;
    }

    private function prepareIndex(&$index)
    {
        $index = md5($index);
    }
}