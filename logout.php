<?php
	session_start();
	session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH-Logout page</title>
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
        Logout <br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p> <hr>
    </div>
    <div class="text-center mt-4 name" style="font-size: 1.2rem">You are logged out!</div>
    <div class="text-center mt-4 name" style="font-size: 1.2rem">
      <a href="form.php">Login again</a>
    </div>
  </div>
</body>
</html>
