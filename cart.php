<?php
// We first require the connection from the base.php file
require 'reso/base.php';
include 'reso/classes/cartClass.php';
$cart = new Cart;
require 'reso/frames/header.php';
?>
<body>
  <?php include 'reso/frames/navbar.php';
  ?>

  <div class="container" style="min-height: 22.5em !important;">
    <div class="row">
      <h3 class="ml-2 mt-2">Shopping Cart</h3>
      <table class="table">
      <thead>
          <tr>
              <th scope="col">Product</th>
              <th scope="col">Price</th>
              <th scope="col">Quantity</th>
          </tr>
      </thead>


      <tbody>
          <?php
          if($cart->total_items() > 0){
              //get cart items from session
              $cartItems = $cart->contents();

              foreach($cartItems as $item){
                if(sizeof($item)>1){
          ?>
          <tr>
              <td scope="row"><?php echo $item["name"]; ?></td>
              <td><?php echo '£'.$item["price"]; ?></td>
              <td>
                <input type="number" class="form-control text-center w-50" value="<?php echo $item["quantity"]; ?>"  style="display: inline;" onchange="updateCartItem(this, '<?php echo $item["rowid"]; ?>')">
                <a href="cartActions.php?action=removeCartItem&id=<?php echo $item["rowid"]; ?>" style="display: inline;" class="btn btn-danger w-50" onclick="return confirm('Are you sure?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
              </td>
          </tr>
        <?php } } }else{ ?>
          <tr><td colspan="5"><p>Your cart is empty.</p></td>
          <?php } ?>
      </tbody>



      <tfoot>
          <tr>
              <td><a href="shop.php" class="btn btn-primary"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a></td>

              <?php if($cart->total_items() > 0){ ?>
              <td class=""><strong>Total <br> <?php echo '£'.$cart->total(); ?></strong></td>
              <td><a href="checkout.php" class="btn btn-success btn-block">Checkout</a></td>
              <?php } ?>
          </tr>
      </tfoot>
      </table>
    </div>
  </div>

<?php include 'reso/frames/footer.php'; ?>
<?php include 'reso/frames/scripts.php'; ?>
</body>
</html>
