<?php
// define variables and set to empty values
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "*Name is required";
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "*Only letters and white space allowed";
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "*Email is required";
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "*Invalid email format";
        }
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "*Gender is required";
    } else {
        $gender = test_input($_POST["gender"]);
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<?php

?>

<?php require_once './header.php'; ?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div class="contactform">

        <p class="txtcontus"><font color="white"><strong>Contact Us</strong></font></p><br />
        <form method="post" action="#"> 
            <fieldset class="contusfs" style="width:405px;height: 270px;">
                <div style="padding:15px 0px 10px 20px">
                    Name<span class="error">*: <input type="text" name="name">
                        <?php echo $nameErr; ?></span>
                    <br><br>           
                    E-mail<span class="error">*: <input type="text" name="email">
                        <?php echo $emailErr; ?></span>
                    <br><br>
                    Gender<span class="error">*</span>:
                    <input type="radio" name="gender" value="male">Male
                    <input type="radio" name="gender" value="female">Female           
                    <span class="error"><?php echo $genderErr; ?></span>
                    <br><br>
                    Comment(s):<br/> 
                    <textarea name="comment" rows="5" cols="40"></textarea>
                    <br><br>
                    <input class="btnsubmit" type="submit" name="submit" value="Submit">
                    <span class="btwosubmit" style="padding-left: 30px">
                        <a href ="index.php>"><input class="btnsubmit" type="submit" name="clear" value="Cancel" style="background-color:#CC3300;"></a>
                    </span>
                </div>
            </fieldset>
        </form>
    </div> 
</div>
<?php require_once './footer.php'; ?>