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
            echo '<p style="font-size: 20px;float:left;"><strong><font color="Black">Recent Views:</font></strong></p><div id="recentview"><ul>';
            foreach ($recentProducts as $products) :
                echo '<li><a href=productDesc.php?ID='.$products->getProductID().'><div class="imagecontainer" style="width:130px"><img src='.$products->getProductImage().'  /></div></a></li>';
            endforeach;
            echo '</ul></div></p>';
        }
    }
    ?>

    <div id="footer-wrapper">
        <img src="../images/cards.jpg" alt="" width="919" height="76" ><img src="../images/paypalimage.png" height="70" width="70" id="paypalimg">
    </div>
    
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