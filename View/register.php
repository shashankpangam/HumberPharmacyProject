<?php
// define variables and set to empty values
$error_message = $firstname = $lastname = $dob = $address1 = $address2 = $city = $zipcode = $province = $eemail = $username = $password = "";

require_once '../Model/Customer.php';
require_once '../Model/Customer_DB.php';

    
    

if (isset($_POST['submit'])) {
    
    //open a connection with the database
    $id=null;
    
    //intialize the variables with form data
    $firstname = $_POST['firstname'];
    
    $lastname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $zipcode = $_POST['zipcode'];
    $province = $_POST['province'];
    //$gender = $_POST['gender'];
    $eemail = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if(empty($firstname) || empty($lastname) || empty($dob)){
    $error_message = "*One or more required fields are blank.";
    }
     else if(empty($address1) || empty($city) || empty($zipcode)){
    $error_message = "*One or more required fields are blank.";
    }
     else if(empty($province) || empty($eemail)){
    $error_message = "*One or more required fields are blank.";
    }
     else if(empty($username) || empty($password)){
    $error_message = "*One or more required fields are blank.";
    }
    else
    {
        //$customer=new Customer($)
        //$insert=  Customer_DB::insertCustomer($customer);
    }   
    
}

?>



<?php require_once './header.php'; ?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div class="contactform">  
        <p class="txtcontus" style="width: 600px;"><font color="white"><strong>Registration Form</strong></font></p><br />

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"> 
            <fieldset class="contusfs" style="width: 600px; height: 600px">
                <font color="red"><p style="padding-left: 30px; padding-top: 9px;">* Indicates a required field </p>
                <p style="padding-left: 30px;"><?php echo $error_message; ?></p></font>
                <div class="slide">
                    <table style="width:80%" cellspacing="15">
                        <tr>
                            <td>First Name<font color="red">*</font>:</td>&nbsp;
                            <td><span class="error"><input type="text" name="firstname" value="<?php echo $firstname;?>"/></span></td>		
                        </tr>
                        <tr>
                            <td><label>Last Name<font color="red">*</font>:</td>
                            <td><span class="error"><input type="text" name="lastname" value="<?php echo $lastname;?>"/></span></td>		
                        </tr>
                        <tr>
                            <td>Date Of Birth<font color="red">*</font>:</td>
                                    <td><span class="error"><input type="text" name="dob" value="<?php echo $dob;?>" placeholder="YYYY-MM-DD"/></span></td>		
                        </tr>
                        <tr>
                            <td>Address 1<font color="red">*</font>:</td>
                            <td><span class="error"><input type="text" name="address1" value="<?php echo $address1;?>"/></span></td>		
                        </tr>
                        <tr>
                            <td>Address 2:</td>
                            <td><span class="error"><input type="text" name="address2" value="<?php echo $address2;?>"/></span></td>		
                        </tr>
                        <tr>
                            <td>City<font color="red">*</font>:</td>
                            <td><input type="text" name="city" value="<?php echo $city;?>"/></td>		
                        </tr>
                        <tr>
                            <td>Zip Code<font color="red">*</font>:</td>
                            <td><span class="error"><input type="text" name="zipcode" value="<?php echo $zipcode;?>"/></span></td>		
                        </tr>
                        <tr>
                            <td>Province<font color="red">*</font>:</td>
                            <td><span class="error"><select name="province">
                                        <option value="ON">ON</option>
                                        <option value="BC">BC</option>
                                    </select></span></td>		
                        </tr>
                        <tr>
                            <td>Gender<font color="red">*</font>:</td>
                            <td><input type="radio" name="gender" value="0" checked="true">Male
                                <input type="radio" name="gender" value="1">Female</td>  
                            <td><span class="error"></span></td>		
                        </tr>
                        <tr>
                            <td>Email<font color="red">*</font>:</td>
                            <td><span class="error"><input type="text" name="email" value="<?php echo $eemail;?>"/></span></td>		
                        </tr>
                        <tr>
                            <td>Username<font color="red">*</font>:</td>
                            <td><span class="error"><input type="text" name="username" value="<?php echo $username;?>"/></span></td>		
                        </tr>
                        <tr>
                            <td>Password<font color="red">*</font>:</td>
                            <td><span class="error"><input type="text" name="password" value="<?php echo $password;?>"/></span></td>		
                        </tr>
                    </table>
                    <div class="bonesubmit">
                        <input class="btnsubmit" type="submit" name="submit" value="Submit" >

                        <span class="btwosubmit">
                            <input class="btnsubmit" type="submit" name="clear" value="Clear" style="background-color:#CC3300;">
                        </span>
                    </div>
                </div>
            </fieldset>
        </form>       
    </div> 
</div>
<?php require_once './footer.php'; ?>


