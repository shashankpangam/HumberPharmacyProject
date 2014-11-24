<?php
$name=$_GET['name'];
//$email=$_GET['email'];
?>

<?php require_once './header.php'; ?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div id="main">
        <div id="inside" style="padding:30px;">
            <h2><font color = "black">Thank You <strong><u><?php echo strtoupper($name); ?></u></strong> for contacting us, we will soon contact you.</font></h2>
        </div>
    </div>


</div>
<?php require_once './footer.php'; ?>
