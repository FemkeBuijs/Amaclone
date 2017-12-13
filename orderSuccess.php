<?php
if(!isset($_REQUEST['id'])){
    header("Location: shop.php");
}
require 'reso/frames/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Success - PHP Shopping Cart Tutorial</title>
    <meta charset="utf-8">
    <style>
    .container{width: 100%;padding: 50px;}
    p{color: #34a853;font-size: 18px;}
    </style>
</head>
</head>
<body>
<?php include 'reso/frames/navbar.php'; ?>
<div class="container">
    <h1>Order Status</h1>
    <p>Your order has submitted successfully. Order ID is #<?php echo $_GET['id']; ?></p>
</div>

<?php include 'reso/frames/footer.php'; ?>
<?php require 'reso/frames/scripts.php'; ?>
</body>
</html>
