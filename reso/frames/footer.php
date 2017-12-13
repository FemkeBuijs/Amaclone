<header>
</header>

<div class="m-t-3"></div>

<footer class="mainfooter navbar-fixed-bottom" style="bottom: 0;" role="contentinfo">
  <div class="footer-top p-y-2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="footer-title text-center">
          <h4 class="p-b-1">Contact Us</h4>
        </div>
        </div>


          <div class="col-md-4">
              <a role="button" class="btn btn-primary w-100 text-dark" id="callUs">Call Us </a>
          </div>
          <div class="col-md-4">
              <a role="button" class="btn btn-primary w-100 text-dark" href='emailus.php'>Email Us</a>
          </div>

          <div class="col-md-4">
              <a role="button" class="btn btn-primary w-100 text-dark" id="chat" target="popup"
              onclick="window.open('newchat.php','popup','width=600,height=500 bottom=right'); return false;">Chat with Us
              </a>
          </div>
      </div>
    </div>
  </div>

  <div class="row"><br>
  </div>

  <div class="footer-middle">
  <div class="container">
    <div class="row">
      <div class="col-md-4 col-sm-6">
        <!--Column1-->
        <div class="footer-pad">
          <h5>Address</h5>
          <address>
								<ul class="list-unstyled" style="font-size: 0.90em !important">
									<li>
                    Coolio Hall<br>
										314 Scouse Street<br>
										Liverpool<br>
										L3 6HR<br>
									</li>
									<li id='phoneNo'>
										Phone: 0123 456 789
									</li>
								</ul>
							</address>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <!--Column1-->
        <div class="footer-pad">
          <h5>Popular Services</h5>
          <ul class="list-unstyled">
            <li><a href="#"></a></li>
            <li><a href="#">Contact Directory</a></li>
            <li><a href="#">Forms</a></li>
            <li><a href="#">News and Updates</a></li>
            <li><a href="#">FAQs</a></li>
          </ul>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <!--Column1-->
        <div class="footer-pad">
          <h5>Website Information</h5>
          <ul class="list-unstyled">
            <li><a href="#">Accessibility</a></li>
            <li><a href="#">Disclaimer</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">FAQs</a></li>
          </ul>
        </div>
      </div>

    </div>
  </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        <div class="col-xs-12">
          <!--Footer Bottom-->
          <p class="text-xs-center" style="font-size: 0.8em !important; margin-left: 1em !important;">&copy; Copyright 2017 - Liverpool.  All rights reserved.</p>
        </div>
      </div>
    </div>
  </div>
</footer>
<?php if(isset($_POST['email'])){
  $to = $_POST['email'];
  $subject = 'Spam email from Amaclone';
  $message = '<html><body><p>Thank you for your inquiry. One of our customer service assistants will be in contact with you shortly.</p></body></html>';
  $headers[] = 'MIME-Version: 1.0';
  $headers[] = 'Content-type: text/html; charset=iso-8859-1';
  mail($to, $subject, $message, implode("\r\n", $headers));
} ?>
