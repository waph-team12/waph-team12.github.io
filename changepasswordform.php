<?php
  require "session_auth.php"
?>
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
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p>
    </div>
    <div class="text-center mt-4">
      <a href="index.php">Home Page</a> <hr>
    </div>
    <?php
      $rand = bin2hex(openssl_random_pseudo_bytes(16));
      $_SESSION['nocsrftoken'] = $rand;
    ?>
    <form action="changepassword.php" method="POST" class="p-3 mt-3">
        <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 14px;">Username: <?php echo htmlentities($_SESSION['username']); ?></div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem">Password:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="password" class="text_field" name="newpassword" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$" placeholder="New password" title="Password must have at least 8 characters with 1 special symbol !@#$%^& 1 number, 1 lowercase and 1 UPPERCASE" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:''); form.repassword.pattern=this.value">
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem">Retype Password:</div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" class="text_field" name="repassword" required placeholder="Retype your password" title="Password does not match" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');">
        </div>
        <input type="hidden" class="text_field" name="nocsrftoken" value="<?php echo $rand; ?>">
        <button class="btn mt-3">Change Password</button>
    </form>
  </div>
</body>
</html>
