<?php
require_once 'Mail.php';
$nameErr = $emailErr = $genderErr = $websiteErr = "";
$name = $email = $gender = $comment = $website = "";
if (isset($_POST["submit"])) {
    $flag = true;
    if (empty($_POST["name"])) {
        $nameErr = "*Name is required";
        $flag = false;
    } else {
        $name = test_input($_POST["name"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "*Only letters and white space allowed";
            $flag = false;
        }
    }

    if (empty($_POST["email"])) {
        $emailErr = "*Email is required";
        $flag = false;
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "*Invalid email format";
            $flag = false;
        }
    }

    if (empty($_POST["comment"])) {
        $comment = "";
    } else {
        $comment = test_input($_POST["comment"]);
    }

    if (empty($_POST["gender"])) {
        $genderErr = "*Gender is required";
        $flag = false;
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if ($flag==true) {
        $to = 'vortepharmacy@gmail.com'; //vorte pharmay email
        $from = $_POST['email']; // user email 
        $subject = $_POST['name']; // user name
        $body = $_POST['comment']; //user comments
        $is_body_html = true;

        try {
            send_email($to, $from, $subject, $body, $is_body_html);
        } catch (Exception $ex) {
            $error = $ex->getMessage();
            #echo $error;
        }
        header('location: thankyou.php?name=' . $name);
        $_POST=null;
    }
}

function send_email($to, $from, $subject, $body, $is_body_html = false) {

    $smtp = array();
    // **** You must change the following to match your
    // **** SMTP server and account information.
    $smtp['host'] = 'ssl://smtp.gmail.com';
    $smtp['port'] = 465;
    $smtp['auth'] = true;
    $smtp['username'] = 'vortepharmacy@gmail.com';
    $smtp['password'] = 'hello919hello';

    $mailer = Mail::factory('smtp', $smtp);
    if (PEAR::isError($mailer)) {
        throw new Exception('could not create mailer');
    }

    // Add the email address to the list of all recipients
    $recipients = array();
    $recipients[] = $to;

    // Set the headers
    $headers = array();
    $headers['From'] = $from;
    $headers['To'] = $to;
    $headers['Subject'] = $subject;
    if ($is_body_html) {
        $headers['Content-type'] = 'text/html';
    }

    // Send the email
    $result = $mailer->send($recipients, $headers, $body);

    // Check the result and throw an error if one exists
    if (PEAR::isError($result)) {
        throw new Exception('error sending email: ' . htmlspecialchars($result->getMessage()));
    }
    return $result;
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
