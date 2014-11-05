<?php
require_once './header.php';
?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <form id="contactme" action="#" method="post" >
        <div id="fields">
            <div class="regitrationmotion">
                <div class="tag"><p><strong><?php echo "Registration Form" ?></strong></p></div><br/>
                <table style="width:60%" cellspacing="15">
                    <tr>
                        <td>First Name:</td>
                        <td><input type="text" name="firstname"/></td>		
                    </tr>
                    <tr>
                        <td><label>Last Name:</label></td>
                        <td><input type="text" name="lastname"/></td>		
                    </tr>
                    <tr>
                        <td>Date Of Birth:</td>
                        <td><input type="text" name="dob"/></td>		
                    </tr>
                    <tr>
                        <td>Address 1:</td>
                        <td><input type="text" name="address1"/></td>		
                    </tr>
                    <tr>
                        <td>Address 2:</td>
                        <td><input type="text" name="address2"/></td>		
                    </tr>
                    <tr>
                        <td>City:</td>
                        <td><input type="text" name="city"/></td>		
                    </tr>
                    <tr>
                        <td>Province:</td>
                        <td><input type="text" name="province"/></td>		
                    </tr>
                    <tr>
                        <td>Gender:</td>
                        <td><input type="text" name="gender"/></td>		
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><input type="text" name="email"/></td>		
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="text" name="password"/></td>		
                    </tr>
                    <tr>
                        <td>Zip Code:</td>
                        <td><input type="text" name="zipcode"/></td>		
                    </tr>
                    <tr>
                        <td><a href="#"><button name="btnregister">Register</button></a></td>
                        <td><a href="index.php"><button name="btncancel">Cancel</button></a></td>		
                    </tr>
                </table>


<!--            <label>First Name:</label>&nbsp;<input type="text" /><br/><br/>               
                <label>Last Name:</label>&nbsp;<input type="text" /><br/><br/>
                <label>Date Of Birth:</label>&nbsp;<input type="text" /><br/><br/>               
                <label>Address1:</label>&nbsp;<input type="text" /><br/><br/>
                <label>Address2:</label>&nbsp;<input type="text" /><br/><br/>               
                <label>City:</label>&nbsp;<input type="text" /><br/><br/>
                <label>Postal Code:</label>&nbsp;<input type="text" /><br/><br/>               
                <label>Province:</label>&nbsp;<input type="text" /><br/><br/>
                <label>Gender:</label>&nbsp;<input type="text" /><br/><br/>               
                <label>Email:</label>&nbsp;<input type="text" /><br/><br/>
                <label>Password</label>&nbsp;<input type="text" /><br/><br/>
                <button>Register</button>&nbsp;
                <button>Cancel</button><br /><br/>-->
            </div>
        </div>
    </form>
</div>
<?php
require_once './footer.php';
?>