<?php

class OrderModel {

	public function getAllOrders() {

		$database = new Database();

		$sql = "SELECT * FROM orders";

		$values = [ ];

		return $database->query($sql, $values);

	}

	public function getAllOrderDetail($id) {
		$database = new Database();

		$sql = "SELECT *
				FROM
					orders
				WHERE id= ? ";

		$values = [ $id ];

		$order = $database->queryOne($sql, $values);


		$database = new Database();

		$sql = "SELECT *
				FROM
					users
				WHERE id= ? ";

		$values = [ $order['user_id'] ];

		$user = $database->queryOne($sql, $values);


		$sql = "SELECT orderlines.id, quantity, priceEach, Name, Photo
				FROM
					orderlines
				INNER join
					beers
				ON
					orderlines.beer_id = beers.Id
				WHERE order_id= ? ";

		$values = [ $id ];

		$orderDetail = $database->query($sql, $values);

		return  [ 
					'order'=> $order,
					'user'=> $user,
					'orderDetail'=>$orderDetail
				];
	}

	public function saveOrder($orders, $userId) {
		$database = new Database();

		$sql = "INSERT INTO `orders` (user_Id, CreationTimestamp) VALUES ( ?, NOW() )";

		$values = [ $userId ];

		$orderId = $database->executeSql($sql, $values);
		
		var_dump($orderId);

		$totalAmount =0;

		foreach($orders as $order) {
			$totalAmount += (floatval($order->quantity)*floatval($order->safePrice));



			$sql = "INSERT INTO orderlines (quantity, beer_id, order_id, priceEach) VALUES (?, ?, ?, ?)";

			$values = [ $order->quantity, $order->beerId, $orderId, $order->safePrice ];

			$database->executeSql($sql, $values);
		}

		var_dump($totalAmount);

		$sql = "UPDATE `orders` SET totalAmount=? WHERE id= ?";

		$values = [ $totalAmount, $orderId ];

		$database->executeSql($sql, $values);

		//return $totalAmount;
	}
}

?>