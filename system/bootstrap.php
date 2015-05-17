<?php


## uygulama klas�r�n�n sabiti

define('APP' ,'application/');

## g�r�nt� klas�r�n�n sabiti
define('VIEW' ,APP.'Views/');

## model lerin tutuldu�u klas�r sabiti
define('MODEL' ,APP.'Models/');

## controller lar�n oldu�u klas�r
define('CONTROLLER' ,APP.'Controllers');

## ayarlar�n oldu�u klas�r
define('CONFIG_PATH',APP.'Configs/');


## sistem klas�r�
define('SYSTEM','system/');

## dil dosyalar�n�n oldu�u klas�r
define('LANG', 'language/');


include APP.'libs/Functions.php';

## ba�latma i�lemi
include SYSTEM.'run.php';



