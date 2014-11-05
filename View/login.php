<?php
require_once './header.php';
?>
<div id="content">
    <?php require_once './sidebar.php'; ?>  
    <div class="loginmotion">           
        <div class="tag"><p><strong><?php echo "Please Login below for fast checkout" ?></strong></p></div><br/>
        <label>Username</label>&nbsp;<input type="text" /><br/><br/>               
        <label>Password</label>&nbsp; <input type="password" /><br/><br/>
        <button>Login</button>&nbsp;
        <button>Cancel</button><br /><br/>
        <div class="login_motion">
            <p><strong>New Customers</strong></p>
            <p>If you have never shopped at HumberPharmacy.me, you will need to <a href="register.php">create a new account.</a></p>
            <p>If you have any questions, you can e-mail us or call us at 1-800-drugstore (1-800-378-4786).</p>  
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>



