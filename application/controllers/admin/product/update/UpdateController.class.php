<?php

class UpdateController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
        if(empty($_SESSION) == true || $_SESSION['user']['role'] != "admin" ) {
            $http->redirectTo('/');
        }
        

        $id = $_GET['id'];

        $beerModel = new BeerModel();
        $beer = $beerModel->findOneBeer($id); 

        return [
            'beer'=>$beer
        ];

    }

    public function httpPostMethod(Http $http, array $formFields)
    {
        var_dump($_POST);
        var_dump($_FILES);
        $url = 'application/www/images/beers/';
        $fileName = $_FILES['beer_pict']['name'];
        $id = $_POST['beerId'];

        $beerModel = new BeerModel();
        $beer = $beerModel->findOneBeer($id); 

        if ($_FILES['beer_pict']['size'] > 0 ) {
            $http->moveUploadedFile('beer_pict', '/images/beers'); 
            unlink($url.$beer['Photo']);
        } else {
            $fileName = $beer['Photo'];
        }

        $beerModel->updateBeer($id, $_POST, $fileName);
        $http->redirectTo('/admin');
    }
}