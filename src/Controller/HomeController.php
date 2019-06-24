<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 05/05/2019
 * Time: 11:31
 */

namespace Application\Controller;

use Core\TableGateway;

class HomeController
{
    public function __construct()
    {
        setControllerSecure();
    }

    public function index(){
        $model = [
            'message' => 'Hello Darkness My Old Friend',
        ];
        return view('home', $model);
    }

}