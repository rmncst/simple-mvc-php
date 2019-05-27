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
    /**
     * @method POST
     */
    public function index($id = 0, $name = 1) {
        $db = new TableGateway('music');
        $model = [
            'message' => 'Hello Darkness My Old Friend',
            
        ];
        
        return view('home', $model);
    }
}