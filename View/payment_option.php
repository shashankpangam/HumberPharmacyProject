<?php
session_start();
include_once "../Model/config.php";
require_once '../Model/Product_DB.php';

//continue if item_ids are set in post
if(isset($_POST["item_code"])){
	
	//make sure ids are numbers
	foreach ($_POST["item_code"] as $itm_id) { 
		if (!(is_numeric($itm_id))) {
			die("Product id passed must be integers!");
		} 
	}
	
	//convert item ids into string using implode(), seperated by comma.
	$item_codes = implode(',', $_POST["item_code"]);
	
	//select products using given ids 
        $results = Product_DB::getProductsByIDS($item_codes);
        $count = count($results);
        $items = array();
        $item_total=0;
        foreach ($results as $row) :
            $item_quantity = ( isset( $_POST[$row->getProductID()."_qty"] ) && is_numeric( $_POST[$row->getProductID()."_qty"] ) ) ? $_POST[$row->getProductID()."_qty"] : 1;
            $item = array('name' => $row->getProductName(),
                          'quantity' => $item_quantity,
                          'price'=>$row->getProductPrice(),
                          'sku'=> $row->getProductID(),
                          'currency' => PP_CURRENCY);
            array_push($items, $item);
            $item_total = $item_total + ($row->getProductPrice() * $item_quantity);
        endforeach;
        var_dump($items);
	
	//Set session variables of items and total price for later use.
	$_SESSION["items"] = $items;
	$_SESSION["items_total"] = $item_total;
										
}else{
	die("Please select atlease 1 product");
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Select Payment Method</title>

<style type="text/css">
.payment_method {background:#F8F8F8;padding: 20px;width: 450px;margin: 20px auto;font-family: Georgia, "Times New Roman", Times, serif;color: #585858;}
.payment_method select{padding: 5px;box-sizing: border-box;border: 1px solid #ddd;border-radius: 3px;}
.select_method{text-align: center;}
.credit_card_info{background: #fff;padding: 20px;margin-top: 10px;}
.credit_card_info label{display: block;margin-bottom: 5px;}
.credit_card_info input[type=text]{padding: 5px;box-sizing: border-box;border: 1px solid #ddd;border-radius: 3px;}
.credit_card_info label span{float: left;width: 190px;text-align: right;margin-right: 5px;}
</style>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	
	//Payment method selection by user
	$( "#payment_method" ).change(function() {
		if($(this).val()=="credit_card"){
			$( ".credit_card_info").fadeIn();
			$(this).parent().find('input[type="submit"]').hide();
		}else{
			$( ".credit_card_info").fadeOut();
			$(this).parent().find('input[type="submit"]').show();
		}
	});
	
	$("#credit_cart_pay").submit(function( event ){
		var proceed = true;
		$("#credit_cart_pay input[required=true]").each(function(){
					$(this).css('border-color','');
					if(!$.trim($(this).val())){ //if this field is empty 
						$(this).css('border-color','red'); //change border color to red   
						proceed = false;
						event.preventDefault();
					}
		});
		if(proceed){
			$("#button_wrp").html("Please wait..");
		}
	});
	
});
</script>
</head>
<body>

<div class="payment_method">
<div class="select_method">
Select a Payment Method.
<form action="../Model/order_process.php" method="post" >
<select id="payment_method">
	<option value="paypal">PayPal</option>
	<option value="credit_card">Credit Card</option>
</select>

<input type="hidden" name="payment_method" value="paypal" />

<input type="submit" value="Go">
</form>
</div>

<form action="order_process.php" method="post" id="credit_cart_pay"  class="credit_card_info" style="display:none" novalidate>
<label><span>First Name :</span><input type="text" name="credit_card_first_name" required="true"  /></label>
<label><span>Last Name :</span><input type="text" name="credit_card_last_name" required="true"  /></label>
<label><span>Card Type :</span><select name="credit_card_type">
                                    <option value="visa">Visa</option>
                                    <option value="mastercard">Mastercard</option>
                                </select>
</label>
<label><span>Credit Card Number :</span><input type="text" name="credit_card_number" value="4693532184432199" required="true" /></label>
<label><span>Expire Month :</span><input type="text" name="credit_card_expire_month" value="12" required="true" /></label>
<label><span>Expire Year :</span><input type="text" name="credit_card_expire_year" value="2018" required="true" /></label>
<label><span>cvv2 :</span> <input type="text" name="credit_card_cvv2" value="111"  required="true" /></label>

<input type="hidden" name="payment_method" value="credit_card" />

<div align="center" id="button_wrp"><input type="submit" value="Pay with Credit Card"></div>
</form>
</div>
