<?php
require_once 'header.php';
require_once '../Model/Databases.php';
require_once '../Model/Product_DB.php';
require_once '../Model/Product.php';
require_once '../Model/Offer_DB.php';
require_once '../Model/Review.php';
require_once '../Model/Review_DB.php';

if (isset($_GET['ID'])) {
    $request = $_GET['ID'];
}
if (isset($_SESSION["customer"])) {
    $customerid = $_SESSION["customer"];
}
//
//if (!isset($ratings)){
//    $ratings = 3; //$_POST['rating'];
//}

$current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
?>
<?php
// define variables and set to empty values
$error_message = $reviews = $ratings = "";

if (isset($_POST['submit'])) {

    //open a connection with the database
    $id = null;

    //intialize the variables with form data
    //$productid = $request;
    //$customerid = $_SESSION["customer"];
    $reviews = $_POST['reviews'];
    $ratings = $_POST['ratings'];


    if (empty($reviews) || empty($ratings)) {
        $error_message = "*One or more required fields are blank.";
    } else {

        $reviewid = null;
        $productid = $request;
        // $customerid = $_SESSION['customer'];
        $review = new Review($reviewid, $productid, $customerid, $reviews, $ratings);
        $insert = Review_DB::addNewReview($review);
        header("Location: productDesc.php?ID=$productid" . 'echo "Thank you for Review";');
        // header('location: thankyou.php?ID='.$productid);
    }
}
?>

<html>
    <head>
        <link href="stylesheet.css" rel="stylesheet"/>
        <script src="../Scripts/my_js.js"></script>
    </head>
    <body>
        <div id="content">
<?php require_once './sidebar.php'; ?>
            <div id="main">
                <div id="inside" style="padding-left: 30px;">
<?php
$item = Product_DB::getProductByID($request);
?>
                    <div class="productname" style="float: left; width: 325px;">
                        <h2><?php echo $item->getProductName() ?></h2>               
                        <div>
                            <label class="<?php
                    $instock = $item->getProductQuantity();
                    if ($instock > 0)
                        echo "instock";
                    else
                        echo "outofstock";
?>" style="font-size: 20px;"><?php
                            $instock = $item->getProductQuantity();
                            if ($instock > 0)
                                echo "In Stock";
                            else
                                echo "Out of Stock";
                            ?>
                            </label>                      
                        </div>   
                        <img src="<?php echo $item->getProductImage() ?>" height="192" width="190" alt="<?php $item->getProductImage() ?>" />
                    </div>
                    <div class="bigprice" style="float:right;width:325px;">
                        <!--
                            Checking for offers code
                        -->
                        </ul>                   
                    </div>
                    <div style="padding-top: 15px;">
                        <form method="post" action="../Model/ShoppingCart.php" > 
                            <label>Quantity</label>
                            <select name="product_qty">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <button class="btnsubmit" style="width:90px;height: 30px">Add To Cart</button>
                            <input type="hidden" name="product_id" value="<?php echo $item->getProductID(); ?>">
                            <input type="hidden" name="type" value="add" >
                            <input type="hidden" name="return_url" value="<?php echo $current_url ?>" >
                        </form>
                    </div>
                    <br/><br/>
                    <div style="padding-left: 30px; top:40px; margin-top: 70px">           
                        <label><font color="red">PRODUCT DESCRIPTION</font></label>
                        <p><?php
                                   echo $item->getProductDescription();
                            ?></p>
                    </div>
                    <div  style="padding-top: 30px; margin-top: 50px">


<?php
// define variables and set to empty values
$error_message = $reviews = $ratings = "";


