
<?php
// We first require the connection from the base.php file
require 'reso/base.php';
include 'reso/classes/cartClass.php';
$cart = new Cart;
// We query the database in order to obtain the information about the products
$productqueryBooks = 'SELECT * FROM products WHERE genre_id = 1 LIMIT 12';
$productqueryMags = 'SELECT * FROM products WHERE genre_id = 2 LIMIT 12';
$productqueryComics = 'SELECT * FROM products WHERE genre_id = 3 LIMIT 12';
//get all the information from the sql database
$resultsBooks = mysqli_query($con, $productqueryBooks);
$resultsBooks = mysqli_fetch_all($resultsBooks, MYSQLI_ASSOC);

$resultsMags = mysqli_query($con, $productqueryMags);
$resultsMags = mysqli_fetch_all($resultsMags, MYSQLI_ASSOC);

$resultsComics = mysqli_query($con, $productqueryComics);
$resultsComics = mysqli_fetch_all($resultsComics, MYSQLI_ASSOC);
//obtain the number of elements in our books table
$noResults = 12;
$noResultsBooks = min($noResults,sizeof($resultsBooks));
$noResultsMags = min($noResults,sizeof($resultsMags));
$noResultsComics = min($noResults,sizeof($resultsComics));
require 'reso/frames/header.php';
 ?>
<!-- Below starts the html for our document -->
<body>
  <?php include 'reso/frames/navbar.php';
$_SESSION['previous_location']='frontShop.php';
  ?>

<!-- Carousel -->
  <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="reso/static/img/car1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="reso/static/img/car2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="reso/static/img/car3.jpg" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

<!-- Free delivery bar -->
  <div class="container-fluid bg-dark">
      <p class="text-center text-colour font-weight-bold text-white">FREE Delivery on millions of eligible items</p>
  </div>

