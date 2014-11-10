<!DOCTYPE>
<html>
    <head>
        <title>Login/Register</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>        

        <link rel="stylesheet" type="text/css" href="../styles/style.css" />
        
        <script src="../Scripts/cufon-yui.js" type="text/javascript"></script>
        <script src="../Scripts/ChunkFive_400.font.js" type="text/javascript"></script>
        <script type="text/javascript">
            Cufon.replace('h1', {textShadow: '1px 1px #fff'});
            Cufon.replace('h2', {textShadow: '1px 1px #fff'});
            Cufon.replace('h3', {textShadow: '1px 1px #000'});
            Cufon.replace('.back');
        </script>
    </head>
    <body>
        <div class="wrapper">        
            <div class="content">
                <div id="form_wrapper" class="form_wrapper">
                    <form class="register">
                        <h3>Register</h3>
                        <div class="column">
                            <div>
                                <label>First Name:</label>
                                <input type="text" />
                                <span class="error">This is an error</span>
                            </div>
                            <div>
                                <label>Last Name:</label>
                                <input type="text" />
                                <span class="error">This is an error</span>
                            </div>
                            <div>
                                <label>Website:</label>
                                <input type="text" />
                                <span class="error">This is an error</span>
                            </div>
                        </div>
                        <div class="column">
                            <div>
                                <label>Username:</label>
                                <input type="text"/>
                                <span class="error">This is an error</span>
                            </div>
                            <div>
                                <label>Email:</label>
                                <input type="text" />
                                <span class="error">This is an error</span>
                            </div>
                            <div>
                                <label>Password:</label>
                                <input type="password" />
                                <span class="error">This is an error</span>
                            </div>
                        </div>
                        <div class="bottom">
                            <input type="submit" value="Register" />
                            <a href="indexLogin.php" rel="login" class="linkform">You have an account already? Log in here</a>
                            <div class="clear"></div>
                        </div>
                    </form>
                    <form class="login active">
                        <h3>Login</h3>
                        <div>
                            <label>Username:</label>
                            <input type="text" />
                            <span class="error">This is an error</span>
                        </div>
                        <div>
                            <label>Password: <a href="indexForgotPassword.php" rel="forgot_password" class="forgot linkform">Forgot your password?</a></label>
                            <input type="password" />
                            <span class="error">This is an error</span>
                        </div>
                        <div class="bottom">
                            <input type="submit" value="Login" />
                            <a href="indexRegister.php" rel="register" class="linkform">You don't have an account yet? Register here</a>
                            <div class="clear"></div>
                        </div>
                    </form>
                    <form class="forgot_password">
                        <h3>Forgot Password</h3>
                        <div>
                            <label>Email:</label>
                            <input type="text" />
                            <span class="error">This is an error</span>
                        </div>
                        <div class="bottom">
                            <input type="submit" value="Send reminder" />
                            <a href="indexLogin.php" rel="login" class="linkform">Suddenly remembered? Log in here</a>
                            <a href="indexRegister.php" rel="register" class="linkform">You don't have an account? Register here</a>
                            <div class="clear"></div>
                        </div>
                    </form>
                </div>
                <div class="clear"></div>
            </div>
            
        </div>
<div id="footer">
    <ul>
        <li><a href="index.php">Home page</a> |</li>
        <li><a href="productSale.php">Sale Products</a> |</li>
        <li><a href="#">Reviews</a> |</li>
        <li><a href="contactus.php">Contact Us</a></li>
    </ul>
    <p>Copyright &copy; 2014.</p>																																																																				
</div>

        <!-- The JavaScript -->
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
        <script type="text/javascript">
            $(function() {
                //the form wrapper (includes all forms)
                var $form_wrapper = $('#form_wrapper'),
                        //the current form is the one with class active
                        $currentForm = $form_wrapper.children('form.active'),
                        //the change form links
                        $linkform = $form_wrapper.find('.linkform');

                //get width and height of each form and store them for later						
                $form_wrapper.children('form').each(function(i) {
                    var $theForm = $(this);
                    //solve the inline display none problem when using fadeIn fadeOut
                    if (!$theForm.hasClass('active'))
                        $theForm.hide();
                    $theForm.data({
                        width: $theForm.width(),
                        height: $theForm.height()
                    });
                });

                //set width and height of wrapper (same of current form)
                setWrapperWidth();

                /*
                 clicking a link (change form event) in the form
                 makes the current form hide.
                 The wrapper animates its width and height to the 
                 width and height of the new current form.
                 After the animation, the new form is shown
                 */
                $linkform.bind('click', function(e) {
                    var $link = $(this);
                    var target = $link.attr('rel');
                    $currentForm.fadeOut(400, function() {
                        //remove class active from current form
                        $currentForm.removeClass('active');
                        //new current form
                        $currentForm = $form_wrapper.children('form.' + target);
                        //animate the wrapper
                        $form_wrapper.stop()
                                .animate({
                                    width: $currentForm.data('width') + 'px',
                                    height: $currentForm.data('height') + 'px'
                                }, 500, function() {
                                    //new form gets class active
                                    $currentForm.addClass('active');
                                    //show the new form
                                    $currentForm.fadeIn(400);
                                });
                    });
                    e.preventDefault();
                });

                function setWrapperWidth() {
                    $form_wrapper.css({
                        width: $currentForm.data('width') + 'px',
                        height: $currentForm.data('height') + 'px'
                    });
                }

                /*
                 for the demo we disabled the submit buttons
                 if you submit the form, you need to check the 
                 which form was submited, and give the class active 
                 to the form you want to show
                 */
                $form_wrapper.find('input[type="submit"]')
                        .click(function(e) {
                            e.preventDefault();
                        });
            });
        </script>
    </body>
</html>