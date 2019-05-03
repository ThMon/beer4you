<?php

class DetailController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	$orderModel = new OrderModel();
        $orders = $orderModel->getAllOrders();
        var_dump($order);
        return  [
                    'order'=>$order
                ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    }
}