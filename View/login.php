<?php require_once './header.php'; ?>
<?php
$error_message = $username = $password = "";
require_once '../Model/Customer_DB.php';
 $error_message = '*Both username and password is required';
 
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($username != '' && $password != '') {
        $customerid = Customer_DB::loginAction($username, $password);

        if ($customerid == null) {
            $error_message = '*The username or password you entered is incorrect';
        } else {
            $_SESSION["customer"] = $customerid;           
            header('location:index.php');
        }
    } else {

    }
} else {
 
}
?>


<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div class="contactform">
        <!--<input type="hidden" name="customer" value="<?php echo $customer; ?>" />-->
        <p class="txtcontus" style="width: 360px"><font color="white"><strong>Customer Login</strong></font></p><br />
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 

            <fieldset class="contusfs" style="height: 220px">
                <font color="red"><p style="padding-left: 20px;padding-top: 9px;"><?php echo $error_message; ?></p></font>
                <div class="slide">
                    <table style="width:80%" cellspacing="15">
                        <tr>
                            <td>Username<font color="red">*</font>:</td>&nbsp;
                            <td><span class="error"><input type="text" name="username" value="<?php echo $username; ?>"/></span></td>		
                        </tr>
                        <tr>
                            <td><label>Password<font color="red">*</font>:</td>
                            <td><span class="error"><input type="password" name="password" /></span></td>		
                        </tr>
                    </table>

                    <div class="bonesubmit">
                        <input class="btnsubmit" type="submit" name="submit" value="Login" >

                        <span class="btwosubmit" style="padding-left: 30px">
                            <a href ="index.php>"><input class="btnsubmit" type="submit" name="clear" value="Cancel" style="background-color:#CC3300;"></a>
                        </span>
                    </div><br> 
                    <a href="index.php">Forgot password click here</a>
                </div>
            </fieldset>
        </form>

    </div> 
</div>
<?php require_once './footer.php'; ?>
   