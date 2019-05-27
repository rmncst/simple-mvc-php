<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 26/05/2019
 * Time: 20:49
 */

namespace Application\Controller;


class AuthenticationController
{
    public function login() {
        return view('login',null);
    }
}