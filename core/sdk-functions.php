<?php

function view($name, $model, $attr = null) {
    return [
        'view' => $name,
        'model' => $model,
        'attr' => $attr
    ];
}