<?php

class PaymentController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	var_dump(json_decode($_POST['basketItem']));

    	$orders =  json_decode($_POST['basketItem']);

    	var_dump($_SESSION);

    	$beerModel = new BeerModel();



    	foreach($orders as $order) {

    		$beer = $beerModel->findOneBeer($order->beerId);

    		$order->safePrice = $beer['SalePrice'];
    	}

    	var_dump($orders);

    	$orderModel = new OrderModel();

    	$orderModel->saveOrder($orders, $_SESSION['user']['id']);
    }
}