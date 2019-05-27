<?php

function view($name, $model, $attr = null) {
    return [
        'view' => $name,
        'model' => $model,
        'attr' => $attr
    ];
}

function redirectToUri($uri) {
    $path = $_SERVER['HTTP_HOST'].$uri;

    header("location: $path");
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