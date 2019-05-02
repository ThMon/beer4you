<?php

class OrderModel {

	public function getAllOrders() {

		$database = new Database();

		$sql = "SELECT * FROM orders";

		$values = [ ];

		return $database->query($sql, $values);

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
	}
}

?>