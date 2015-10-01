<?php

namespace NovaPoshta_Address\Base;


class Autoload
{
    public static function init()
    {
        if (function_exists('__autoload')) {
            spl_autoload_register('__autoload');
        }

        return spl_autoload_register(array('\NovaPoshta_Address\Base\Autoload', 'load'));
    }

    public static function load($className)
    {
        $className = str_replace('NovaPoshta_Address\\', '', $className);
        $className = NOVA_POSHTA_PATH_ADDRESS . $className . '.php';
        $className = str_replace('\\', DIRECTORY_SEPARATOR, $className);

        if ((file_exists($className) === false) || (is_readable($className) === false)) {
            return false;
        }

        require($className);

        return true;
    }
}
