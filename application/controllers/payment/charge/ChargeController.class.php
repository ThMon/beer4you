<?php

class ChargeController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {

        
        
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

        var_dump($_POST);

        $orders =  json_decode($_POST['orders']);

        $totalAmount = 0;

        var_dump($_SESSION);

        $beerModel = new BeerModel();


        foreach($orders as $order) {

            $beer = $beerModel->findOneBeer($order->beerId);

            $order->safePrice = $beer['SalePrice'];

            $totalAmount += ($order->safePrice*$order->quantity);
        }


        require_once('vendor/autoload.php');


        \Stripe\Stripe::setApiKey('sk_test_WvJOfwZp9WEwNygwuHXgiwLX
        ');

        $POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

        $email = $_SESSION['user']['email'];
        $token = $_POST['stripeToken'];
        //var_dump($totalAmount);

        try {


            $customer = \Stripe\Customer::create(array(
                "email" => $email,
                "source" => $token
            ));

            $charge = \Stripe\Charge::create(array(
                "amount" => $totalAmount*100,
                "currency" => 'eur',
                "description" => 'mon site',
                "customer" => $customer->id
            ));

            $orderModel = new OrderModel();

            $orderModel->saveOrder($orders, $_SESSION['user']['id']);
        }  catch (Exception $error) {
            echo "c'est mort !";
        }

        
    }
}