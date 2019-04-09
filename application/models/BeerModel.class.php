<?php

class BeerModel
{
	public function listAllBeers()
    {
        $database = new Database();

        $sql = 'SELECT
                    *
                FROM beers';

        return $database->query($sql, []);
    }

    public function findOneBeer($productId)
    {
    	$database = new Database();

        $sql = 'SELECT
                    *
                FROM beers
                WHERE Id = ?';

        return $database->queryOne($sql, [ $productId ]);

    }

    public function addBeer($post, $name) {
        $database = new Database();

        $sql = 'INSERT INTO beers(Name, Photo, Description, QuantityInStock, BuyPrice, SalePrice) VALUES (?, ?, ?, ?, ?, ?)';


         $database->executeSql($sql, [ $post['name'],$name, $post['description'], $post['quantity'], $post['buyPrice'], $post['salePrice'] ]);
    }

    public function deleteBeer($id) {

        $database = new Database();

        $sql = 'DELETE FROM beers WHERE Id=?';

        $database->executeSql($sql, [ $id ]);

        
    }

    public function updateBeer($id, $post, $photo) {
        $database = new Database();

        $sql = 'UPDATE beers SET Name=?, Photo=?, Description=?, QuantityInStock=?, BuyPrice=?, SalePrice=? WHERE Id = ?';

        $database->executeSql($sql, [ $post['name'], $photo, $post['description'], $post['quantity'], $post['buyPrice'], $post['salePrice'], $id ]);
    }

}