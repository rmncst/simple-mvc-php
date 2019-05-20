<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 05/05/2019
 * Time: 11:26
 */

namespace Core;


class HttpUtils
{
    static function getMethod() {
        return $_SERVER["REQUEST_METHOD"];
    }

    static  function getUri() {
        return $_SERVER["REQUEST_URI"];
    }
}