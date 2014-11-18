<?php
require_once './header.php';
require_once '../Model/Product_DB.php';
$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
session_start();
?>
<div id="content">
    <?php require_once './sidebar.php'; ?>
    <div id="main">
        <div id="inside">
            
        </div>
    </div>
</div>
<?php
require_once './footer.php';
?>

