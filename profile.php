<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH-Edit Profile page</title>
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
        Edit Profile Form <br>
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
    $fullname = $_POST["fullname"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];
    if(isset($username)){
      if(editprofile($username, $fullname, $mail, $phone)){
        echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;' >Profile updated! </p> <br>";
        echo "<div class='text-center mt-4'> <a href='index.php'> Home Page</a> </div>";
      }
      else{
        echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;'>Failed to update profile! </p>";
      }
    }
    else{
      echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;'>No username provided! </p>";
    }
    ?>
  </div>
</body>
</html>
