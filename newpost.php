<?php
  require "session_auth.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH-Post page</title>
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
    <div class="text-center mt-4">
      <a href="index.php">Home Page</a>
    </div>
    <?php
      $rand = bin2hex(openssl_random_pseudo_bytes(16));
      $_SESSION['nocsrftoken'] = $rand;
    ?>
    <form action="addnewpost.php" method="POST" class="p-3 mt-3">
        <input type="hidden" class="text_field" name="nocsrftoken" value="<?php echo $rand; ?>">
        <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 14px;">Title:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" class="text_field" name="title" required>
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem;">Content:</div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-user"></span>
            <input type="text" class="text_field" name="content" required>
        </div>
        <button class="btn mt-3">Add post</button>
    </form>
  </div>
</body>
</html>
