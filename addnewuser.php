<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH-Registration page</title>
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
        Registration Form <br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p> <hr>
    </div>
    <?php
    require "database.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $fullname = $_POST["fullname"];
    $mail = $_POST["mail"];
    $phone = $_POST["phone"];
    if(isset($username) and isset($password)){
      if(addnewuser($username, $password, $fullname, $mail, $phone)){
        echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;' >Registration successful! </p>";
        echo "<div class='text-center mt-4'> <a href='form.php'> Login</a> </div>";
      }
      else{
        echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;'>Registration failed! </p> <br>";
      }
    }
    else{
      echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;'>No username/password provided! </p> <br>";
    }
    ?>
  </div>
</body>
</html>
