<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 26.09.2015
 * Time: 12:05
 */


include_once 'Base/Autoload.php';
if (!defined('NOVA_POSHTA_PATH_ADDRESS')) {
    define('NOVA_POSHTA_PATH_ADDRESS', dirname(__FILE__) . '/');
    \NovaPoshta_Address\Base\Autoload::init();
}