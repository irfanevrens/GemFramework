<?php

/**
 *  Bu sistem Autoload tarafından yürütülebilmesi için oluşturulmuştur.
 *  Sınıfın başlaması için gerekli olan işlemleri yapar.
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 */
namespace Gem\System;

use Gem\Components\Application;

/**
 * Class Run
 * @package Gem\System
 */
class Run
{
    /**
     * Sistemi yürütür.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->runBootstrap();
        $application = new Application('GemFramework2Build', 1);
        /**
         *
         *  Rotalama olayının Application/routes.php den devam edeceğini bildirir.
         *  İstenilirse -> run ( den önce istenilen işlemler yapılabilir.
         *
         */
        $application->run();
    }

    /**
     * System/bootstrap.php 'de yapılacak işlemleri yürütür
     */

    private function runBootstrap()
    {

        ini_set('memory_limit', '1024M');
        define('APP', 'Application/');
        define('ROUTE', APP.'Routes/');
        define('MVC', APP . 'MVC/');
        define('VIEW', MVC . 'Views/');
        define('MODEL', MVC . 'Models/');
        define('CONTROLLER', MVC . 'Controllers');
        define('CONFIG_PATH', APP . 'Configs/');
        define('SYSTEM', 'System/');
        define('LANG', 'Language/');
        define('ASSETS', 'public/assets/');
        define('DATABASE', APP . 'Database/');
        error_reporting(E_ALL);
        include APP . 'Helpers/helpers.php';
    }

}

