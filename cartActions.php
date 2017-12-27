<?php
include 'reso/classes/cartClass.php';
include 'reso/base.php';

$cart = new Cart();

//if a request called action is received (post or get) and if it's not empty...
if(isset($_REQUEST['action']) && !empty($_REQUEST['action'])){
  //if the request action is add to cart, and the request id is not empty
  if($_REQUEST['action'] == 'addToCart' && !empty($_REQUEST['id'])){
    $productID = mysqli_real_escape_string($con, $_REQUEST['id']);
    //get product details
    $query = mysqli_query($con, "SELECT * FROM products WHERE product_id = ".$productID);
    //change the mysqli object to an associative array (= hashmat)
    $row = mysqli_fetch_assoc($query);
    $itemData = array(
      'id' => $row['product_id'],
      'name' => $row['title'],
      'price' => $row['price'],
      'quantity' => 1
    );
    //send the array to the insert function in the Cart Class
    $insertItem = $cart->insert($itemData);
    //if insertItem returns TRUE, set the location to ..
    if($insertItem){
      header("Location: ".$_SESSION['previous_location']);
    }
  } elseif($_REQUEST['action'] == 'updateCartItem' && !empty($_REQUEST['id'])){
    $itemData = array(
      'rowId' => $_REQUEST['id'],
      'quantity' => $_REQUEST['quantity']
    );
    $updateItem = $cart->update($itemData);
    // if the update returns TRUE, send ok, else send fail
    if($updateItem){
      echo 'ok';
    } else {
      echo 'fail';
      die();
    }
  } elseif ($_REQUEST['action'] == 'removeCartItem' && !empty($_REQUEST['id'])){
    $deleteItem = $cart->remove($_REQUEST['id']);
    if($deleteItem){
      header("Location: cart.php");
    }
  } elseif ($_REQUEST['action'] == 'placeOrder' && $cart->total_items() > 0 && !empty($_SESSION['user'])){
    //insert order into the database, this will return either TRUE or FALSE
    $insertOrder = mysqli_query($con, "INSERT INTO orders (user_id, total_price) VALUES ('".$_SESSION['user']['user_id']."', '".$cart->total()."')");

    if($insertOrder){
      //specify a specific order id, mysqli_insert_id returns the auto generated id used in the latest query
      $orderID = mysqli_insert_id($con);
      $query = '';
      // get cart items from the cart_contents variable to be able to store them in the order_items table
      $cartItems = $cart->contents();
      // loop through the array of that contents() returned, and make a multi query
      foreach($cartItems as $item){
        $query .= 'INSERT INTO order_items (order_id, product_id, quantity) VALUES ("'.$orderID.'", "'.$item['id'].'", "'.$item['quantity'].'");';
      }
      //insert the order items in the order_items table by using a multi query
      $insertOrderItems = mysqli_multi_query($con, $query);
      //if the multi query returns true, send the user to the order success page including its id
      if($insertOrderItems){
        $cart->destroy();
        header("Location: orderSuccess.php?id=$orderID");
      } else {
        header("Location: checkout.php");
      }
    } else {
      header("Location: checkout.php");
    }
  }
}



 ?>
