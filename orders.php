<?php

  require 'reso/base.php';

  if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
    $userID = $_SESSION['user']['user_id'];

    require 'reso/frames/header.php';
    ?>
    <body>
    <?php

    require 'reso/frames/navbar.php';
    ?>
    <div class="container">
    <?php

    //get orders id's
    $orderIdQuery = "SELECT * FROM orders INNER JOIN users ON orders.user_id = users.user_id WHERE orders.user_id = ".$userID." ORDER BY orders.order_date DESC";
    $orders = mysqli_query($con, $orderIdQuery);

    //if there are any results in the above sql query, get the items of the orders
    if (mysqli_num_rows($orders) > 0) {
      $row = 0;
      // Loop through all results from the $orders query
      while ($order = mysqli_fetch_array($orders, MYSQLI_ASSOC)) {
        ?>
        <br>
        <div class="row">
          <div class="col-lg-7">
            <div class="card border-0">
        <?php
        if($row == 0){
          ?>
              <div class="card-heading "><h5>Hello, <?php echo $order['firstname']?>. Please view your previous orders below.</h5></div>
              <hr>
          <?php
        }
        $row++;
        ?>
              <div class="card-heading"><small class="text-muted">Order ID: <?php echo $order['order_id']?></small></div>
              <div class="card-heading"><small class="text-muted">Order Date: <?php echo $order['order_date']?></small></div>
              <div class="card-heading"><small class="text-muted">Total price: £<?php echo $order['total_price']?></small></div>
            </div>
          </div>
        </div>
        <?php
        // Fetch all order items
        $orderItemsQuery = "SELECT * FROM order_items INNER JOIN products ON order_items.product_id = products.product_id WHERE order_items.order_id = ".$order['order_id'];
        $orderItems = mysqli_query($con, $orderItemsQuery);
        // Check order items gives a result
        if (mysqli_num_rows($orderItems) > 0) {
          while ($orderItem = mysqli_fetch_array($orderItems, MYSQLI_ASSOC)) {
            ?>
        <div class="row">
          <div class="col-lg-2">
            <div class="card border-0">
              <img class="card-img-top  border" src="<?php echo $orderItem['img'] ?>" alt="Card image cap">
            </div>
          </div>

          <div class="col-lg-7">
            <div class="card border-0">
              <div class="card-heading "><h5><?php echo $orderItem['title']?></h5></div>
              <div class="card-heading"><small class="text-muted"><?php echo $orderItem['author']?></small></div>
            </div>
          </div>

          <div class="col-lg-3 d-flex align-items-end">
            <div class="card border-0 w-100">
              <div class="card-footer border-0">Price £<?php echo $orderItem['price']?></div>
              <div class="card-footer border-0">Quantity <?php echo $orderItem['quantity']?></div>
            </div>
          </div>
        </div>
            <?php
          }
        }
        ?>
        <hr>
        <?php
      }
    } else {
      echo "<div class='container'>
              <div class='row'>
                <div class='col-lg-4 mx-auto mt-3' style='min-height: 22em;'>
                <p>You have no previous orders yet.</p>
                </div>
              </div>
            </div>";
    }
    ?>
  </div>
  <?php require 'reso/frames/footer.php'; ?>
  <?php require 'reso/frames/scripts.php'; ?>
</body>
    <?php
  } else {
    $_SESSION['previous_location'] = 'orders.php';
    header("Location: login.php");
  }
    ?>
