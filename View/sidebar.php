<div id="sidebar">
    <div id="navigation">
        <ul>
            <li><a href="productList.php?category=Medicines&min=0&max=6" name="category" value="Medicines">Medicines</a></li>
            <li><a href="productList.php?category=Vitamins&min=0&max=6" name="category" value="Vitamins">Vitamins</a></li>
            <li><a href="productList.php?category=DietandFitness&min=0&max=6" name="category" value="dietandfitness">Diet and Fitness</a></li>
            <li><a href="productList.php?category=Personal&min=0&max=6" name="category" value="Personal">Personal</a></li>
            <li><a href="productList.php?category=FeaturedProducts&min=0&max=6" name="category" values="FeaturedProducts">Featured Products</a></li>
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
        <table   width="100%">
            <tr>
                <td width="20%" align="center"><a href="viewCart.php"><img src="../images/shopcart.png" alt="Shopping Cart" height="30px" width="30px"/></a></td>
                <td width="80%"><a href="viewCart.php" id="shoppingcartlink"><strong>Shopping cart:</strong><?php echo $items?> items</a></td>
            </tr>
        </table>
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
