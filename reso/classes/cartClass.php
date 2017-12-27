<?php
//PLEASE DON'T TOUCH =)

class Cart {
  protected $cart_contents = array();

  public function __construct(){
    //$this->destroy();
    //if the session is empty, set some base values to the session
    if (empty($_SESSION['cart_contents'])) {
      $_SESSION['cart_contents'] = array('cart_total' => 0, 'total_items' => 0);
    }
    // get the shopping cart array from the session
    $this->cart_contents = $_SESSION['cart_contents'];
  }

  //Cart Contents: Returns the entire cart array
  public function contents(){
    //Reverse the array as to put the newest item first
    $cart = array_reverse($this->cart_contents);
    // remove these so they don't create a problem when showing the car table
    unset($cart['total_items']);
    unset($cart['cart_total']);

    return $cart;
  }

  //Total Items: Returns the total item count
  public function total_items(){
    return $this->cart_contents['total_items'];
  }

  //Cart total: Returns the total price
  public function total(){
    return $this->cart_contents['cart_total'];
  }

  //Insert items into the cart and save it to the session
  public function insert($item = array()){
    if(!is_array($item) OR count($item) === 0) {
      //if $item is not an array or if the array is empty, return false
      return FALSE;
    } else {
      //turn the quantity to a floating number to be safe
      $item['quantity'] = (float) $item['quantity'];
      //if it's empty return false
      if($item['quantity'] === 0){
        return FALSE;
      }
      //turn the price to a floating number to be safe
      $item['price'] = (float) $item['price'];
      //create a unique identifier for the item being inserted into the cart_contents
      $rowId = md5($item['id']);
      //check if there is already a quantity property set for a specific item, if not create a new one and set it to 0
      if(!isset($this->cart_contents[$rowId]['quantity'])){
        $old_quantity = $this->cart_contents[$rowId]['quantity'] = 0;
      } else {
        $old_quantity = $this->cart_contents[$rowId]['quantity'];
      }
      // re-create the entry with the unique identifier and updated quantity
      $item['quantity'] = $old_quantity + 1;
      $item['rowid'] = $rowId;
      $this->cart_contents[$rowId] = $item;
      // save Cart item
      if($this->save_cart()){
        return TRUE;
      } else {
        return FALSE;
      }
    }
  }

  public function update($item = array()){
    if(!is_array($item) OR count($item) === 0){
      return FALSE;
    } else {
      //turn the quantity to a floating number to be safe
      $item['quantity'] = (float) $item['quantity'];
      //if quantity is 0, delete the item
      if($item['quantity'] === 0){
        $removeItem = $this->remove($item['rowId']);
        if($removeItem){
          return TRUE;
        }
      } else {
        $this->cart_contents[$item['rowId']]['quantity'] = $item['quantity'];
        $this->save_cart();
        return TRUE;
      }
    }
  }
  //Save the cart array to the session
  protected function save_cart(){
    //to make sure the cart total is set to 0
    $this->cart_contents['cart_total'] = $this->cart_contents['total_items'] = 0;
    //do a for each loop through the array or arrays, where key is the array number, and val the content of the array
    foreach($this->cart_contents as $key => $val){
      //make sure the val is an array and that the price and quantity are set
      if(is_array($val) AND isset($val['price'], $val['quantity'])){
        //set the total and total items in the cart_contents array, which adds the price*quantity of each item in the cart
        $this->cart_contents['cart_total'] += ($val['price']*$val['quantity']);
        $this->cart_contents['total_items'] += ($val['quantity']);
      }
    }

    $_SESSION['cart_contents'] = $this->cart_contents;
    return TRUE;
  }

  //Remove Item: Removes an item from the cart
  public function remove($row_id){
    unset($this->cart_contents[$row_id]);
    $this->save_cart();
    return TRUE;
  }

  //Destroy the cart: Empties the cart and destroys the session
  public function destroy(){
      $_SESSION['cart_contents'] = array('cart_total' => 0, 'total_items' => 0);
      $this->cart_contents = $_SESSION['cart_contents'];
  }
}

 ?>
