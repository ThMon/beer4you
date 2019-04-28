<?php

class PaymentController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	var_dump(json_decode($_POST['basketItem']));
    }
}