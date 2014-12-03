<?php
require_once '../Model/Review_DB.php';
require_once '../Model/Product_DB.php';
?>
<div id="sidebar">
    <div id="navigation">
        <ul>
            <li><a href="productList.php?category=Medicines&min=0&max=6" name="category" value="Medicines">Medicines</a></li>
            <li><a href="productList.php?category=Vitamins&min=0&max=6" name="category" value="Vitamins">Vitamins</a></li>
            <li><a href="productList.php?category=DietandFitness&min=0&max=6" name="category" value="dietandfitness">Diet and Fitness</a></li>
            <li><a href="productList.php?category=Personal&min=0&max=6" name="category" value="Personal">Personal</a></li>
            <li><a href="productList.php?category=FeaturedProducts&min=0&max=6" name="category" values="FeaturedProducts">Featured Products</a></li>
            <li><a href="viewCart.php">Checkout</a></li>
        </ul>
    </div>
    <div id="cart">

        <?php
        if (isset($_SESSION["products"])) {
            $items = count($_SESSION["products"]);
        } else {
            $items = 0;
        }
        ?>
        <table   width="100%">
            <tr>
                <td width="20%" align="center"><a href="viewCart.php"><img src="../images/shopcart.png" alt="Shopping Cart" height="30px" width="30px"/></a></td>
                <td width="80%"><a href="viewCart.php" id="shoppingcartlink"><strong>Shopping cart:</strong><?php echo $items ?> items</a></td>
            </tr>
        </table>
    </div>
    <div>
        <img src="../images/title2.gif" alt="" width="233" height="41" /><br />																																																																																																																																																															
        <div class="review">
            <?php
            $review = Review_DB::getRandomReview();
            $ratings = $review->getRatings();
            $product = Product_DB::getProductByID($review->getProductID());
            ?>
            <a href="productDesc.php?ID=<?php echo $product->getProductID(); ?>"><img src="<?php echo $product->getProductImage(); ?>" alt="<?php echo $product->getProductName(); ?>" width="181" height="161" /></a>
            <br />
            <a href="productDesc.php?ID=<?php echo $product->getProductID(); ?>"><?php echo $product->getProductName() ?></a><br />
            <p><?php echo $review->getReviews(); ?></p>
            <!--<img src="../images/stars.jpg" alt="" width="118" height="20" class="stars" />-->
            <!--<label><?php echo $review->getRatings() . '/5'; ?></label>-->
            <span class="starlocation">
                <span class="rating">
                    <?php
                    $num = 5;
                    for ($i = 1; $i < 6; $i++) {
                        ?>
                        <input type="radio" class="rating-input"
                               id="rating-input-1-<?php echo $num; ?>" name="rating-input-<?php echo $i; ?>" value="<?php echo$i; ?>" <?php if ($num == $ratings) {
                        echo'checked=checked';
                    } ?>>
                        <label for="rating-input-1-<?php echo $num; ?>" class="rating-star"></label>
                        <?php
                        $num--;
                    }
                    ?>
                </span>
            </span>
        </div>
    </div>
</div>
