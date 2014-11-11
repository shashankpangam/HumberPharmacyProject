<?php
require_once './header.php';
require_once '../Model/Product_DB.php';
$request = $_GET['category'];
?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div id="main">
        <div id="inside">
            <div class="saleprodheader">
                <h4><?php echo $request?></h4>
            </div>
            <div id="items">
                <?php
                    $records = Product_DB::getProductByCategory($request);
                    foreach($records as $rows) :
                ?>
                <div class="item">
                    <a href="productDesc.php?<?php echo "ID=".$rows->getProductID();?>"><img src="<?php echo $rows->getProductImage()?>" width="213" height="192" /></a><br />
                    <p><a href="productDesc.php?<?php echo "ID=".$rows->getProductID();?>"><?php echo $rows->getProductName();?></a></p><span class="price"><?php echo $rows->getProductPrice();?></span><br />
                    
                </div>
                <?php endforeach; ?>
                <!--<div class="item">
                    <a href="#"><img src="../images/pic1.jpg" width="213" height="192" /></a><br />
                    <p><a href="login.php">Product 01</a></p><span class="price">$125</span><br />
                </div>
                <div class="item center">
                    <a href="#"><img src="../images/pic1.jpg" width="213" height="192" /></a><br />
                    <p><a href="login.php">Product 02</a></p><span class="price">$215</span><br />
                </div>
                <div class="item">
                    <a href="#"><img src="../images/pic1.jpg" width="213" height="192" /></a><br />
                    <p><a href="login.php">Product 03</a></p><span class="price">$85</span><br />
                </div>
                <div class="item">
                    <a href="#"><img src="../images/pic1.jpg" width="213" height="192" /></a><br />
                    <p><a href="login.php">Product 04</a></p><span class="price">$35</span><br />
                </div>
                <div class="item center">
                    <a href="#"><img src="../images/pic1.jpg" width="213" height="192" /></a><br />
                    <p><a href="login.php">Product 05</a></p><span class="price">$27</span><br />
                </div>
                <div class="item">
                    <a href="#"><img src="../images/pic1.jpg" width="213" height="192" /></a><br />
                    <p><a href="login.php">Product 06</a></p><span class="price">$40</span><br />
                </div> -->
            </div>
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>