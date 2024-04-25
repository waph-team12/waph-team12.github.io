<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH-Change Password page</title>
  <link rel="stylesheet" href="styles.css"> <!-- Linking the external CSS file -->
  <script type="text/javascript">
      function displayTime() {
        document.getElementById('digit-clock').innerHTML = "Current time:" + new Date();
      }
      setInterval(displayTime,500);
  </script>
</head>
<body>
  <div class="wrapper">
    <div class="text-center mt-4 name">
        Change Password Form <br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p> <hr>
    </div>
    <?php
    require "session_auth.php";
    require "database.php";
    $token = $_POST['nocsrftoken'];
    if(!isset($token) or $token!=$_SESSION['nocsrftoken']){
      echo "CSRF attack detected";
      die();
    }
    $username = $_SESSION["username"];
    $password = $_REQUEST["newpassword"];
    if(isset($username) and isset($password)){
      if(changepassword($username, $password)){
        echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;' >Password has been changed! </p> <br>";
        echo "<div class='text-center mt-4'> <a href='index.php'> Home Page</a> </div>";
      }
      else{
        echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;'>Change password failed! </p>";
        echo "";
      }
    }
    else{
        echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;'>No username/password provided! </p>";
    }
    ?>
  </div>
</body>
</html>
