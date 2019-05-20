<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 05/05/2019
 * Time: 16:25
 */

namespace Core;


use Core\Exceptions\HttpException;

class MvcUtils
{
    private $_uri;
    private $_method;

    private $_controllerName;
    private $_controllerPath;
    private $_actionName;
    private $_segmentParams = [];

    private $_queryParameters = [];
    private $_requestParameters = [];

    const DEFAULT_CONTROLLER_NAME = 'Home';
    const DEFAULT_ACTION_NAME = 'Index';
    const DEFAULT_NAMESPACE_CONTROLLER = 'Application\\Controller\\';
    const DEFAULT_PATH_VIEW = 'src/View/';

    public function __construct($uri, $method, array $queryParams, array $requestParams) {

        $segments = explode("/", HttpUtils::getUri());        
        $this->_uri = $uri;
        $this->_method = $method;
        $this->_queryParameters = $queryParams;
        $this->_requestParameters = $requestParams;

        if(isset($segments[1]) && $segments[1] != '') {
            $this->_controllerName = $segments[1];
        } else {
            $this->_controllerName = self::DEFAULT_CONTROLLER_NAME;
        }

        if(isset($segments[2])) {
            $this->_actionName = $segments[2];
        } else {
            $this->_actionName = self::DEFAULT_ACTION_NAME;
        }

        $aux = 3;
        while (count($segments) > $aux) {
            $this->_segmentParams[] = $segments[$aux++];
        }

    }

    public function handleRequest() {
        $temp = self::DEFAULT_NAMESPACE_CONTROLLER.$this->_controllerName.'Controller';
        if(!class_exists($temp)) {
            throw new HttpException("Erro ao mapear controller {$temp}", 404);
        }
        $this->_controllerPath = $temp;


        $classReflect = new \ReflectionClass($this->_controllerPath);
        if(!$classReflect->hasMethod($this->_actionName)) {
            throw new HttpException("Erro ao mapear action", 404);
        }

        $method = $classReflect->getMethod($this->_actionName);
        if($method->getNumberOfRequiredParameters() > count($this->_segmentParams)) {
            throw new HttpException("Número inválido de parâmetros", 404);
        }

        $res = $method->invokeArgs(new $this->_controllerPath, $this->_segmentParams);
        
        return $this->handlerView($res['view'], $res["model"]);
    }
    
    private function handlerView($viewName, $_model) {
        $model = $_model;
        ob_start();
        include($this->getViewFile($viewName));
        $content = ob_get_clean();             
        ob_start();
        include($this->getViewFile('master'));
        return ob_get_clean();
    }
    
    private function getViewFile($viewName) {
        $temp = __DIR__.'/../'.self::DEFAULT_PATH_VIEW.$viewName.'.view.php';
        if(!file_exists($temp)){
            throw new HttpException("View não mapeada", 500);
        }
        return $temp;
    }
  
}