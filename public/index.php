<?php

require __DIR__."/../core/Autoload.php";
require __DIR__."/../core/sdk-functions.php";

$conf = file_get_contents(__DIR__ . "/../conf/settings.json");
$conf = json_decode($conf,true);
Autoload::registerAutoload( $conf["parameters"]["namespaceApplication"] ,  $conf["parameters"]["directorySource"]);
$mvcUtl = new \Core\MvcUtils(\Core\HttpUtils::getUri(), \Core\HttpUtils::getMethod(),$_GET, $_POST);

try {
    echo $mvcUtl->handleRequest();
} catch (\Core\Exceptions\HttpException $e) {
    http_response_code($e->getStatusCode());
    echo $e->getMessage();
} catch (\Core\Exceptions\UnauthorizedException $error) {
//    http_response_code(401);
    header('location: /login.php', true);
    die();
} catch (\Exception $error) {
    http_response_code(500);
    echo "Erro Inesperado na aplicação: ". $error->getMessage();
}
