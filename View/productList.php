<?php
require_once './header.php';
require_once '../Model/Product_DB.php';
$category = $_GET['category'];
$min = $_GET['min'];
$max = $_GET['max'];

$names = array(
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
                <h4><?php echo $names[$category] ?></h4>
            </div>
            <div id="items">
                <?php
                if ($category == "FeaturedProducts") {
                    $records = Product_DB::getProductByOffers();
                } else {
                    $records = Product_DB::getProductByCategory($category, $min, $max);
                }
                foreach ($records as $rows) :
                    ?>
                    <div class="item center" style="height:260px;">
                        <a href="productDesc.php?<?php echo "ID=" . $rows->getProductID(); ?>"><img src="<?php echo $rows->getProductImage() ?>" width="190" height="192" /></a><br />
                        <p style="float:left;"><a href="productDesc.php?<?php echo "ID=" . $rows->getProductID(); ?>"><?php echo $rows->getProductName(); ?></a></p><span class="price">$<?php echo $rows->getProductPrice(); ?></span><br />
                    </div>
                <?php endforeach; ?>

                <?php
                $product_count = Product_DB::getProductCountByCategory($category);
                $pager_size = round($product_count / 6);
                for ($x = 1; $x <= $pager_size; $x++) {
                    switch ($x) {
                        case 1:
                            $min = 0;
                            $max = 6;
                            break;
                        case 2:
                            $min = 7;
                            $max = 6;
                            break;
                        case 3:
                            $min = 13;
                            $max = 6;
                            break;
                        case 4:
                            $min = 19;
                            $max = 6;
                            break;
                        case 5:
                            $min = 25;
                            $max = 6;
                            break;
                        case 6:
                            $min = 31;
                            $max = 6;
                            break;
                        case 7:
                            $min = 37;
                            $max = 6;
                            break;
                    }

                    echo '<span style="padding-top:20px;"><a id="pager" style="padding:5px; margin:5px; color:#FFFFFF; background:#3792AE;text-decoration: none;text-align: center;" '
                    . 'href="productList.php?category=' . $category . '&min=' . $min . '&max=' . $max . '">' . $x . '</a></span>';
                }
                ?> 

            </div>
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>
