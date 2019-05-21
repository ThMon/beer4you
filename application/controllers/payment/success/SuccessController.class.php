<?php

class SuccessController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        if(empty($_SESSION) == true) {
            $http->redirectTo('/');
        }
        
    	var_dump($_GET['id']);

        return ['num' => $_GET['id']];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	

       	
    }
}