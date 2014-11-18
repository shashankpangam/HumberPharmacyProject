<?php
require_once './header.php';
require_once '../Model/Product_DB.php';
$request = $_GET['ID'];
?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div id="main">
        <div id="inside" style="padding: 20px 20px 0px 50px;">
            <?php
            $item = Product_DB::getProductByID($request);
            ?>
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
                    $symptoms = $item->getSymptoms();
                    $arrSymptoms = explode(",", $symptoms);
                    foreach ($arrSymptoms as $index) :
                        ?>
                        <li><?php echo $index; ?></li>
                        <?php
                    endforeach;
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

        </div>

    </div>

</div>
<?php
require_once './footer.php';
?>
