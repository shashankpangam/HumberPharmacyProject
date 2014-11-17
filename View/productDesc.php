<?php
require_once './header.php';
require_once '../Model/Product_DB.php';
$request = $_GET['ID'];
?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div id="main">
        <div id="inside">
            <?php
                $item=Product_DB::getProductByID($request);
            ?>
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
            <label>Best For:</label>
            <ul>
                <?php 
                    $symptoms = $item->getSymptoms();
                    $arrSymptoms = explode(",", $symptoms);
                    foreach($arrSymptoms as $index) :
                ?>
                <li><?php echo $index;?></li>
                <?php
                    endforeach;
                ?>
            </ul>
            <img src="<?php echo $item->getProductImage()?>" width="350" alt="<?php $item->getProductImage()?>" /><br/>
            <label>Product Description</label>
            <p><?php
                echo $item->getProductDescription();
            ?></p>
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>
