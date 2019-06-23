<?php

const SESSION_TOKEN = '6FSDF6AS80D';

function view($name, $model, $attr = null) {
    return [
        'view' => $name,
        'model' => $model,
        'attr' => $attr
    ];
}

function redirectToUri($uri) {
     return [
        'redirect' => true, 'uri' => $uri
    ];
}

function setSessionAuthorized() {
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION[SESSION_TOKEN] = true;
}
function unsetSessionAuthorized() {
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    $_SESSION[SESSION_TOKEN] = null;
}

function isSessionAuthorized() {
    if(session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
    }

    return $_SESSION[SESSION_TOKEN] === true;
}

function setControllerSecure() {
    if(isSessionAuthorized() !== true) {
        throw new \Core\Exceptions\UnauthorizedException("
            Acesso Não Permitido
        ");
    }
}

function parameter($param) {
    $conf = file_get_contents(__DIR__ . "/../conf/settings.json");
    $conf = json_decode($conf,true);

    if(isset($conf['application'][$param])) {
        return $conf['application'][$param];
    } else {
        return null;
    }
}

function menu() {
    $conf = file_get_contents(__DIR__ . "/../conf/menu.json");
    $conf = json_decode($conf,true);

    return $conf['menu'];
}

function post($param = null) {
    return $param !== null ? $_POST[$param] : $_POST;
}
function fieldError($name, $model) {
    if(isset($model[$name])) {
        return '<p class="text-danger">'. $model[$name]. '</p>';
    } else {
        return null;
    }

}
