<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH-Login page</title>
  <link rel="stylesheet" href="styles.css"> <!-- Linking the external CSS file -->
  <script type="text/javascript">
      function displayTime() {
        document.getElementById('digit-clock').innerText = "Current time:" + new Date();
      }
      setInterval(displayTime,500);
  </script>
</head>
<body> 
  <div class="wrapper">
    <div class="text-center mt-4 name">
        Mini-Facebook Login <br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"/> <hr>
    </div>
    <form class="p-3 mt-3" action="index.php" method="POST">
        <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 14px;"> Username: </div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" name="username" id="username" placeholder="Username" required>
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem;"> Password: </div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" name="password" id="pwd" placeholder="Password" required>
        </div>
        <button class="btn mt-3">Login</button>
    </form>
  </div>
</body>
</html>
