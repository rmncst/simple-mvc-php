<?php
/**
 * Created by PhpStorm.
 * User: rmncs
 * Date: 26/05/2019
 * Time: 20:49
 */

namespace Application\Controller;


use Application\Data\UserData;

class AuthenticationController
{
    public function auth() {
        $post = $_POST;
        $userData = new UserData();
        if($userData->authenticate($post['user'] , $post['password'])){
            setSessionAuthorized();
            return redirectToUri('/Home/Index');
        }

        $msg = base64_encode('Credenciais Inválidas');
        return redirectToUri('/login.php?msg='.$msg);
    }

    public function logout() {
        unsetSessionAuthorized();
        return redirectToUri('/login.php');
    }

    public function register() {
        $data = $_POST;
        $userData = new UserData();
        if($data['password'] !== $data['confirmPassword']) {
            $msg = base64_encode('As senhas não coincidem !');
            return redirectToUri('/cadastro.php?msg='.$msg);
        }
        if($userData->userExists($data['email'])) {
            $msg = base64_encode('Usuário já existe !');
            return redirectToUri('/cadastro.php?msg='.$msg);
        }
        unset($data['confirmPassword']);
        $data['password'] = $userData->encryptPassword($data['password']);
        $userData->insert($data);

        return redirectToUri('/login.php');
    }
}