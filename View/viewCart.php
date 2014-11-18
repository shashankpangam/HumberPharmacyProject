<?php
require_once './header.php';
require_once '../Model/Product_DB.php';
$current_url = base64_encode($url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
session_start();
?>
<div id="content">
    <?php
    require_once './sidebar.php';
    $total = 0;
    ?>
    <div id="main">
        <div id="inside">
            <?php
            if (isset($_SESSION["products"])) {
                ?>
                <form method="post" action="#">
                    <ul>
                        <?php
                        $cart_items = 0;
                        foreach ($_SESSION["products"] as $cart_itm) {
                            $product_id = $cart_itm["code"];
                            $result = Product_DB::getProductByID($product_id);

                            echo '<li class="cart-itm">';
                            echo '<span class="remove-itm"><a href="../Model/ShoppingCart.php?removep=' . $cart_itm["code"] . '&return_url=' . $current_url . '">&times;</a></span>';
                            echo '<div class="p-price">' . "$" . $result->getProductPrice() . '</div>';
                            echo '<div class="product-info">';
                            echo '<h3>' . $result->getProductName() . ' (Code :' . $result->getProductID() . ')</h3> ';
                            echo '<div class="p-qty">Qty : ' . $cart_itm["qty"] . '</div>';
                            echo '<div>' . $result->getProductDescription() . '</div>';
                            echo '</div>';
                            echo '</li>';
                            $subtotal = ($cart_itm["price"] * $cart_itm["qty"]);
                            $total = ($total + $subtotal);

                            echo '<input type="hidden" name="item_name[' . $cart_items . ']" value="' . $result->getProductName() . '" />';
                            echo '<input type="hidden" name="item_code[' . $cart_items . ']" value="' . $product_id . '" />';
                            echo '<input type="hidden" name="item_desc[' . $cart_items . ']" value="' . $result->getProductDescription() . '" />';
                            echo '<input type="hidden" name="item_qty[' . $cart_items . ']" value="' . $cart_itm["qty"] . '" />';
                            $cart_items ++;
                        }
                        ?>
                    </ul>
                    <?php
                    echo '<span class="check-out-txt">';
		echo '<strong>Total : '.'$'.$total.'</strong>  ';
		echo '</span>';
                    ?>
                </form>
                <?php
            } else {
                echo 'Your Cart is empty';
            }
            ?>
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>

