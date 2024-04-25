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
        Add Post <br>
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
    $title = $_POST["title"];
    $content = $_POST["content"];
    if(isset($title) and isset($content)){
      $owner = $_SESSION["username"];
      if(addnewpost($title, $content, $owner)){
        echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;' >New post added! </p>";
        echo "<div class='text-center mt-4'> <a href='myposts.php'> Your Posts</a> </div>";
      }
      else{
        echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;'>Failed to add post! </p> <br>";
      }
    }
    else{
      echo "<p class='text-center mt-4 name' style='font-size: 1rem; padding: 14px;'>No title/content provided! </p> <br>";
    }
    ?>
  </div>
</body>
</html>
