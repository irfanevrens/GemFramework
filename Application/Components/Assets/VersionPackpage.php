<?php namespace Gem\Components\Assets;

/**
 * Class VersionPackpage
 *
 * Bu Sınıf GemFramework'de Asset Sınıfında Versiona dayalı işlemler yapmak için tasarlanmıştır
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @package Gem\Components\Assets
 */
class VersionPackpage implements AssetInterface
{
    /**
     * Girilecek version değerini tutar
     *
     * @var string
     */
    private $version = '';

    /**
     * Değiştirelecek deseni tutar
     *
     * @var string
     */
    private $pattern = '';

    public function __construct($version = '', $pattern = '%f?%v')
    {
        $this->setPattern($pattern);
        $this->setVersion($version);
    }

    /**
     * Version ataması yapar
     *
     * @param string $version
     * @return $this
     */
    public function setVersion($version = '')
    {
        $this->version = $version;
        return $this;
    }

    /**
     * Pattern ataması yapar
     *
     * @param string $pattern
     * @return $this
     */
    public function setPattern($pattern = '')
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * Versionu döndürür
     *
     * @return mixed
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Pattern'i döndürür
     *
     * @return string
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * Url'i oluşturur
     *
     * @param string $file
     * @param string $prefix
     * @return string
     */
    public function getUrl($file = '', $prefix = '')
    {
        $version = $this->getVersion();
        $pattern = $this->getPattern();

        /** Search Params
         *  %f => $file
         *  %v => $version
         */
        $f = str_replace('%f', $file, $pattern);
        $v = str_replace('%v', $version, $f);

        return ASSETS . $prefix . $v;
    }
}