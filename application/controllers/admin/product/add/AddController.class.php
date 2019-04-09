<?php

class AddController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	
        if(empty($_SESSION) == true) {
            $http->redirectTo('/user/login');
        }
    }

    public function httpPostMethod(Http $http, array $formFields)
    {

        $fileName = $_FILES['beer_pict']['name'];

        var_dump($_FILES['beer_pict']['size'] > 0);

        if ($_FILES['beer_pict']['size'] > 0 ) {
           $http->moveUploadedFile('beer_pict', '/images/beers'); 

        } else {
            $fileName = 'no-photo.png';
        }

        var_dump($fileName);
        $beerModel = new BeerModel();
        $beerModel->addBeer($_POST, $fileName);
        $http->redirectTo('/admin');
    }
}