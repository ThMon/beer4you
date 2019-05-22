<?php

class AdminController
{
    public function httpGetMethod(Http $http, array $queryFields)
    {
    	

        if(empty($_SESSION) == true || $_SESSION['user']['role'] != "admin" ) {
            $http->redirectTo('/');
        }

        $beerModel = new BeerModel();
        $beers = $beerModel->listAllBeers();

        $userModel = new UserModel();
        $users = $userModel->listAllUsers();

        return [
            'beers' => $beers,
            'users' => $users
        ];
    }

    public function httpPostMethod(Http $http, array $formFields)
    {
    	
    }
}