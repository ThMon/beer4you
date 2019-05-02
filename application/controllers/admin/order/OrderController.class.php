<?php

class OrderController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	$orderModel = new OrderModel();
        $orders = $orderModel->getAllOrders();
        var_dump($orders);
        return  [
                    'orders'=>$orders
                ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    }
}