<?php
require 'reso/base.php';

if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_conf'])) {
	if ($_POST['password_conf'] != $_POST['password']) {
		$error='Passwords do not match.';
	} elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			$error='Email address is not valid.';
	} else {
		$data = array(
  	// Escape variables for security - mysqli_real_escape_string for the sake of sanitising the input
			'firstname' => mysqli_real_escape_string($con, $_POST['firstname']),
			'lastname' => mysqli_real_escape_string($con, $_POST['lastname']),
			'email' => mysqli_real_escape_string($con, $_POST['email']),
			'password' => mysqli_real_escape_string($con, $_POST['password'])
		);
    // Encrypting the password and assigning it a salt (the email address in that case)
		$data['password'] = sha1($data['email'].$data['password']);

    // Query the DB and store the results in a var
    $q = 'INSERT IGNORE INTO users (
			firstname,
			lastname,
			email,
			password
		) VALUES (
			"'.$data['firstname'].'",
			"'.$data['lastname'].'",
			"'.$data['email'].'",
			"'.$data['password'].'"
		)';

    $query = mysqli_query($con, $q) or die(mysqli_error($con));

		if (mysqli_affected_rows($con) > 0) {
			echo 'Thanks for signing up, you\'ll be redirected to the login in a sec :)';
			header( "refresh:3; url=login.php" );
		} else {
			$error='Oops, that email is already taken.';
		}


	}
}

require 'reso/frames/header.php';

?>

<body>

<div class="container">
	<div class="row">
		<div class="col-lg-4 mx-auto">
			<img src="reso/static/img/amaclone.png" class="mt-2 mb-2 img w-50" style="margin-left:25%" alt="Responsive image">
		</div>
	</div>
  <div class='row'>
    <div class='col-lg-4 mx-auto'>
			<div class='border rounded p-3'>
				<form action='registration.php' method='POST'>
					<div class='form-group w-100'>
						<label for='firstname'> First Name: </label>
						<input type='text' id='firstname' class='form-control' name='firstname' placeholder='First name'/>
					</div>
					<div class='form-group w-100'>
						<label for='lastname'> Last Name: </label>
						<input type='text' id='lastname' class='form-control' name='lastname' placeholder='Last name'/>
					</div>
				  <div class='form-group w-100'>
				    <label for='email'> E-mail: </label>
				    <input type='email' id='email' name='email' class='form-control' placeholder='Enter your email' />
				  </div>
				  <div class='form-group w-100'>
				    <label for='password'> Password: </label>
				    <input type='password' id='password' name='password' class='form-control' placeholder='Password'/>
				  </div>
					<div class='form-group w-100'>
						<label for='confPassword'> Confirm your password: </label>
						<input type='password' id='confPassword' name='password_conf' class='form-control' placeholder='Confirm Password'/>
					</div>
				  <input class="btn btn-primary" type="submit" value='Register' />
					<a href="frontShop.php" class="btn btn-primary" role="button">Home Page</a>
				</form>
			</div>
		</div>
	</div>
</div>
</body>
</html>
