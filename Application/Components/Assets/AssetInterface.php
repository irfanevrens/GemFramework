<?php namespace Gem\Components\Assets;

/**
 * Interface AssetInterface
 *
 * Bu interface PathPackpage, UrlPackpage gibi assets dosyalarında kullanılmak üzere tasarlanmıştır.
 *
 * @package Gem\Components\Assets
 */
interface AssetInterface
{
    public function getVersion();
    public function getPattern();
    public function getUrl($file = '');
}
