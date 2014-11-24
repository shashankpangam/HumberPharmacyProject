<?php
session_start();

include_once "./config.php";
include_once "../vendor/autoload.php"; //include PayPal SDK
include_once "./functions.inc.php"; //our PayPal functions

if(isset($_POST["payment_method"]) && isset($_SESSION["items"])){
	
	//card details for credit card payemnt
	if($_POST["payment_method"] == "credit_card"){
		$cc_first_name 		= (isset($_POST["credit_card_first_name"]))? $_POST["credit_card_first_name"] : die("First Name Empty");
		$cc_last_name 		= (isset($_POST["credit_card_last_name"]))? $_POST["credit_card_last_name"] : die("Last Name Empty");
		$cc_card_type 		= (isset($_POST["credit_card_type"]))? $_POST["credit_card_type"] : die("Credit Card type Empty");
		$cc_card_number 	= (isset($_POST["credit_card_number"]))? $_POST["credit_card_number"] : die("Credit Card Number Empty");
		$cc_card_month 		= (isset($_POST["credit_card_expire_month"]))? $_POST["credit_card_expire_month"] : die("Expire Month Empty");
		$cc_card_year 		= (isset($_POST["credit_card_expire_year"]))? $_POST["credit_card_expire_year"] : die("Expire Year Empty");
		$cc_card_cvv2 		= (isset($_POST["credit_card_cvv2"]))? $_POST["credit_card_cvv2"] : die("CVV month empty");
	}
		
	//set array of items details from session, single or multiple
	$items = $_SESSION["items"];

	//get total amount from session. 
	$total_amount = $_SESSION["items_total"];

	// try a payment request
	try{ 
		######## if payment method is PayPal ##############	
		if($_POST["payment_method"] == "paypal"){
			//if payment method was PayPal, we need to redirect user to PayPal approval URL
			$result = create_paypal_payment($total_amount, PP_CURRENCY, '', $items, RETURN_URL, CANCEL_URL);
			if($result->state == "created" && $result->payer->payment_method == "paypal"){
				$_SESSION["payment_id"] = $result->id; //set payment id for later use, we need this to execute payment
				unset($_SESSION["items"]); //unset item session, not required anymore.
				unset($_SESSION["items_total"]); //unset items_total session, not required anymore.
				header("location: ". $result->links[1]->href); //after success redirect user to approval URL 
				exit();
			}
		
		}
		
		######## if payment method is Credit Card ##############	
		if($_POST["payment_method"] == "credit_card"){
			$credit_card = array(
								'type'=> $cc_card_type, 
								'number' => $cc_card_number, 
								'expire_month'=>$cc_card_month, 
								'expire_year'=>$cc_card_year, 
								'cvv2'=>$cc_card_cvv2,
								'first_name'=>$cc_first_name,
								'last_name'=>$cc_last_name
								);
									
			//pay directly using credit card information.
			$result = pay_direct_with_credit_card($credit_card, PP_CURRENCY , $total_amount, $items, '') ;		
				
				//If credit card payment is succesful, get results
				if($result->state == "approved" && $result->payer->payment_method == "credit_card"){
					unset($_SESSION["items"]); //unset item session, not required anymore.
					unset($_SESSION["items_total"]); //unset items_total session, not required anymore.
		
					//get transaction details
					$transaction_id 		= $result->transactions[0]->related_resources[0]->sale->id;
					$transaction_time 		= $result->transactions[0]->related_resources[0]->sale->create_time;
					$transaction_currency 	= $result->transactions[0]->related_resources[0]->sale->amount->currency;
					$transaction_amount 	= $result->transactions[0]->related_resources[0]->sale->amount->total;
					$transaction_method 	= $result->payer->payment_method;
					$transaction_state 		= $result->transactions[0]->related_resources[0]->sale->state;
					
					//get payer details
					$payer_first_name 		= $result->payer->payer_info->first_name;
					$payer_last_name 		= $result->payer->payer_info->last_name;
					$payer_email 			= $result->payer->payer_info->email;
					$payer_id				= $result->payer->payer_info->payer_id;
					
					//get shipping details 
					$shipping_recipient		= $result->transactions[0]->item_list->shipping_address->recipient_name;
					$shipping_line1			= $result->transactions[0]->item_list->shipping_address->line1;
					$shipping_line2			= $result->transactions[0]->item_list->shipping_address->line2;
					$shipping_city			= $result->transactions[0]->item_list->shipping_address->city;
					$shipping_state			= $result->transactions[0]->item_list->shipping_address->state;
					$shipping_postal_code	= $result->transactions[0]->item_list->shipping_address->postal_code;
					$shipping_country_code	= $result->transactions[0]->item_list->shipping_address->country_code;

					//insert into database		   
					$insert_row = $mysqli->query("INSERT INTO my_orders (transaction_id, transaction_currency, transaction_amount, transaction_method, transaction_state)
							VALUES ('$transaction_id', '$transaction_currency', '$transaction_amount', '$transaction_method', '$transaction_state')");
					
					//set $_SESSION["results"] session, you can print_r($result); to see what is returned
					$_SESSION["results"]  = array(
							'transaction_id' => $transaction_id, 
							'transaction_time' => $transaction_time,
							'transaction_currency' => $transaction_currency,
							'transaction_amount' => $transaction_amount,
							'transaction_method' => $transaction_method,
							'transaction_state' => $transaction_state
							);
								
					header("location: ". RETURN_URL); //$_SESSION["results"] is set, redirect back to order_process.php
					exit();
				}
		}

	}catch(PPConnectionException $ex) {
		echo parseApiError($ex->getData());
	} catch (Exception $ex) {
		echo $ex->getMessage();
	}

}


### If Payment method was PayPal, user is redirected back to this page with token and Payer ID ###
if(isset($_GET["token"]) && isset($_GET["PayerID"]) && isset($_SESSION["payment_id"])){
	try{
		$result = execute_payment($_SESSION["payment_id"], $_GET["PayerID"]);  //call execute payment function.

		if($result->state == "approved"){ //if state = approved continue..
			//SUCESS
			
			unset($_SESSION["payment_id"]); //unset payment_id, it is no longer needed 
			
			//get transaction details
			$transaction_id 		= $result->transactions[0]->related_resources[0]->sale->id;
			$transaction_time 		= $result->transactions[0]->related_resources[0]->sale->create_time;
			$transaction_currency 	= $result->transactions[0]->related_resources[0]->sale->amount->currency;
			$transaction_amount 	= $result->transactions[0]->related_resources[0]->sale->amount->total;
			$transaction_method 	= $result->payer->payment_method;
			$transaction_state 		= $result->transactions[0]->related_resources[0]->sale->state;
			
			//get payer details
			$payer_first_name 		= $result->payer->payer_info->first_name;
			$payer_last_name 		= $result->payer->payer_info->last_name;
			$payer_email 			= $result->payer->payer_info->email;
			$payer_id				= $result->payer->payer_info->payer_id;
			
			//get shipping details 
			$shipping_recipient		= $result->transactions[0]->item_list->shipping_address->recipient_name;
			$shipping_line1			= $result->transactions[0]->item_list->shipping_address->line1;
			$shipping_line2			= $result->transactions[0]->item_list->shipping_address->line2;
			$shipping_city			= $result->transactions[0]->item_list->shipping_address->city;
			$shipping_state			= $result->transactions[0]->item_list->shipping_address->state;
			$shipping_postal_code	= $result->transactions[0]->item_list->shipping_address->postal_code;
			$shipping_country_code	= $result->transactions[0]->item_list->shipping_address->country_code;
						
			//insert into database		   
			$insert_row = $mysqli->query("INSERT INTO my_orders (transaction_id, transaction_currency, transaction_amount, transaction_method, transaction_state)
					VALUES ('$transaction_id', '$transaction_currency', '$transaction_amount', '$transaction_method', '$transaction_state')");
			
			   			
			//Set session for later use, print_r($result); to see what is returned
			$_SESSION["results"]  = array(
					'transaction_id' => $transaction_id, 
					'transaction_time' => $transaction_time,
					'transaction_currency' => $transaction_currency,
					'transaction_amount' => $transaction_amount,
					'transaction_method' => $transaction_method,
					'transaction_state' => $transaction_state
					);
						
			header("location: ". RETURN_URL); //$_SESSION["results"] is set, redirect back to order_process.php
			exit();
		}
		
	}catch(PPConnectionException $ex) {
		$ex->getData();
	} catch (Exception $ex) {
		echo $ex->getMessage();
	}

}

### Display order confirmation if $_SESSION["results"] is set  ####
if(isset($_SESSION["results"]))
{
	$html = '<!DOCTYPE HTML>';
	$html .= '<html>';
	
	
	$html .= '<head>';
	$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
	$html .= '<title>Order Confirm Details</title>';
	$html .= '<style type="text/css">';
	$html .= '.transaction_info {margin:0px auto; background:#F2FCFF;; max-width: 750px; color:#555;}';
	$html .= '.transaction_info thead {background: #BCE4FA;font-weight: bold;}';
	$html .= '.transaction_info thead tr th {border-bottom: 1px solid #ddd;}';
	$html .= '</style>';
	$html .= '</head>';
	$html .= '<body>';

	$html .='<div align="center"><h2>Payment Success</h2></div>';
	$html .='<div align="center">Please note down your transaction ID, it will be required for further communication!</div>';
	$html .= '<table border="0" cellpadding="10" cellspacing="0" class="transaction_info">';
	
	$html .= '<thead><tr><td>Transaction ID</td><td>Date</td><td>Currency</td><td>Amount</td><td>Method</td><td>State</td></tr></thead>';
	
	$html .= '<tbody><tr>';
	$html .= '<td>'.$_SESSION["results"]["transaction_id"].'</td>';
	$html .= '<td>'.$_SESSION["results"]["transaction_time"].'</td>';
	$html .= '<td>'.$_SESSION["results"]["transaction_currency"].'</td>';
	$html .= '<td>'.$_SESSION["results"]["transaction_amount"].'</td>';
	$html .= '<td>'.$_SESSION["results"]["transaction_method"].'</td>';
	$html .= '<td>'.$_SESSION["results"]["transaction_state"].'</td>';
	$html .= '</tr>';
	$html .= '<tr><td colspan="6"><div align="center"><a href="index.php">Back to Products Page</a></div></td></tr>';
	$html .= '</tbody>';
	$html .= '</table>';
	$html .= '</body>';
	$html .= '</html>';
	
	echo $html;
	
	unset($_SESSION["results"]);
}
?>
