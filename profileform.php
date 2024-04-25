<?php
  require "session_auth.php"
?>
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
        Edit Profile Form<br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p>
    </div>
    <div class="text-center mt-4">
      <a href="index.php">Home Page</a> <hr>
    </div>
    <?php
      $rand = bin2hex(openssl_random_pseudo_bytes(16));
      $_SESSION['nocsrftoken'] = $rand;
    ?>
      <form action="profile.php" method="POST" class="p-3 mt-3">
        <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 14px;">Username: <?php echo htmlentities($_SESSION['username']); ?></div>
        <input type="hidden" class="text_field" name="nocsrftoken" value="<?php echo $rand; ?>">
        <div class="text-center mt-4 name" style="font-size: 1.2rem">Full Name:</div>
        <div class="form-field d-flex algn-items-center">
            <span class="far fa-user"></span>
            <input type="text" class="text_field" name="fullname" placeholder="Full Name">
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem">Other Email:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="text" class="text_field" name="mail" pattern="^[\w.-]+@[\w-]+(\.[\w-]+)*$" placeholder="Your email address" title="Please enter a valid email" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');">
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem">Phone:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="text" class="text_field" name="phone" pattern="^\d{10}$" placeholder="Your phone number" title="Please enter a valid phone number" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');">
        </div>
        <button class="btn mt-3">Edit Profile</button>
    </form>
  </div>
</body>
</html>
