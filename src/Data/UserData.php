<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 23/06/2019
 * Time: 17:46
 */

namespace Application\Data;


use Core\TableGateway;

class UserData extends TableGateway
{
    public function __construct() {
        parent::__construct('user');
    }

    public function authenticate($user, $password) {
        $user = $this->find('email = \''.$user.'\'');
        if($user == null) {
            return false;
        }
        if($this->checkPassword($password, $user['password'] )) {
            return true;
        }
        return false;
    }

    public function userExists($email) {
        $user = $this->find('email = \''.$email.'\'');
        if($user == null) {
            return false;
        }
        return true;
    }

    public function encryptPassword($pass) {
        return password_hash($pass, PASSWORD_BCRYPT);
    }

    public function checkPassword($pass, $hash) {
        return password_verify($pass, $hash);
    }



}