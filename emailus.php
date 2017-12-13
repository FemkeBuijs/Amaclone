<?php
// We first require the connection from the base.php file
require 'reso/base.php';
// We use the standard header information featured on every page on our website
require 'reso/frames/header.php';
?>
<!-- We use bootstrap specifications in order to create uniformity on our website and ensure mobile responsivity. -->
<div class="container">
  <div class='row'>
    <!-- The enquiry form is placed inside a centred card(through mx-auto)-->
    <div class='col-lg-6 mx-auto'>
      <div class='border rounded  p-3'>
        <h3> Please submit your enquiry here </h3>
        <!-- We send a post request to obtain the message and details from the customer -->
<form method='POST' action=''>
  <!-- The class form-group allows for a label to be given to each input and styles the spacing according to bootstrap -->
  <div class='form-group w-100'>
    <label for='customerName'> Name: </label>
    <input type='text' id='customerName' name='customerName' class='form-control' placeholder='your name' />
  </div>
  <!-- input type email validates automatically whether the input is a possible email -->
  <div class='form-group w-100'>
    <label for='email'> E-mail: </label>
    <input type='email' id='email' name='email' class='form-control' placeholder='Enter your email' />
  </div>
  <div class='form-group w-100'>
    <label for='orderNo'> Order Number: </label>
    <input type='text' id='orderNo' name='orderNo' class='form-control' placeholder='order number' />
  </div>
  <div class='form-group w-100'>
    <label for='messageTitle'> Subject: </label>
    <input type='text' id='messageTitle' name='messageTitle' class='form-control' placeholder='Subject' />
  </div>
  <div class='form-group w-100'>
    <label for='message'> Message: </label>
    <input type='text' id='message' name='message' class='form-control' placeholder='Your message' />
  </div>
  <input class="btn btn-primary" type="submit" value='Submit' />
</form>
</div>
</div>
</div>
</div>
<hr />
<br />
<!-- We use bootstrap specifications in order to create uniformity on our website and ensure mobile responsivity. -->
<div class="container">
  <div class='row'>
    <div class='col-lg-6 mx-auto' style='text-align: center;'>
<!-- The customer is given a link to the homepage if they decide they don't want to submit and enquiry or they wish to navigate away -->
        <a href='index.php'> Home page </a>

    </div>
  </div>
</div>
<?php
// Here we send an email to the customer about their enquiry
if(isset($_POST['email'])){
// We set the email of the customer to our 'to' variable to put in our cURL request, which send the email
  $to = $_POST['email'];
// We create the other key elements of the cURL request to send the email using default options hardcoded here and the details provided by the customer
  $subject = 'Your Amaclone Inquiry: '.$_POST['messageTitle'];
  $customerName = $_POST['customerName'];
  $orderNo = $_POST['orderNo'];
  $message = 'Dear '.$customerName.', Thank you for your inquiry about order number '.$orderNo.'. One of our customer service assistants will be in contact with you shortly.';
// We need to wordwrap our email message to 70 characters
  $message = wordwrap($message,70);
  $data = array(
    'from'      => 'Amaclone Bookstore <noreply@amaclone.com>',
    'to'        => $to,
    'subject'   => $subject,
    'text'      => $message
  );
// We transform our data into a http query to send in the cURL request
  $data = http_build_query($data);
  $ch = curl_init();
// We set the required cURL options to make a request to the mailgun API which handles our email requests
  curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  curl_setopt($ch, CURLOPT_USERPWD, 'api:key-e3fcf2d1ca429db8e54d2cafe518a092');
  curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandboxc5fdccfa711a4e2baf0ce5b9cfa05da0.mailgun.org/messages');
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $res = curl_exec($ch);

  if (curl_error($ch)) {
    echo curl_error($ch);
    die();
  }
// We confirm to the customer that their enquiry has been received
echo '<hr/> <br /> <div class="container"> <div class="row"><div class="col-lg-8 mx-auto"> <h5>Amaclone thanks you for your message. <br /> Please check your email for confirmation.</h5></div></div></div>';
}
?>
</body>
</html>
