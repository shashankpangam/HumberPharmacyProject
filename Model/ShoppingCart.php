<?php
require_once './Product.php';
require_once './Product_DB.php';
session_start();

//empty cart by distroying current session
if(isset($_GET["emptycart"]) && $_GET["emptycart"]==1)
{
	$return_url = base64_decode($_GET["return_url"]); //return url
	session_destroy();
	header('Location:'.$return_url);
}

//add item in shopping cart
if(isset($_POST["type"]) && $_POST["type"]=='add')
{
	$product_id 	= filter_var($_POST["product_id"], FILTER_SANITIZE_NUMBER_INT); //product id
	$product_qty 	= filter_var($_POST["product_qty"], FILTER_SANITIZE_NUMBER_INT); //product quantity
	$return_url 	= base64_decode($_POST["return_url"]); //return url
	
        $result = Product_DB::getProductByID($product_id);
	//limit quantity for single product
	if($product_qty > 10){
		die('<div align="center">This site does not allowed more than 10 quantity!<br /><a href="../View/productDesc.php?ID='.$product_id.'">Go Back</a>.</div>');
	}
        else if($result->getProductQuantity()<$product_qty)
        {
            die('<div align="center">Not enough quantity available! <br /><a href="../View/productDesc.php?ID='.$product_id.'">Go Back</a>.</div>');
        }

	//MySqli query - get details of item from db using product code
	
	//$obj = $results->fetch_object();
	
	if ($result) { //we have the product info 
		
		//prepare array for the session variable
		$new_product = array(array('name'=>$result->getProductName(), 'code'=>$result->getProductID(), 'qty'=>$product_qty, 'price'=>$result->getProductPrice()));
		
		if(isset($_SESSION["products"])) //if we have the session
		{
			$found = false; //set found item to false
			
			foreach ($_SESSION["products"] as $cart_itm) //loop through session array
			{
				if($cart_itm["code"] == $product_code){ //the item exist in array

					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$product_qty, 'price'=>$cart_itm["price"]);
					$found = true;
				}else{
					//item doesn't exist in the list, just retrive old info and prepare array for session var
					$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
				}
			}
			
			if($found == false) //we didn't find item in array
			{
				//add new user item in array
				$_SESSION["products"] = array_merge($product, $new_product);
			}else{
				//found user item in array list, and increased the quantity
				$_SESSION["products"] = $product;
			}
			
		}else{
			//create a new session var if does not exist
			$_SESSION["products"] = $new_product;
		}
		
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}

//remove item from shopping cart
if(isset($_GET["removep"]) && isset($_GET["return_url"]) && isset($_SESSION["products"]))
{
	$product_id 	= $_GET["removep"]; //get the product code to remove
	$return_url 	= base64_decode($_GET["return_url"]); //get return url

	
	foreach ($_SESSION["products"] as $cart_itm) //loop through session array var
	{
		if($cart_itm["code"]!=$product_id){ //item does,t exist in the list
			$product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
		}
		
		//create a new product list for cart
		$_SESSION["products"] = $product;
	}
	
	//redirect back to original page
	header('Location:'.$return_url);
}
?>