<!-- Products Listing-->
  <div class="container">
    <div class="container-fluid">
        <h5 class="text-left font-weight-bold">Books Best Sellers</h5>
    </div>
    <div class="overflow pl-3">


    <div class="row" style="width: 1820px;">

    <!-- Starting a loop through all of the rows of the products table to create a templated card for each row -->
      <?php for($i=0; $i<$noResultsBooks; $i++){
        // We have a row class for every 6 cards, so for every three we need to create a new div with class row.

          ?>
        <!-- We create a card for each book which has title and author name at the top and then an image and price -->
        <div class="productCard" style="width: 150px; height: auto;">
          <div class="card card-primary border-0 text-center">
            <div class="card-body px-0 mx-1 pb-0" style="height: 18em;">
              <img src="<?php echo $resultsBooks[$i]['img'] ?>" class="img-responsive w-100 h-75" alt="Image">
              <button type="button" class="btn btn-primary w-100" data-toggle="modal"  data-target="<?php echo '#descriptionModal_'.$resultsBooks[$i]['product_id'] ?>" style="display:block;">
                Description
              </button>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <?php for($i=0; $i<$noResultsBooks; $i++){ ?>

        <!-- Modal -->
        <div class="modal fade"  id="<?php echo 'descriptionModal_'.$resultsBooks[$i]['product_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h5 class="modal-title text-center w-100" id="exampleModalLabel"><?php echo $resultsBooks[$i]['title']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                <img src="<?php echo $resultsBooks[$i]['img'] ?>" class="img-responsive" style="width:40%" alt="Image">
              </div>
              <div class="modal-body text-justify">
                <?php echo $resultsBooks[$i]['description']; ?>
              </div>
              <div class="modal-body text-center">
                <b>£<?php echo $resultsBooks[$i]['price']; ?></b>
              </div>
              <div class="modal-footer">
                <a role="button" class="btn btn-primary" id="addToCart" href="cartActions.php?action=addToCart&id=<?php echo $resultsBooks[$i]['product_id']; ?>">Add to Cart</a>
              </div>
            </div>
          </div>
        </div>


<?php } ?>
</div>









<!-- Products Listing Mags-->
  <div class="container">
    <div class="container-fluid">
        <h5 class="text-left font-weight-bold">Magazines Best Sellers</h5>
    </div>
    <div class="overflow pl-3">


    <div class="row" style="width: 1820px;">

    <!-- Starting a loop through all of the rows of the products table to create a templated card for each row -->
      <?php for($i=0; $i<$noResultsMags; $i++){
        // We have a row class for every 6 cards, so for every three we need to create a new div with class row.

          ?>
        <!-- We create a card for each book which has title and author name at the top and then an image and price -->
        <div class="productCard" style="width: 150px; height: auto;">
          <div class="card card-primary border-0 text-center">
            <div class="card-body px-0 mx-1 pb-0" style="height: 18em;">
              <img src="<?php echo $resultsMags[$i]['img'] ?>" class="img-responsive w-100 h-75" alt="Image">
              <button role="button" class="btn btn-primary w-100" data-toggle="modal"  data-target="<?php echo '#descriptionModal_'.$resultsMags[$i]['product_id'] ?>" style="display:block;">
                Description
              </button>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <?php for($i=0; $i<$noResultsMags; $i++){ ?>

        <!-- Modal -->
        <div class="modal fade"  id="<?php echo 'descriptionModal_'.$resultsMags[$i]['product_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h5 class="modal-title text-center w-100" id="exampleModalLabel"><?php echo $resultsMags[$i]['title']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                <img src="<?php echo $resultsMags[$i]['img'] ?>" class="img-responsive" style="width:40%" alt="Image">
              </div>
              <div class="modal-body text-justify">
                <?php echo $resultsMags[$i]['description']; ?>
              </div>
              <div class="modal-body text-center">
                <b>£<?php echo $resultsMags[$i]['price']; ?></b>
              </div>
              <div class="modal-footer">
                <a role="button" class="btn btn-primary" id="addToCart" href="cartActions.php?action=addToCart&id=<?php echo $resultsMags[$i]['product_id']; ?>">Add to Cart</a>
              </div>
            </div>
          </div>
        </div>


<?php } ?>
</div>









<!-- Products Listing Comics-->
  <div class="container">
    <div class="container-fluid">
        <h5 class="text-left font-weight-bold">Comics Best Sellers</h5>
    </div>
    <div class="overflow pl-3">


    <div class="row" style="width: 1820px;">

    <!-- Starting a loop through all of the rows of the products table to create a templated card for each row -->
      <?php for($i=0; $i<$noResultsComics; $i++){
        // We have a row class for every 6 cards, so for every three we need to create a new div with class row.

          ?>
        <!-- We create a card for each book which has title and author name at the top and then an image and price -->
        <div class="productCard" style="width: 150px; height: auto;">
          <div class="card card-primary border-0 text-center">
            <div class="card-body px-0 mx-1 pb-0" style="height: 18em;">
              <img src="<?php echo $resultsComics[$i]['img'] ?>" class="img-responsive w-100 h-75" alt="Image">
              <button type="button" class="btn btn-primary w-100" data-toggle="modal"  data-target="<?php echo '#descriptionModal_'.$resultsComics[$i]['product_id'] ?>" style="display:block;">
                Description
              </button>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>

  <?php for($i=0; $i<$noResultsComics; $i++){ ?>

        <!-- Modal -->
        <div class="modal fade"  id="<?php echo 'descriptionModal_'.$resultsComics[$i]['product_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header text-center">
                <h5 class="modal-title text-center w-100" id="exampleModalLabel"><?php echo $resultsComics[$i]['title']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body text-center">
                <img src="<?php echo $resultsComics[$i]['img'] ?>" class="img-responsive" style="width:40%" alt="Image">
              </div>
              <div class="modal-body text-justify">
                <?php echo $resultsComics[$i]['description']; ?>
              </div>
              <div class="modal-body text-center">
                <b>£<?php echo $resultsComics[$i]['price']; ?></b>
              </div>
              <div class="modal-footer">
                <a type="button" class="btn btn-primary" id="addToCart" href="cartActions.php?action=addToCart&id=<?php echo $resultsComics[$i]['product_id']; ?>">Add to Cart</a>
              </div>
            </div>
          </div>
        </div>


<?php } ?>
</div>


    <?php include 'reso/frames/footer.php'; ?>

<?php require 'reso/frames/scripts.php'; ?>
</body>
 </html>
