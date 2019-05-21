<?php

class OrderController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        if(empty($_SESSION) == true || $_SESSION['user']['role'] != "admin" ) {
            $http->redirectTo('/');
        }


    	$orderModel = new OrderModel();
        $orders = $orderModel->getAllOrders();
        return  [
                    'orders'=>$orders
                ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    }
}