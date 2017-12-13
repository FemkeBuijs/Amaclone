
<?php
// We first require the connection from the base.php file
require 'reso/base.php';
include 'reso/classes/cartClass.php';
$cart = new Cart;
$location = explode('/', $_SERVER['REQUEST_URI']);
$_SESSION['previous_location'] = $location[count($location)-1];

// We query the database in order to obtain the information about the products
if(isset($_GET['search']) && !empty($_GET['search'])){
  $productquery = 'SELECT * FROM products WHERE title LIKE "%'.$_GET['search'].'%" OR author LIKE "%'.$_GET['search'].'%"';
} elseif(isset($_SESSION['product_filter']) && !empty($_SESSION['product_filter'])) {
  $productquery = $_SESSION['product_filter'];
} else {
  $productquery = 'SELECT * FROM products';
}
//get all the information from the sql database
$results = mysqli_query($con, $productquery);
$results = mysqli_fetch_all($results, MYSQLI_ASSOC);
//obtain the number of elements in our books table
$noResults = sizeof($results);
require 'reso/frames/header.php';
 ?>
<!-- Below starts the html for our document -->
<body>
  <?php include 'reso/frames/navbar.php'; ?>
  <?php include 'reso/frames/shopFrame.php'; ?>


    <?php include 'reso/frames/footer.php'; ?>


<?php require 'reso/frames/scripts.php'; ?>
</body>
 </html>
