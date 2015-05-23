<?php

/**
 * 
 *  GemFramework View S�n�f� -> G�r�nt� dosyalar� �retmek de kullan�l�r
 *  
 */

namespace Gem\Components;

use Gem\Components\Helpers\String\Parser;
use Gem\Components\Helpers\String\Builder;
use Exception;

class View {

    use Parser,
        Builder;

    private $params, $fileName, $autoload = false;

    public function __construct() {

        if (!file_exists(VIEW)) {

            throw new Exception(sprintf("%s dosyaniz  bulunamadi", VIEW));
        }
    }

    /**
     * G�r�nt� dosyas� olu�turur
     * @param string $fileName
     * @param array $variables
     * @throws Exception
     */
    public function make($fileName, $variables) {


        if (strstr($fileName, ".")) {


            $fileName = $this->joinDotToUrl($fileName);
        }


        $this->fileName = $fileName;
        $this->params = $variables;

        return $this;
    }

    public function autoload($au = false) {

        $this->autoload = $au;
        return $this;
    }

    /**
     * 
     * @param array $language
     * @return \Gem\Components\View
     * 
     *  [ 'dil' => [
     *   'file1','file2'
     *  ]
     */
    public function language($language) {

        if (count($language) > 0 && is_array($language)) {

            foreach ($language as $lang) {

                ## alt par�alama
                foreach ($lang as $langfile) {

                    $file = $this->joinDotToUrl($langfile);
                    $fileName = LANG . $langfile . '/' . $file . ".php";

                    if (file_exists($fileName)) {

                        $newParams = include $fileName;
                        $this->params = array_merge($this->params, $newParams);
                    }
                }
            }
        }



        return $this;
    }

    /**
     * ��kt�y� g�nderir
     * @throws Exception
     */
    public function execute() {

        $fileName = $this->viewFilePath($this->fileName);
        $variables = $this->params;



        if (file_exists($fileName)) {

            extract($variables);


            ## header dosyas� y�klemesi
            if ($this->autoload === true) {

                $file = $this->autoloadGenareteFilePath('inc.header');

                if (file_exists($file)) {

                    include $file;
                }
            }

            include $fileName;

            ## footer dosyas� y�klemesi
            if ($this->autoload === true) {

                $fileF = $this->autoloadGenareteFilePath('inc.footer');

                if (file_exists($fileF)) {

                    include $filef;
                }
            }
        } else {

            throw new Exception(sprintf("%s dosyasi bulunamadi", $fileName));
        }
    }

    /**
     * 
     * @param string $path
     * @return string
     */
    private function viewFilePath($path) {

        return VIEW . $path . '.php';
    }

    /**
     * 
     * @param string $path
     * @return string
     * @access private
     */
    private function autoloadGenareteFilePath($path) {

        $filePath = $this->joinDotToUrl($path);

        $path = $this->viewFilePath($filePath);

        return $path;
    }

}
