<?php

//insert.php
echo "Hollo";
if(isset($_POST["item_name"]))
{
	
	require_once '../config/conin.php';

	$order_id = uniqid();

	for($count = 0; $count < count($_POST["item_name"]); $count++)
	{

		$query = "
		INSERT INTO history(h_value,item_id, unit_id) 
        VALUES ( :item_quantity,:item_name, :item_unit)
		";

		$statement = $connect->prepare($query);

		$statement->execute(
			array(
				':item_name'	=>	$_POST["item_name"][$count],
				':item_quantity'=>	$_POST["item_quantity"][$count],
				':item_unit'	=>	$_POST["item_unit"][$count]
			)
		);

	}

	$result = $statement->fetchAll();

	if(isset($result))
	{
		echo 'ok';
	}

}

?>
