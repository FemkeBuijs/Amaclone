<?php
session_start();

function loginForm() {
    $form = "
    <div id=\"loginform\">
      <form action=\"newchat.php\" method=\"post\">
          <p>Please enter your username to continue:</p>
          <label for=\"name\">Name:</label>
          <input type=\"text\" name=\"name\" id=\"name\" />
          <input type=\"submit\" name=\"enter\" id=\"enter\" value=\"Enter\" />
      </form>
    </div>
    ";
    return $form;
}

if(isset($_POST['enter'])){
    if($_POST['name'] != ""){
        $_SESSION['name'] = stripslashes(htmlspecialchars($_POST['name']));
    }
    else{
        echo '<span class="error">You shall not pass unless >> type in your username</span>';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Chat - Customer Module</title>
<link type="text/css" rel="stylesheet" href="reso/static/css/chatstyle.css" />
</head>
<body>
<?php
if(!isset($_SESSION['name'])){
    echo loginForm();
    die();
}
else{
?>
<div id="wrapper">
    <div id="menu">
        <p class="welcome">Welcome to Amaclone service, <b><?php echo $_SESSION['name']; ?></b><br> How can we help?</br></p>
        <p class="logout">
          <!-- <a id="exit" href="#">Exit Chat</a> -->
          <a class="exit" id="exit">&#x2716;</a>
        </p>
        <div style="clear:both"></div>
    </div>

      <div id="chatbox">
        <?php
          if(file_exists("log.html") && filesize("log.html") > 0){
          $handle = fopen("log.html", "r");
          $contents = fread($handle, filesize("log.html"));
          fclose($handle);
          // echo $contents;
          }
          ?>
      </div>
      <!-- <input type='submit' name='usermsg' id='usermsg' size="63"/> -->
      <input name="usermsg" type="text" id="usermsg" size="63" />
      <button id="submitmsg">Send</button>


</div>

<?php
include 'reso/frames/scripts.php';

if(isset($_GET['logout'])){

    // exit message
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User ". $_SESSION['name'] ." has left the chat session.</i><br></div>");
    fclose($fp);

    //clears chat output once log out
    $fp = fopen("log.html", "w");
      fwrite($fp, " ");
      fclose($fp);

    session_destroy();
    header("Location: newchat.php"); //Redirect the user
}

}
?>
</body>
</html>
