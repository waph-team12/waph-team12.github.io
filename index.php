<?php
require "database.php";
// Start the session
session_set_cookie_params(15*60,"/","waph-team12.minifacebook.com",TRUE,TRUE);
session_start();

// Check if the username and password are posted
if(isset($_POST["username"]) && isset($_POST["password"])) {
    // Validate login credentials
    if (checklogin_mysql($_POST["username"],$_POST["password"])) {
        // Set session variables
        $_SESSION["authenticated"] = TRUE;
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["browser"] = $_SERVER["HTTP_USER_AGENT"];
    } else {
        // Invalid credentials, destroy session and redirect
        session_destroy();
        echo "<script>alert('Invalid username/password');window.location='form.php';</script>";
        die();
    }
}

// Check authentication status
if(!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== TRUE) {
    // Not authenticated, destroy session and redirect
    session_destroy();
    echo "<script>alert('You have not logged in. Please login first!');</script>";
    header("Refresh: 0; url=form.php");
    die();
}

// Check for session hijacking
if(isset($_SESSION["browser"]) && isset($_SERVER["HTTP_USER_AGENT"]) && $_SESSION["browser"] !== $_SERVER["HTTP_USER_AGENT"]) {
    echo "<script>alert('Session hijacking is detected!');</script>";
    header("Refresh: 0; url=form.php");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH - Home page</title>
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
        Home Page <br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p>
    </div>
    <div class="text-center mt-4">
      <a href="logout.php">Logout</a> |
      <a href="profileform.php">Edit Profile</a> |
      <a href="changepasswordform.php">Change Password</a>|
      <a href="myposts.php">Your Posts</a>
    </div>
    <hr>
    <h2 class="text-center mt-4 name" style="font-size: 1.2rem; padding: 10px;">Welcome <?php echo isset($_SESSION['username']) ? htmlentities($_SESSION['username']) : "Guest"; ?> to Mini-Facebook! <br/></h2>
    <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 10px;">
        Your Profile:
    </div>
    <?php view_profile($_SESSION['username']) ?>
    <hr>
    <a href="newpost.php">Write a New Post</a>    
    <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 10px;">
        Posts:
    </div>
    <?php display_posts() ?>
  </div>
</body>
</html>

