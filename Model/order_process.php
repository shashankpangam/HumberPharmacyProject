<?php

session_start();

define('CLIENT_ID', 'ATQuqRDULEoLOGgT_kHHJBlGzUWEQQQPQN2Ei5pX2H1XrpucwKgHwZlGazW6'); //your PayPal client ID
define('CLIENT_SECRET', 'EPSAzhBAcONkKfQ_EXLkoqU1G9WCiT7c0tQV10S3pF2TzYkT1Qorwlzowmdy'); //PayPal Secret
define('RETURN_URL', 'http://localhost/HumberPharmacyProject/View/viewCart.php'); //return URL where PayPal redirects user
define('CANCEL_URL', 'http://localhost/HumberPharmacyProject/View/paymentCancelled.php'); //cancel URL
define('PP_CURRENCY', 'CAD'); //Currency code
define('PP_CONFIG_PATH', './sdk_config.ini'); //PayPal config path (sdk_config.ini)

include_once "../vendor/autoload.php"; //include PayPal SDK
include_once "./functions.inc.php"; //our PayPal functions
#### Prepare for Payment ####
if (isset($_POST["item_code"])) {
    var_dump($_POST);
    $item_name = $_POST["item_name"]; //get item code
    $item_code = $_POST["item_code"]; //get item code
    $item_price = $_POST["item_price"]; //get item price
    $item_qty = $_POST["item_qty"]; //get quantity
    /*
      Note: DO NOT rely on item_price you get from products page, in production mode get only "item code"
      from the products page and then fetch its actual price from Database.
      Example :
      $results = $mysqli->query("SELECT item_name, item_price FROM products WHERE item_code= '$item_code'");
      while($row = $results->fetch_object()) {
      $item_name = $row->item_name;
      $item_price = item_price ;
      }
     */

    //set array of items you are selling, single or multiple
    //calculate total amount of all quantity. 
    $total_amount=0;
    $items=array();
    $count = count($item_name);
    for ($i = 0; $i < $count; $i++) {
        $item =
            array('name' => $item_name[$i], 'quantity' => $item_qty[$i], 'price' => $item_price[$i], 'sku' => $item_code[$i], 'currency' => PP_CURRENCY);
        $subtotal = ($item_qty[$i]*$item_price[$i]);
        $total_amount+=$subtotal;
        array_push($items,$item);
    }
    
    try { // try a payment request
        //if payment method is paypal
        $result = create_paypal_payment($total_amount, PP_CURRENCY, '', $items, RETURN_URL, CANCEL_URL);

        //if payment method was PayPal, we need to redirect user to PayPal approval URL
        if ($result->state == "created" && $result->payer->payment_method == "paypal") {
            $_SESSION["payment_id"] = $result->id; //set payment id for later use, we need this to execute payment
            header("location: " . $result->links[1]->href); //after success redirect user to approval URL 
            exit();
        }
    } catch (PPConnectionException $ex) {
        echo parseApiError($ex->getData());
    } catch (Exception $ex) {
        echo $ex->getMessage();
        var_dump($ex);
    }
}


### After PayPal payment method confirmation, user is redirected back to this page with token and Payer ID ###
if (isset($_GET["token"]) && isset($_GET["PayerID"]) && isset($_SESSION["payment_id"])) {
    try {
        $result = execute_payment($_SESSION["payment_id"], $_GET["PayerID"]);  //call execute payment function.

        if ($result->state == "approved") { //if state = approved continue..
            //SUCESS
            unset($_SESSION["payment_id"]); //unset payment_id, it is no longer needed 
            //get transaction details
            $transaction_id = $result->transactions[0]->related_resources[0]->sale->id;
            $transaction_time = $result->transactions[0]->related_resources[0]->sale->create_time;
            $transaction_currency = $result->transactions[0]->related_resources[0]->sale->amount->currency;
            $transaction_amount = $result->transactions[0]->related_resources[0]->sale->amount->total;
            $transaction_method = $result->payer->payment_method;
            $transaction_state = $result->transactions[0]->related_resources[0]->sale->state;

            //get payer details
            $payer_first_name = $result->payer->payer_info->first_name;
            $payer_last_name = $result->payer->payer_info->last_name;
            $payer_email = $result->payer->payer_info->email;
            $payer_id = $result->payer->payer_info->payer_id;

            //get shipping details 
            $shipping_recipient = $result->transactions[0]->item_list->shipping_address->recipient_name;
            $shipping_line1 = $result->transactions[0]->item_list->shipping_address->line1;
            $shipping_line2 = $result->transactions[0]->item_list->shipping_address->line2;
            $shipping_city = $result->transactions[0]->item_list->shipping_address->city;
            $shipping_state = $result->transactions[0]->item_list->shipping_address->state;
            $shipping_postal_code = $result->transactions[0]->item_list->shipping_address->postal_code;
            $shipping_country_code = $result->transactions[0]->item_list->shipping_address->country_code;

            /*
              ####  AT THIS POINT YOU CAN SAVE INFO IN YOUR DATABASE ###
              //see (http://www.sanwebe.com/2013/03/basic-php-mysqli-usage) for mysqli usage

              //Open a new connection to the MySQL server
              $mysqli = new mysqli('host','username','password','database_name');

              //Output any connection error
              if ($mysqli->connect_error) {
              die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
              }

              $insert_row = $mysqli->query("INSERT INTO transactions (payer_id, payer_name, payer_email, transaction_id)
              VALUES ('payer_first_name' , '$payer_email' , '$transaction_id')");
             */

            //Set session for later use, print_r($result); to see what is returned
            $_SESSION["results"] = array(
                'transaction_id' => $transaction_id,
                'transaction_time' => $transaction_time,
                'transaction_currency' => $transaction_currency,
                'transaction_amount' => $transaction_amount,
                'transaction_method' => $transaction_method,
                'transaction_state' => $transaction_state
            );

            header("location: " . RETURN_URL); //$_SESSION["results"] is set, redirect back to order_process.php
            exit();
        }
    } catch (PPConnectionException $ex) {
        $ex->getData();
    } catch (Exception $ex) {
        echo $ex->getMessage();
    }
}

### Display order confirmation if $_SESSION["results"] is set  ####
if (isset($_SESSION["results"])) {
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
    $html .= '<table border="0" cellpadding="10" cellspacing="0" class="transaction_info">';

    $html .= '<thead><tr><td>Transaction ID</td><td>Date</td><td>Currency</td><td>Amount</td><td>Method</td><td>State</td></tr></thead>';

    $html .= '<tbody><tr>';
    $html .= '<td>' . $_SESSION["results"]["transaction_id"] . '</td>';
    $html .= '<td>' . $_SESSION["results"]["transaction_time"] . '</td>';
    $html .= '<td>' . $_SESSION["results"]["transaction_currency"] . '</td>';
    $html .= '<td>' . $_SESSION["results"]["transaction_amount"] . '</td>';
    $html .= '<td>' . $_SESSION["results"]["transaction_method"] . '</td>';
    $html .= '<td>' . $_SESSION["results"]["transaction_state"] . '</td>';
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
