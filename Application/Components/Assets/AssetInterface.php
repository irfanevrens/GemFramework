<?php

	 /**
	  * Bu ınterface PathPackpage, UrlPackpage gibi assets dosyalarında kullanılmak üzere tasarlanmıştır.
	  * Interface AssetInterface
	  *
	  */

	 namespace Gem\Components\Assets;

	 interface AssetInterface
	 {

		  public function getUrl ($file = '');

	 }
