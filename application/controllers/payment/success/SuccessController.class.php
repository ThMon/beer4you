<?php

class SuccessController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	var_dump($_GET['id']);

        return ['num' => $_GET['id']];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	

       	
    }
}