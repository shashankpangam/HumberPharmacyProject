<div id="sidebar">
    <div id="navigation">
        <ul>
            <li><a href="productList.php?category=Medicines" name="category" value="Medicines">Medicines</a></li>
            <li><a href="productList.php?category=Vitamins" name="category" value="Vitamins">Vitamins</a></li>
            <li><a href="productList.php?category=DietandFitness" name="category" value="dietandfitness">Diet and Fitness</a></li>
            <li><a href="productList.php?category=Personal" name="category" value="Personal">Personal</a></li>
            <li><a href="productList.php?category=FeaturedProducts" name="category" values="FeaturedProducts">Featured Products</a></li>
            <li><a href="index.php">Checkout</a></li>
        </ul>
        
    </div>
    <div id="cart">
            <?php 
                if(isset($_SESSION["products"]))
                {
                    $items = count($_SESSION["products"]);
                }
 else {
     $items = 0;
 }
            ?>
            <a href="viewCart.php"><strong>Shopping cart:</strong> <br /> <?php echo $items?> items</a>
        </div>
    <div>
        <img src="../images/title2.gif" alt="" width="233" height="41" /><br />																																																																																																																																																															
        <div class="review">
            <a href="#"><img src="../images/pic1.jpg" alt="" width="181" height="161" /></a>
            <br />
            <a href="login.php">Product 07</a><br />
            <p>Dolor sit amet, consetetur sadipscing elitr, seddiam nonumy eirmod tempor. invidunt ut labore et dolore magna </p>
            <img src="../images/stars.jpg" alt="" width="118" height="20" class="stars" />

        </div>
    </div>
</div>
