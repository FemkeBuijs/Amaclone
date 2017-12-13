<?php
// We first require the connection from the base.php file
require 'reso/base.php';
include 'reso/classes/cartClass.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
  $cart = new Cart;

  $countryArray =["Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "The Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegovina", "Botswana", "Brazil", "Brunei", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile,People's Republic of China", "Republic of China", "Christmas Island", "Cocos(Keeling) Islands", "Colombia", "Comoros", "Congo", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Polynesia", "Gabon", "The Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea - Bissau", "Guyana", "Haiti", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "North Korea", "South Korea", "Kosovo", "Kuwait", "Kyrgyzstan", "Laos", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Nagorno - Karabakh", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Turkish Republic of Northern Cyprus", "Northern Mariana", "Norway", "Oman", "Pakistan", "Palau", "Palestine", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn Islands", "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russia", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "Somaliland", "South Africa", "South Ossetia", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syria", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "Timor - Leste", "Togo", "Tokelau", "Tonga", "Transnistria Pridnestrovie", "Trinidad and Tobago", "Tristan da Cunha", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Vatican City", "Venezuela", "Vietnam", "British Virgin Islands", "Isle of Man", "US Virgin Islands", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe"];
  $addressType = ["Home","Work","Amaclone Box","Other"];
  require 'reso/frames/header.php';
  ?>
  <script type='text/javascript' src='reso/static/js/cart.js'> </script>
  <style>
    .footBtn {
      text-align: right;
      margin: 25px;
    }
    .footBtn a {
      margin: 10px;
    }
  </style>
  <body>
    <?php include 'reso/frames/navbar.php';
  // get customer details by session customer ID
  $userquery = "SELECT * FROM users WHERE user_id = ".$_SESSION['user']['user_id'];
  $results = mysqli_query($con, $userquery);
  $custRow = mysqli_fetch_all($results, MYSQLI_ASSOC)[0];
  $addressQuery = "SELECT * FROM addresses WHERE user_id = ".$_SESSION['user']['user_id'];
  $addressResults = mysqli_query($con, $addressQuery);
  $addressResults = mysqli_fetch_all($addressResults, MYSQLI_ASSOC);
  $noAddresses = sizeof($addressResults);
  if(isset($_POST['address_id'])){
    $_SESSION['shipping_address']=$_POST['address_id'];
  }
  if (isset($_SESSION['shipping_address'])){
    $addressSelected = $_SESSION['shipping_address'];
  } else {
    $addressSelected = 0;
  }
  if (isset($_POST['address_name']) && isset($_POST['address_no']) && isset($_POST['phone_no']) && isset($_POST['address_street']) && isset($_POST['address_city']) && isset($_POST['postal_code'])&& isset($_POST['country'])) {
  		$data = array(
    	// Escape variables for security - mysqli_real_escape_string for the sake of sanitising the input
  			'address_name' => mysqli_real_escape_string($con, $_POST['address_name']),
  			'address_no' => mysqli_real_escape_string($con, $_POST['address_no']),
  			'phone_no' => mysqli_real_escape_string($con, $_POST['phone_no']),
  			'address_street' => mysqli_real_escape_string($con, $_POST['address_street']),
        'address_city' => mysqli_real_escape_string($con, $_POST['address_city']),
  			'postal_code' => mysqli_real_escape_string($con, $_POST['postal_code']),
        'country' => mysqli_real_escape_string($con, $_POST['country'])
  		);

      // Query the DB and store the results in a var
      $addressQ = 'INSERT INTO addresses (
        user_id,
        address_name,
  			address_no,
  			phone_no,
  			address_street,
        address_city,
  			postal_code,
        country
  		) VALUES (
        "'.$_SESSION['user']['user_id'].'",
  			"'.$data['address_name'].'",
  			"'.$data['address_no'].'",
  			"'.$data['phone_no'].'",
  			"'.$data['address_street'].'",
        "'.$data['address_city'].'",
  			"'.$data['postal_code'].'",
        "'.$data['country'].'"
  		)';

      $query = mysqli_query($con, $addressQ) or die(mysqli_error($con));
    }
   ?>

   <div class="container">
      <h3 class="mt-4" style="margin-left:0.38em !important;">Order Preview</h3>
      <table class="table">
      <thead>
          <tr>
              <th>Product</th>
              <th>Price</th>
              <th>Quantity</th>
          </tr>
      </thead>
      <tbody>
          <?php
          if($cart->total_items() > 0){
              //get cart items from session
              $cartItems = $cart->contents();
              foreach($cartItems as $item){
          ?>
          <tr>
              <td><?php echo $item["name"]; ?></td>
              <td><?php echo '£'.$item["price"]; ?></td>
              <td><?php echo $item["quantity"]; ?></td>
          </tr>
          <?php } }else{ ?>
          <tr><td colspan="3"><p>No items in your cart...</p></td>
          <?php } ?>
      </tbody>
      <tfoot>
          <tr>
              <?php if($cart->total_items() > 0){ ?>
              <td colspan="2"></td>
              <td class="text-center"><strong>Total <?php echo '£'.$cart->total(); ?></strong></td>
            <?php } else { ?>
              <td colspan='3'></td>
            <?php } ?>
          </tr>
      </tfoot>
      </table>
  <?php if($noAddresses==0){ ?>
    <h4> Please provide your address for the delivery: </h4>
    <hr />
    <br />
  <div id='provideAddress' class='col-lg-4'>
  <form action='' method='POST'>
    <select name='address_name'>
    <?php for ($k=0; $k<sizeof($addressType); $k++){ ?>
      <option value="<?php echo $addressType[$k]; ?>"><?php echo $addressType[$k]; ?></option>
    <?php } ?>
  </select> <br /><br />
    <div class='form-group w-100'>
    <label for='address_no'> House number: </label>
    <input type='text' class='form-control' name= 'address_no' id= 'address_no' placeholder='House number' />
    </div>
    <div class='form-group w-100'>
    <label for='address_street'> Street name: </label>
    <input type='text' class='form-control' name='address_street' id='address_street' placeholder='Street name' />
    </div>
    <div class='form-group w-100'>
    <label for='address_city'> City: </label>
    <input type='text' class='form-control' name='address_city' id='address_city' placeholder='City' />
  </div>
    <div class='form-group w-100'>
    <label for='postal_code'> Postal or ZIP Code: </label>
    <input type='text' class='form-control' if='postal_code' name='postal_code' placeholder= 'Postal or Zip Code'/>
  </div>
  <div class='form-group w-100'>
    <label for='country'> Country: </label>
    <select name="country" id='country' class='form-control' size=3>
      <?php for ($i=0; $i<sizeof($countryArray); $i++){ ?>
      <option value="<?php echo $countryArray[$i]?>" <?php if ($countryArray[$i]=='United Kingdom'){ echo 'selected';}?>><?php echo $countryArray[$i] ?></option>
      <?php } ?>
    </select>
  </div>
  <div class='form-group w-100'>
    <label for='phone_no'> Phone number: </label>
    <input type='text' id='phone_no' name='phone_no' class='form-control' placeholder='Phone Number'/>
  </div>
    <input class="btn btn-primary mb-3" type="submit" value='Add address' />
  </form>

  </div>

  <?php } else { ?>

        <div class='container'>
          <h3 style='text-align: left;'>Shipping Details</h3>
          <hr />
          <br />
          <h4> Your saved address: </h4>
          <hr />
          <br />
        <?php for ($j=0; $j<$noAddresses; $j++){
          if ($j%3==0){
            echo '<div class="row">';
          }
          ?>

         <div class="shipAddr col-md-4 productCard" style="width: 200px; height: auto;">
            <h4> <?php echo $addressResults[$j]['address_name'] ?> </h4>
            <p><?php echo $custRow['firstname'].' '.$custRow['lastname']; ?></p>
            <p><b> Address: </b> <br/><?php echo $addressResults[$j]['address_no'].' '.$addressResults[$j]['address_street']; ?> <br />
                            <?php echo $addressResults[$j]['address_city']; ?> <br />
                            <?php echo $addressResults[$j]['postal_code']; ?> <br />
                            <?php echo $addressResults[$j]['country']; ?> <br /> </p>
        </div>

    <?php
      if($j%3==2 || $j==$noAddresses-1){
        echo '</div>';
      }

    } ?>

    <div class="d-flex flex-row-reverse">
      <div class="footBtn">
        <a href="shop.php" class="btn btn-warning" style="background-color: #febd68 !important; border-color: #febd68 !important;"><i class="glyphicon glyphicon-menu-left"></i> Continue Shopping</a>
        <a href="cartActions.php?action=placeOrder" class="btn btn-success orderBtn">Place Order <i class="glyphicon glyphicon-menu-right"></i></a>
      </div>
    </div>


    </div>
    </div>
  <?php } ?>

  <!-- <br />
  <br />
  <h4 style='text-align: center;'> Add an alternative address </h4>
  <hr />
  <br />

  <div class="col-lg-4 productCard">
    <form action='' method='POST'>
      <select name='address_name'>
      <?php for ($k=0; $k<sizeof($addressType); $k++){ ?>
        <option value="<?php echo $addressType[$k]; ?>"><?php echo $addressType[$k]; ?></option>
      <?php } ?>
    </select> <br /><br />
      <div class='form-group w-100'>
      <label for='address_no'> House number: </label>
      <input type='text' class='form-control' name= 'address_no' id= 'address_no' placeholder='House number' />
      </div>
      <div class='form-group w-100'>
      <label for='address_street'> Street name: </label>
      <input type='text' class='form-control' name='address_street' id='address_street' placeholder='Street name' />
      </div>
      <div class='form-group w-100'>
      <label for='address_city'> City: </label>
      <input type='text' class='form-control' name='address_city' id='address_city' placeholder='City' />
    </div>
      <div class='form-group w-100'>
      <label for='postal_code'> Postal or ZIP Code: </label>
      <input type='text' class='form-control' if='postal_code' name='postal_code' placeholder= 'Postal or Zip Code'/>
    </div>
    <div class='form-group w-100'>
      <label for='country'> Country: </label>
      <select name="country" id='country' class='form-control' size=3>
        <?php for ($i=0; $i<sizeof($countryArray); $i++){ ?>
        <option value="<?php echo $countryArray[$i]?>" <?php if ($countryArray[$i]=='United Kingdom'){ echo 'selected';}?>><?php echo $countryArray[$i] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class='form-group w-100'>
      <label for='phone_no'> Phone number: </label>
      <input type='text' id='phone_no' name='phone_no' class='form-control' placeholder='Phone Number'/>
    </div>
      <input class="btn btn-primary" type="submit" value='Add address' />
    </form>
  </div>
  <form action='' method='POST'>
  </form> -->

    </div>
    <?php include 'reso/frames/footer.php'; ?>
    <?php include 'reso/frames/scripts.php'; ?>
    </body>

  <?php

} else {
  $_SESSION['previous_location'] = 'checkout.php';
  header("Location: login.php");
}

?>
