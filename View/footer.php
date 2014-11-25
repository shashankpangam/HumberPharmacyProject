<div id="footer">
    <?php
    require_once '../Model/RecentView_DB.php';
    if (isset($_SESSION["customer"])) {
        $customerid = $_SESSION["customer"];
        $results = RecentView_DB::getRecentViews($customerid);

        if ($results != null) {
            $ids = array();
            foreach ($results as $row) :
                $id = $row->getProductID();
                $ids[] = $id;
            endforeach;
            $productids = implode(',', $ids);
            $recentProducts = Product_DB::getProductsByIDS($productids);
            echo '<label align="left"><strong><h2><font color="Black">Recent Views</font></h2></strong></label><div id="recentview"><ul>';
            foreach ($recentProducts as $products) :
                echo '<li><a href=productDesc.php?ID='.$products->getProductID().'><div class="imagecontainer"><img src='.$products->getProductImage().'  /></div><span class=recentProductName>'.$products->getProductName().'</span></a></li>';
            endforeach;
            echo '</ul></div>';
        }
    }
    ?>

    <img src="../images/cards.jpg" alt="" width="919" height="76" />
    <ul>
        <li><a href="index.php">Home page</a> |</li>
        <li><a href="productSale.php">Sale Products</a> |</li>
        <li><a href="#">Reviews</a> |</li>
        <li><a href="contactus.php">Contact Us</a></li>
    </ul>
    <p>Copyright &copy; 2014.</p>																																																																				
</div>
<map name="Map">
    <area shape="rect" coords="16,306,159,326" href="#">
</map>
</body>
</html>