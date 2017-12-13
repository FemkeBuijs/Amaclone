<?php

require 'reso/base.php';


if (isset($_POST['title']) && isset($_POST['author']) && isset($_POST['description']) && isset($_POST['price']) && isset($_POST['img'])) {
		$data = array(
  	// Escape variables for security - mysqli_real_escape_string for the sake of sanitising the input
			'title' => mysqli_real_escape_string($con, $_POST['title']),
			'author' => mysqli_real_escape_string($con, $_POST['author']),
			'description' => mysqli_real_escape_string($con, $_POST['description']),
			'price' => mysqli_real_escape_string($con, $_POST['price']),
      'img' => mysqli_real_escape_string($con, $_POST['img']),
			'genre_id' => mysqli_real_escape_string($con, $_POST['genre_id'])
		);

    // Query the DB and store the results in a var
    $q = 'INSERT INTO products (
			title,
			author,
			description,
			price,
      img,
			genre_id
		) VALUES (
			"'.$data['title'].'",
			"'.$data['author'].'",
			"'.$data['description'].'",
			"'.$data['price'].'",
      "'.$data['img'].'",
			"'.$data['genre_id'].'"

		)';

    $query = mysqli_query($con, $q) or die(mysqli_error($con));
    // $results = mysqli_fetch_all($query, MYSQLI_ASSOC);
    // var_dump($results);
		header('location: admin.php');

	}

	require 'reso/frames/header.php';

?>
<div class="container">
  <div class='row'>
    <div class='col-lg-4 mx-auto'>
<div class='border rounded  p-3'>
	<h3> Add a new product: </h3>
<form action='admin.php' method='POST'>
  <div class='form-group w-100'>
    <label for='title'> Title: </label>
    <input type='text' id='title' name='title' class='form-control' placeholder='Title' />
  </div>
	<div class='form-group w-100'>
		<label for='author'> Author: </label>
		<input type='text' id='author' name='author' class='form-control' placeholder='Author' />
	</div>
	<div class='form-group w-100'>
		<label for='description'> Description: </label>
		<input type='text' id='description' name='description' class='form-control' placeholder='Description' />
	</div>
	<div class='form-group w-100'>
		<label for='price'> Price: </label>
		<input type='text' id='price' name='price' class='form-control' placeholder='Price' />
	</div>
	<div class='form-group w-100'>
		<label for='img'> Image URL: </label>
		<input type='text' id='img' name='img' class='form-control' placeholder='Image URL' />
	</div>
	<div class='form-group w-100'>
		<label for='genre_id'> Genre: </label>
	<select id='genre_id' name="genre_id" class='form-control'>
		<option value="1">Book</option>
		<option value="2">Magazine</option>
		<option value="3">Comic</option>
	</select>
</div>
  <input class="btn btn-primary" type="submit" value='Add Product' />
</form>
</div>
</div>
</div>
</div>
</body>
</html>
