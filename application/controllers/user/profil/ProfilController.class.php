<?php

class ProfilController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        if(empty($_SESSION) == true) {
            $http->redirectTo('/user/login');
        }

        
    	$userModel = new UserModel();
        $user = $userModel->findOneUser($_SESSION['user']['id']);
        var_dump($_SESSION);
        var_dump($user);

        return [
            "user"=>$user
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	var_dump($_POST);

        $userModel = new UserModel();
        $userModel->changeUserProfil($_POST, $_SESSION['user']['id']);

        $http->redirectTo('/');
    }
}