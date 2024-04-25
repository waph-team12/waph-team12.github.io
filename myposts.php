<?php
require "database.php";
require "session_auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH - Your Posts</title>
  <link rel="stylesheet" href="styles.css"> <!-- Linking the external CSS file -->
  <script type="text/javascript">
      function displayTime() {
        document.getElementById('digit-clock').innerHTML = "Current time:" + new Date();
      }
      setInterval(displayTime,500);
  </script>
</head>
<body>
  <div class="wrapper" style="max-width: 1000px; min-height: 600px;">
    <div class="text-center mt-4 name">
        Your Posts <br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p>
    </div>
    <div class="text-center mt-4">
      <a href="index.php">Home Page</a>
    </div>
    <hr>
    <h2 class="text-center mt-4 name" style="font-size: 1.2rem; padding: 10px;">Welcome <?php echo isset($_SESSION['username']) ? htmlentities($_SESSION['username']) : "Guest"; ?> to Mini-Facebook! <br/></h2>
    <a href="newpost.php">Write a New Post</a> 
    <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 10px;">
        Your Posts:
    </div>
    <?php display_user_posts($_SESSION['username']);
if (isset($_GET['delete_error'])) {
    // Display the error message
    echo "<p style='color: red;'>" . htmlentities($_GET['delete_error']) . "</p>";
}
?>
  </div>
</body>
</html>