<!--//    //LastName
//    if (empty($_POST["lastname"])) {
//        $nameErr2 = "LastName is required";
//    } else {
//        $name2 = test_input($_POST["lastname"]);
//        // check if name only contains letters and whitespace
//        if (!preg_match("/^[a-zA-Z ]*$/", $name2)) {
//            $nameErr2 = "Only letters and white space allowed";
//        }
//    }
//
//    //DOB
//    //Address1
//    if (empty($_POST["address1"])) {
//        $addressErr1 = "Address is required";
//    } else {
//        $address1 = test_input($_POST["address1"]);
//    }
//    //PostalCode
//    $country_code = "CA";
//    $zip_postal = "a1a1a1";
//
//    $ZIPREG = array(
////        "US" => "^\d{5}([\-]?\d{4})?$",
////        "UK" => "^(GIR|[A-Z]\d[A-Z\d]??|[A-Z]{2}\d[A-Z\d]??)[ ]??(\d[A-Z]{2})$",
////        "DE" => "\b((?:0[1-46-9]\d{3})|(?:[1-357-9]\d{4})|(?:[4][0-24-9]\d{3})|(?:[6][013-9]\d{3}))\b",
//        "CA" => "^([ABCEGHJKLMNPRSTVXY]\d[ABCEGHJKLMNPRSTVWXYZ])\ {0,1}(\d[ABCEGHJKLMNPRSTVWXYZ]\d)$",
////        "FR" => "^(F-)?((2[A|B])|[0-9]{2})[0-9]{3}$",
////        "IT" => "^(V-|I-)?[0-9]{5}$",
////        "AU" => "^(0[289][0-9]{2})|([1345689][0-9]{3})|(2[0-8][0-9]{2})|(290[0-9])|(291[0-4])|(7[0-4][0-9]{2})|(7[8-9][0-9]{2})$",
////        "NL" => "^[1-9][0-9]{3}\s?([a-zA-Z]{2})?$",
////        "ES" => "^([1-9]{2}|[0-9][1-9]|[1-9][0-9])[0-9]{3}$",
////        "DK" => "^([D-d][K-k])?( |-)?[1-9]{1}[0-9]{3}$",
////        "SE" => "^(s-|S-){0,1}[0-9]{3}\s?[0-9]{2}$",
////        "BE" => "^[1-9]{1}[0-9]{3}$"
//    );
//
//    if (empty($_POST["postalcode"])) {
//        $addressErr1 = "PostalCode is required";
//    }
//    elseif($ZIPREG[$country_code]) {
//
//        if (!preg_match("/" . $ZIPREG[$country_code] . "/i", $zip_postal)) {
//            echo 'postal code is not valid';
//        } else {
//            echo 'postal code is valid';
//        }
//    } else {
//        echo 'validation not available';
//    }
//    //gender
//    if (empty($_POST["gender"])) {
//        $genderErr = "Gender is required";
//    } else {
//        $gender = test_input($_POST["gender"]);
//    }
//
//    //email
//    if (empty($_POST["email"])) {
//        $emailErr = "Email is required";
//    } else {
//        $email = test_input($_POST["email"]);
//        // check if e-mail address is well-formed
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            $emailErr = "Invalid email format";
//        }
//    }
//
//    if (empty($_POST["comment"])) {
//        $comment = "";
//    } else {
//        $comment = test_input($_POST["comment"]);
//    }
//
//    
//}-->







<!-- First Name<span class="error">*: <input type="text" name="firstname">
<?php echo $nameErr1; ?></span>
                <br/><br/>               
                <label>Last Name:</label>&nbsp;<input type="text" name="lastname"/><br/><br/>
                <label>Date Of Birth:</label>&nbsp;<input type="text" name="dob"/><br/><br/>               
                <label>Address1:</label>&nbsp;<input type="text" name="address1"/><br/><br/>
                <label>Address2:</label>&nbsp;<input type="text" name="address2"/><br/><br/>               
                <label>City:</label>&nbsp;<input type="text" name="city"/><br/><br/>
                <label>Postal Code:</label>&nbsp;<input type="text" name="postalcode"/><br/><br/>               
                <label>Province:</label>&nbsp;<input type="text" name="province"/><br/><br/>
                <label>Gender:</label>&nbsp;<input type="text" name="gender"/><br/><br/>               
                <label>Email:</label>&nbsp;<input type="text" name="email"/><br/><br/>
                <label>Password:</label>&nbsp;<input type="text" name="password"/><br/><br/>
                <label>Confirm Password:</label>&nbsp;<input type="text" name="confirmpassword"/><br/><br/>
                <input type="submit" name="register" value="Register">&nbsp;
                <input type="submit" name="cancel" value="Cancel">-->



<!--                     <div class="rgslft">   
                    First Name<span class="error">*: <input type="text" name="firstname">
<?php ?></span><br>                             
                    Last Name<span class="error">*: <input type="text" name="lastname">
<?php ?></span><br>
                    DOB<span class="error">*: <input type="text" name="dob">
<?php ?></span><br>                            
                    Address1<span class="error">*: <input type="text" name="address1">
<?php ?></span><br>
                    Address2<span class="error">*: <input type="text" name="address2">
<?php ?></span><br>                             
                    City<span class="error">*: <input type="text" name="city">
<?php ?></span><br>
                </div>           
                <div class="rgdrgt">
                    Postal Code<span class="error">*: <input type="text" name="postalcode">
<?php ?></span><br>                             
                    Province<span class="error">*:
                        <select name="province">
                        <option value="ON">ON</option>
                        <option value="BC">BC</option>
                        </select><?php ?></span><br>
                    Gender<span class="error">*</span>:
                    <input type="radio" name="gender" value="male">Male
                    <input type="radio" name="gender" value="female">Female           
                    <span class="error"><?php ?></span><br>
                    Email<span class="error">*: <input type="text" name="email">
<?php ?></span><br>                             
                    Username<span class="error">*: <input type="text" name="username">
<?php ?></span><br>
                     Password<span class="error">*: <input type="password" name="password">
<?php ?></span><br>
                    <input class="btnsubmit" type="submit" name="submit" value="Submit">
                </div>-->