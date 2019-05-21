<?php

class DeleteController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        if(empty($_SESSION) == true || $_SESSION['user']['role'] != "admin" ) {
            $http->redirectTo('/');
        }
        
        $id = $_GET['id'];
        $url = 'application/www/images/beers/';

        $beerModel = new BeerModel();
        $beer = $beerModel->findOneBeer($id);

        if (file_exists ( $url.$beer['Photo'])) {
            unlink($url.$beer['Photo']);
        }
        
        $beerModel->deleteBeer($id);

        $http->redirectTo('/admin');

    }

    public function httpPostMethod(Http $http, array $formFields)
    {

    }
}