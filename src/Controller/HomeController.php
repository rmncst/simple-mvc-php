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

    public function auth() {
        $post = $_POST;
        if($post['user'] == 'admin' && $post['password'] == 'p@ssw0rd' ) {
            setSessionAuthorized();
            return redirectToUri('/Home/Index');
        }

        return redirectToUri('/login.php');
    }

    public  function logout() {
        unsetSessionAuthorized();
        return redirectToUri('/login.php');
    }
}