<?php 
    require_once '../Model/Databases.php';
?>


<div id="content">
    <div id="sidebar">
        <div id="navigation">
            <ul>
                <li><a href="#">Medicines</a></li>
                <li><a href="#">Vitamins</a></li>
                <li><a href="#">Diet and Fitness</a></li>
                <li><a href="#">Personal</a></li>
                <li><a href="#">Featured Products</a></li>
                <li><a href="#">Checkout</a></li>
            </ul>
            <div id="cart">
                <strong>Shopping cart:</strong> <br /> 0 items
            </div>
        </div>
        <div>
            <img src="../images/title2.gif" alt="" width="233" height="41" /><br />																																																																																																																																																															
            <div class="review">
                <a href="#"><img src="../images/pic1.jpg" alt="" width="181" height="161" /></a>
                <br />
                <a href="#">Product 07</a><br />
                <p>Dolor sit amet, consetetur sadipscing elitr, seddiam nonumy eirmod tempor. invidunt ut labore et dolore magna </p>
                <img src="../images/stars.jpg" alt="" width="118" height="20" class="stars" />

            </div>
        </div>
    </div>
    <div id="main">
        <div class="container">
            <div id="slides">
                <img src="../images/drug2.jpg" alt="" width="650" height="374" border="0">
                <img src="../images/drug3.jpg" alt="" width="679" height="374" border="0">
             <!--   <img src="images/photo.jpg"alt="" width="679" height="374" border="0">
                
                <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
                <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>-->
            </div>
        </div>
        <br />
        <div id="inside">
            <!-- OUR SHOP ICON-->
            <img src="../images/title3.gif" alt="" width="159" height="15" /><br />
            <div class="info">
                <!-- FEMALE PICTURE-->
                <img src="../images/pic2.jpg" alt="" width="159" height="132" />
                <p>Dolor sit amet, consetetur sadipscing elitr, seddiam nonumy eirmod tempor. invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadip- scing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur. </p>
                <p>Dolor sit amet, consetetur sadipscing elitr, seddiam nonumy eirmod tempor. invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadip- scing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. Lorem ipsum dolor sit amet, consetetur. </p>
                <!-- MORE INFO ICON-->
                <a href="#" class="more"><img src="../images/more.gif" alt="" width="106" height="28" /></a> 					
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {

        $("#slides").slidesjs({
            play: {
                active: true,
                // [boolean] Generate the play and stop buttons.
                // You cannot use your own buttons. Sorry.
                effect: "slide",
                // [string] Can be either "slide" or "fade".
                interval: 5000,
                // [number] Time spent on each slide in milliseconds.
                auto: true,
                // [boolean] Start playing the slideshow on load.
                swap: false,
                // [boolean] show/hide stop and play buttons
                pauseOnHover: false,
                // [boolean] pause a playing slideshow on hover
                restartDelay: 2500
                        // [number] restart delay on inactive slideshow
            },
            navigation: {
                active: false,
                // [boolean] Generates next and previous buttons.
                // You can set to false and use your own buttons.
                // User defined buttons must have the following:
                // previous button: class="slidesjs-previous slidesjs-navigation"
                // next button: class="slidesjs-next slidesjs-navigation"
                effect: "slide"
                        // [string] Can be either "slide" or "fade".
            }
        });
        $(".slidesjs-pagination").hide();
    });
</script>