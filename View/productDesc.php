<?php
require_once './header.php';
require_once '../Model/Product_DB.php';
require_once '../Model/Offer_DB.php';
$request = $_GET['ID'];
$current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div id="main">
        <div id="inside" style="padding-left: 30px;">
            <form method="post" action="../Model/ShoppingCart.php"> 
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
                    <div style="padding-top: 15px;">
                        <label>Quantity</label>
                        <select name="product_qty">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button class="add_to_cart" style="width:90px;height: 30px">Add To Cart</button>
                        <input type="hidden" name="product_id" value="<?php echo $item->getProductID(); ?>">
                        <input type="hidden" name="type" value="add" >
                        <input type="hidden" name="return_url" value="<?php echo $current_url ?>" >
                    </div>
                </div>
            </form> 
        </div>
        <div style="padding-left: 30px;position: relative; top:40px;">           
            <label><font color="red">PRODUCT DESCRIPTION</font></label>
            <p><?php
                echo $item->getProductDescription();
                ?></p>
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>