<?php

use Gem\Components\Application;
use Gem\Components\Database\Base;


## uygulamay� ba�latan ana s�n�f
$application = new Application('GemFramework','1.0');




$application->get('/',function (){

  view('index',['test' => 'adsads']);

})
->run();








