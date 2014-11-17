<?php
require_once './header.php';
require_once '../Model/Product_DB.php';
$request = $_GET['category'];
$names=array(
    "Medicines" => "Medicines",
    "Vitamins" => "Vitamins",
    "DietandFitness" => "Diet and Fitness",
    "Personal" => "Personal",
    "FeaturedProducts" => "Featured Products"
);
?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div id="main">
        <div id="inside">
            <div class="saleprodheader">
                <h4><?php echo $names[$request]?></h4>
            </div>
            <div id="items">
                <?php
                    if($request=="FeaturedProducts")
                    {
                        $records=  Product_DB::getProductByOffers();
                    }
                    else
                    {
                        $records = Product_DB::getProductByCategory($request);
                    }
                    foreach($records as $rows) :
                ?>
                <div class="item center">
                    <a href="productDesc.php?<?php echo "ID=".$rows->getProductID();?>"><img src="<?php echo $rows->getProductImage()?>" width="190" height="192" /></a><br />
                    <p><a href="productDesc.php?<?php echo "ID=".$rows->getProductID();?>"><?php echo $rows->getProductName();?></a></p><span class="price"><?php echo $rows->getProductPrice();?></span><br />
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>