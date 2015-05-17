<?php
/**
 * 
 *   GemFramework dosyalarda Controller ve Model leri �a��rmakta kullan�lacak
 *   
 *   @package Gem\Components
 *   
 *   @author vahitserifsaglam <vahit.serif119@gmail.com>
 *   
 *   @copyright MyfcYazilim
 *   
 * 
 */
namespace Gem\Components;

use Gem\Components\Helpers\Config;

class App
{
	
	const CONTROLLER = 'Controller';
	
	const MODEL = 'Model';
	
	const VIEW = 'View';
	
	/**
	 * Controller, method yada bir s�n�f �a��r�r
	 * @param mixed $names
	 * @param string $type
	 * @return mixed
	 * @access public
	 */
	
	public static function uses($names, $type)
	{
		
		
	      switch ($type)
	      {
	      	
	      	case self::CONTROLLER:
	      		
	      		$this->includeController($names);
	      		
	      		break;
	      		
	      	case self::MODEL:
	      		
	      		$this->includeModel($names);
	      		
	      		break;
	      		
	      	case self::VIEW:
	      		
	      		$this->includeView($names);
	      		
	      		break;
	      	
	      }
		
		
	}
	
	/**
	 * Html da kullan�lmak i�in base kodunu olu�turur
	 * @return string
	 */
	 
	public static function base()
	{
		$config = self::getConfigStatic('configs')['url'];
		
		return '<base href="'.$config.'" target="_blank">';
	}

	
	
}