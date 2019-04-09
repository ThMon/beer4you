<?php

class BasketController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        if(empty($_SESSION) == true) {
            $http->redirectTo('/user/login');
        }

        
    	
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	
    }
}