<?php
require_once './header.php';
require_once '../Model/Product_DB.php';
$request = $_GET['ID'];
$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
session_start();
?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div id="main">
<<<<<<< HEAD
        <div id="inside" style="padding: 20px 20px 0px 50px;">
=======
        <div id="inside">
            <form method="post" action="../Model/ShoppingCart.php"> 
>>>>>>> cce529a08d4515ac7993d2b84690912be404f979
            <?php
            $item = Product_DB::getProductByID($request);
            ?>
<<<<<<< HEAD
            <div class="productname" style="float: left; width: 300px;">
                <h2><?php echo $item->getProductName() ?></h2>               
                <div>
                    <label class="<?php
                    $instock = $item->getProductQuantity();
                    if ($instock > 0)
                        echo "instock";
                    else
                        echo "outofstock";
                    ?>" style="font-size: 30px;">
                           <?php
                           $instock = $item->getProductQuantity();
                           if ($instock > 0)
                               echo "In Stock";
                           else
                               echo "Out Of Stock";
                           ?>
                    </label>
                    <img src="<?php echo $item->getProductImage() ?>" width="290" alt="<?php $item->getProductImage() ?>" />
                </div>           
            </div>
            <div class="bigprice" style="postision:relative;">
                <h2>$<?php echo $item->getProductPrice(); ?></h2>
                <label><font color="red">RECOMMEND FOR</font></label><br>
                <ul>
                    <?php
=======
                <input type="hidden" name="product_id" value="<?php echo $item->getProductID();?>"/>
                <input type="hidden" name="type" value="add" />
                <input type="hidden" name="return_url" value="<?php echo $current_url ?>" />
            <label class="productname"><?php echo $item->getProductName()?></label><span class="bigprice">$<?php echo $item->getProductPrice();?></span><br/>
            <label class="<?php
                $instock = $item->getProductQuantity();
                if($instock>0)
                        echo "instock";
                    else
                        echo "outofstock";
            ?>">
                <?php
                    $instock = $item->getProductQuantity();
                    if($instock>0)
                        echo "In Stock";
                    else
                        echo "Out Of Stock";
                ?>
            </label><br/>
            <label>Quantity</label>
                <select name="product_qty">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            <button class="add_to_cart">Add To Cart</button>
            <br/>
            
            <label>Best For:</label>
            <ul>
                <?php 
>>>>>>> cce529a08d4515ac7993d2b84690912be404f979
                    $symptoms = $item->getSymptoms();
                    $arrSymptoms = explode(",", $symptoms);
                    foreach ($arrSymptoms as $index) :
                        ?>
                        <li><?php echo $index; ?></li>
                        <?php
                    endforeach;
<<<<<<< HEAD
                    ?>
                </ul>
                <div>           
                    <label>Product Description</label>
                    <p><?php
                        echo $item->getProductDescription();
                        ?></p>
                </div>
            </div>
            <input class="btnsubmit" type="submit" name="submit" value="Add To Cart" style="width:90px;">

=======
                ?>
            </ul>
            <img src="<?php echo $item->getProductImage()?>" width="350" alt="<?php $item->getProductImage()?>" /><br/>
            <label>Product Description</label>
            <p><?php
                echo $item->getProductDescription();
            ?></p>
            </form>
>>>>>>> cce529a08d4515ac7993d2b84690912be404f979
        </div>

    </div>

</div>
<?php
require_once './footer.php';
?>
