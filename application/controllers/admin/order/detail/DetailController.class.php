<?php

class DetailController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	$orderModel = new OrderModel();
        $orderdetails = $orderModel->getAllOrderDetail($_GET['id']);
        var_dump($orderdetails);

        return ['orderdetail' => $orderdetails];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    }
}