if (isset($_POST['submit'])) {

    //open a connection with the database
    $id = null;

    //intialize the variables with form data

    $productid = $_POST['productid'];
    $customerid = $_POST['customerid'];
    $reviews = $_POST['reviews'];
    $ratings = $_POST['ratings'];


    if (empty($productid) || empty($customerid)) {
        $error_message = " id is missing";
    } elseif (empty($reviews) || empty($ratings)) {
        $error_message = "*One or more required fields are blank.";
    } else {
        $review = new Review($productid, $customerid, $reviews, $ratings);

        $insert = Review_DB::addNewReview($review);
        header("Location: index.php");
    }
}
?>


                        <?php
                        $checkoffer = Offer_DB::getOfferByProductID($request);
                        if ($checkoffer == null) {
                            ?>
                            <label class="realPrice" style="font-size: 15px;font-weight: bold;">$<?php echo $item->getProductPrice(); ?></label>
                            <?php
                        } else {
                            ?>
                            <label class="discountedPrice">$<?php echo ($item->getProductPrice() * ($checkoffer->getDiscountRate() / 100)); ?></label><br/>
                            <label class="realDiscountedPrice">This was for : $<?php
                            echo $item->getProductPrice();
                        }
                        ?></label><br/><br />

                        <label style="color: red;padding-top: 5px;padding-bottom: 5px;">RECOMMEND FOR:</label><br />
                        <ul>
                        <?php
                        $symptoms = $item->getSymptoms();
                        $arrSymptoms = explode(",", $symptoms);
                        foreach ($arrSymptoms as $index) :
                            ?>
                                <li><?php echo $index; ?></li>
    <?php
endforeach;
?>
                        </ul>                   
                    </div>
                    <div style="padding-top: 15px;">
                        <form method="post" action="../Model/ShoppingCart.php?" > 
                            <label>Quantity</label>
                            <select name="product_qty">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <button class="btnsubmit" style="width:90px;height: 30px">Add To Cart</button>
                            <input type="hidden" name="product_id" value="<?php echo $item->getProductID(); ?>">
                            <input type="hidden" name="type" value="add" >
                            <input type="hidden" name="return_url" value="<?php echo $current_url ?>" >
                        </form>
                    </div>
                    <br/><br/>
                    <div style="padding-left: 30px; top:40px; margin-top: 70px">           
                        <label><font color="red">PRODUCT DESCRIPTION</font></label>
                        <p><?php
echo $item->getProductDescription();
?></p>
                    </div>


                    <!--//                          $form = form;
                    //                         if(!$_SESSION = 'customer')
                    //                         {
                    //                            $form = 'hidden';
                    //                         }-->

                    <div  style="padding-top: 30px; margin-top: 50px">
                        <form  name = "form" method="post" action="productDesc.php?<?php echo "ID=" . $request; ?>"> 
                            <label><strong><h2><font color="Black">Write your Reviews</font></h2></strong></label>
                            <table style="width:80%" cellspacing="15">

<!--                                <tr>
                                    <td>Product ID:<font color="red"></font></td>
                                    <td><input type="text"  name="productid" value=</td>
                                </tr>
                                <tr>
                                    <td>Customer ID:<font color="red"></font></td>
                                    <td><input type="text"  name="customerid" value="</td>
                                </tr>-->

                                <tr><td>Review:<font color="red"></font></td>
                                    <td><textarea rows="5" cols="50"  name="reviews" value="<?php echo $reviews; ?>" ></textarea> </td> 		
                                </tr>
                                <tr>
                                    <td>Rating:<font color="red"></font></td>
                                    <td>
                                        <input class="starRating" id="rating1" type="radio" name="ratings" value="1">
                                        <label for="rating1"><span>1</span></label>

                                        <input class="starRating"  id="rating2" type="radio" name="ratings" value="2">
                                        <label for="rating2"><span>2</span></label>

                                        <input class="starRating" id="rating3" type="radio" name="ratings" value="3">
                                        <label for="rating3"><span>3</span></label>

                                        <input class="starRating" id="rating4" type="radio" name="ratings" value="4">
                                        <label for="rating4"><span>4</span></label>

                                        <input class="starRating" id="rating5" type="radio" name="ratings" value="5"> 
                                        <label for="rating5"><span>5</span></label>

                                    </td>
                                </tr>
                            </table>
                            <div class="bonesubmit">
                                <input class="btnsubmit" type="submit" name="submit" value="Submit" >

                                <span class="btwosubmit">
                                    <input class="btnsubmit" type="submit" name="clear" value="Clear" style="background-color:#CC3300;">
                                </span>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
<?php
require_once './footer.php';
?>
    </body>
</html>
