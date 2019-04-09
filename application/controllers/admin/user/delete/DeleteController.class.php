<?php

class DeleteController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	if(empty($_SESSION) == true) {
            $http->redirectTo('/user/login');
        }
    	
    	$id= $_GET['id'];

    	$userModel = new UserModel();
    	$userModel->deleteUser($id);

    	$http->redirectTo('/admin');
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        
    }
}