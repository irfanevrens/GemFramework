<?php
/**
 * Bu dosya GemFramework un ba�lang�� s�n�f�na ait dosyad�r
 * Framework le ilgili olaylar ilk olarak bu s�n�fta ger�ekle�ir
 * 
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @version 1.0.0
 * @package Gem\Components
 */
 
 namespace Gem\Components;
 	
 	use Gem\Components\Patterns\Singleton;
 	use Gem\Components\Route;
 	use Gem\Components\Patterns\Facade;
 	use Exception;
 	use Composer\Autoload\ClassLoader;
 	
 	/**
 	 * 
 	 * @class Application
 	 * 
 	 */
 	
 	class Application
 	{
 		
 		/**
 		 * 
 		 * @var String -> framework un ad�
 		 * @var Float  -> framework un versiyonu
 		 * @access private
 		 * 
 		 */
 		private $framework_name, $framework_version,
 		 $router,$alias = [];
 		
 
 		
 		function __construct($framework_name = 'Gem', $framework_version = 1.0)
 		{
 			
 			$this->framework_name = $framework_name;
 			$this->framework_version = $framework_version;
 			$this->router = $this->singleton( new Route() );
 			$this->autoloader = new ClassLoader();
 			
 			$this->autoloader->register();
 		}
 		
 		
 		private function addAutoload($autoload = [])
 		{
 			
 			foreach($autoload as $key => $value)
 			{
 				
 				$this->autoloader->add($key, $value);
 					
 				
 			}
 			
 			
 		}
 		
 		/**
 		 * Yeni bir singleton objesi olu�turur
 		 * @param mixed $instance
 		 * @param mixed ...$parameters
 		 * @return Object
 		 * 
 		 */
 		function singleton($instance, ...$parameters)
 		{
 			
 			return Singleton::make($instance, $parameters);
 			
 		}
 		
 		/**
 		 * Dosyadaki i�eri�i �eker
 		 * @param string $filePath
 		 * @return \Gem\Components\Application
 		 */
 		function routesFromFile($filePath)
 		{
 			
 			if(file_exists($filePath))
 			{
 				
 				$app = $this;
 				$inc = include $filePath;
 				
 				if($inc instanceof Application)
 				{
 					
 					$this->setCollections($inc->getCollections());
 					
 				}
 					
 				
 			}
 			else{

 				throw new Exception(sprintf("arand���n�z %s dosyas� bulunamad�", $filePath));
 				
 			}
 			
 			return $this;
 		}
 		
 		/**
 		 * 
 		 * Get isteklerini yakalar
 		 * 
 		 * @param string $url
 		 * @param mixed $use
 		 */
 		
 		function get($url, $use)
 		{
 			
 			 $this->router->add('get', func_get_args());
 			 return $this;
 		}
 		
 		/**
 		 *
 		 * Post isteklerini yakalar
 		 *
 		 * @param string $url
 		 * @param mixed $use
 		 */
 		
 		function post($url, $use)
 		{
 		
 			 $this->router->add('post', func_get_args());
 			 return $this;
 		}
 			
 		/**
 		 *
 		 * Delete isteklerini yakalar
 		 *
 		 * @param string $url
 		 * @param mixed $use
 		 */
 			
 		function delete($url, $use)
 		{
 				
 		     $this->router->add('delete', func_get_args());
 			return $this;
 		}
 		
 		/**
 		 *
 		 * Put isteklerini yakalar
 		 *
 		 * @param string $url
 		 * @param mixed $use
 		 */
 			
 		function put($url, $use)
 		{
 				
 			 $this->router->add('put', func_get_args());
 			 return $this;
 				
 		}
 		
 		/**
 		 *
 		 * T�m isteklerini yakalar
 		 *
 		 * @param string $url
 		 * @param mixed $use
 		 */
 			
 		function any($url, $use)
 		{
 				
 			 $this->router->match( $this->router->getTypes(), func_get_args());
 			 return $this;
 		}
 		
 		/**
 		 * Array a g�re istekleri ekler
 		 * @param array $types
 		 * @param string $url
 		 * @param mixed $use
 		 * @return \Gem\Components\Application
 		 * @access public
 		 * 
 		 */
 		
 		function match($types = [], $url, $use)
 		{
 			
 			$type = $types;
 			$args = func_get_args();
 			unset($args[0]);
 			$this->router->match($type, $args);;
 			return $this;
 			
 		}
 		
 		/**
 		 * Koleksiyonlar� d�nd�r�r
 		 */
 		function getCollections()
 		{
 			
 			return $this->router->getCollections();
 			
 		}
 		
 		function setCollections(array $collections = [])
 		{
 			
 			$this->router->setCollections($collections);
 			
 		}
 		/**
 		 * 
 		 * @param string $filter
 		 * @param string $pattern
 		 * @return \Gem\Components\Application
 		 * @access public 
 		 */
 		
 		function filter($filter, $pattern)
 		{
 			
 			$this->router->filter($filter,$pattern);
 			return $this;
 			
 		}
 		
 		
 		## tetikleyici
 		function run()
 		{
 			
 			if(count($this->alias) > 0)
 			{
 				
 				$this->runFacades();
 				
 			}
 			
 			## url y�netimi
 			$this->getUrlChecker();
 			
 			## r�taland�rman�n ba�lamas�
 			$this->router->run();
 			
 		}
 		
 		private function getUrlChecker()
 		{
 			
 			if(!isset($_GET['url']) || !$_GET['url'])
 				 $_GET['url'] = '/';
 			
 		
 		}
 		
 		private function runFacades()
 		{
 			
 			Facade::$instance = $this->alias;
 			
 		}
 		
 		/**
 		 * 
 		 * @param array $facedes
 		 * @return \Gem\Components\Application
 		 */
 		
 		function register($facedes = [])
 		{
 			
 			$this->alias = $facedes;
 			return $this;
 			
 		}
 		
 		
 	}
 	