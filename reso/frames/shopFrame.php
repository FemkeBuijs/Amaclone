<div class="container" style="min-height: 321px;">
  <br>
<!-- Starting a loop through all of the rows of the products table to create a templated card for each row -->
<?php if($noResults > 0){
for($i=0; $i<$noResults; $i++){ ?>
<div class="row">
  <!-- We create a card for each book which has title and author name at the top and then an image and price -->
  <div class="col-lg-2">
    <div class="card border-0">
      <img class="card-img-top  border" src="<?php echo $results[$i]['img'] ?>" alt="Card image cap">
    </div>
  </div>

  <div class="col-lg-7">
    <div class="card border-0">
      <div class="card-heading "><h5><?php echo $results[$i]['title']?></h5></div>
      <div class="card-heading"><small class="text-muted"><?php echo $results[$i]['author']?></small></div>
      <div class="card-body p-0 mt-3"><p style="font-size:0.90em"><?php echo $results[$i]['description']; ?></p></div>
    </div>
  </div>

  <div class="col-lg-3 d-flex align-items-end">
    <div class="card border-0 w-100">
      <div class="card-footer border-0">Price £<?php echo $results[$i]['price']?></div>
      <!-- This button will add the book to the cart -->
      <!-- The following link should make the action addToCart with the book ID on the cartActions page -->
      <a role="button" class="btn btn-primary color-white" id="addToCart" href="cartActions.php?action=addToCart&id=<?php echo $results[$i]['product_id']; ?>">Add to Cart</a>
    </div>
  </div>
</div>
<hr>
<?php }
} else {
  ?>
  <div class='row'>
    <div class='col-lg-12'>
      <p>Search not found</p>
    </div>
  </div>
  <?php
} ?>
</div>
