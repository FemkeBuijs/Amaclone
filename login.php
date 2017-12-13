<?php

// Required files
require 'reso/base.php';

if(isset($_POST['email']) && isset($_POST['password'])){
  // Sanitise Email Address
  $email = mysqli_real_escape_string($con, $_POST['email']);
  // Query to search for user by email
  $query = 'SELECT * FROM users WHERE email = "'.$email.'" LIMIT 1';
  // Perform query and save in $user variable
  $user = mysqli_query($con, $query) or die(mysqli_connect_errorno());

  // Check if there are any results and do something with it
  if (mysqli_num_rows($user) > 0){
      // Parse results into a Hashmap
      $user = mysqli_fetch_all($user, MYSQLI_ASSOC);
      // Encrypt password from input
      $input_password = mysqli_real_escape_string($con, $_POST['password']);
      $input_password = sha1($email.$input_password);
      // Check passwords match
      if ($input_password === $user[0]['password']) {
        // Set logged in token
        $_SESSION['logged_in'] = true;
        // Save user details in session
        $_SESSION['user'] = $user[0];
        // Redirect to secure
        if (isset($_SESSION['previous_location'])) {
          header('Location: '.$_SESSION['previous_location']);
        } else {
          header('Location: shop.php');
        }

      } else {
        echo "Password is incorrect, please check your password";
      }

  } else {
      echo 'Account cannot be found, please try again or register';
  }
}
require 'reso/frames/header.php';


 ?>

<?php

if(isset($_SESSION['previous_location']) && $_SESSION['previous_location'] == 'checkout.php'){
  echo '<h2>Please login to complete your order.</h2>';
} elseif (isset($_SESSION['previous_location']) && $_SESSION['previous_location'] == 'orders.php') {
  echo '<h3>You need to be logged in to view your orders page.</h3>';
}

?>
<div class="container">
  <div class="row">
    <div class="col-lg-4 mx-auto">
      <img src="reso/static/img/amaclone.png" class="mt-2 mb-2 img w-50" style="margin-left:25%" alt="Responsive image">
    </div>
  </div>
  <div class='row'>
    <div class='col-lg-4 mx-auto'>
<div class='border rounded  p-3'>
<form action='login.php' method='POST'>
  <div class='form-group w-100'>
    <label for='email'> E-mail: </label>
    <input type='email' id='email' name='email' class='form-control' placeholder='Enter your email' />
  </div>
  <div class='form-group w-100'>
    <label for='password'> Password: </label>
    <input type='password' id='password' name='password' class='form-control' placeholder='password'/>
  </div>
  <input class="btn btn-primary" type="submit" value='Log in' />
</form>
<br />
<hr class='hr-text' data-content='New to Amaclone?' >
<div style='text-align: center;'>
  <a href="registration.php" class="btn btn-primary" role="button"> Create your Amaclone account </a>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
