<?php
ini_set('session.cookie_domain', str_replace('www.','',$_SERVER['SERVER_NAME']));
include("cart.php");

session_start();

include("connection.php");



if(!session_is_registered("cart")) {

	$cart=new Cart();

$_SESSION['cart']=$cart;

//	session_register("cart");

}

if($_POST["action_val"]!=""){

	switch($_POST["action_val"]) {

		case "add_to_cart":

		{

			$nArr = array();

			$nArr = $_POST["forms_id"];

			while (list ($key,$val) = @each ($nArr))

			$_SESSION["cart"]->add($val,$_POST["state"]);

		}

		break;

		case "remove_from_cart":

			foreach($_POST["pID"] as $value){

				$_SESSION["cart"]->remove($value);

			}

		break;

	}

}
echo $_SESSION["cart"]->no_items_in_cart();
?>