<?php
// define variables and set to empty values
$nameErr1 = "";
$name1 = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //FirstName
    if (empty($_POST["firstname"])) {
        $nameErr1 = "FirstName is required";
    } else {
        $name1 = test_input($_POST["firstname"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name1)) {
            $nameErr1 = "Only letters and white space allowed";
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<?php require_once './header.php'; ?>
<div id="content">
<?php require_once './sidebar.php'; ?>
    <form id="contactme" action="#" method="post" >
        <div id="fields">
            <div class="regitrationmotion">
                <div class="tag"><p><strong><?php echo "Registration Form" ?></strong></p></div><br/>

<!--                <table style="width:60%" cellspacing="15">
    <tr>
        <td>First Name:</td>
        <td><span class="error">*<input type="text" name="firstname"/><?php echo $nameErr1; ?></span></td>		
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
        <td>Zip Code:</td>
        <td><input type="text" name="zipcode"/></td>		
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
        <td>Confirm Password:</td>
        <td><input type="text" name="confirmpassword"/></td>		
    </tr>
    <tr>
        <td><a href="#"><button name="btnregister">Register</button></a></td>
        <td><a href="index.php"><button name="btncancel">Cancel</button></a></td>		
    </tr>
</table>-->

                First Name<span class="error">*: <input type="text" name="firstname">
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
                <input type="submit" name="cancel" value="Cancel">
            </div>
        </div>
    </form>
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