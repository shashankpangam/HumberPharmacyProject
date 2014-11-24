<?php
define('CLIENT_ID', 'ATQuqRDULEoLOGgT_kHHJBlGzUWEQQQPQN2Ei5pX2H1XrpucwKgHwZlGazW6'); //your PayPal client ID
define('CLIENT_SECRET', 'EPSAzhBAcONkKfQ_EXLkoqU1G9WCiT7c0tQV10S3pF2TzYkT1Qorwlzowmdy'); //PayPal Secret
define('RETURN_URL', 'http://localhost/HumberPharmacyProject/Model/order_process.php'); //return URL where PayPal redirects user
define('CANCEL_URL', 'http://localhost/HumberPharmacyProject/View/payment_cancel.html'); //cancel URL
define('PP_CURRENCY', 'CAD'); //Currency code
define('PP_MODE', 'sandbox'); //sandbox or live (sandbox requires testing credentials)
//define('PP_CONFIG_PATH', ''); //PayPal config path (sdk_config.ini)

include_once '../Model/Databases.php';
////Enter MySQL details
//$db_host 	= "localhost";
//$db_username 	= "root";
//$db_password 	= "";
//$db_name 	= "test";
//
////Open mySQL connection
//$mysqli = new mysqli( $db_host, $db_username, $db_password, $db_name);
//if ($mysqli->connect_error) {
//    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
//}

?>