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
        Mini-Facebook Registration <br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p> <hr>
    </div>
    <form action="addnewuser.php" method="POST" class="p-3 mt-3">
        <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 14px;">Username:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" class="text_field" required pattern="[\w.-]+@[\w-]+(\.[\w-]+)*$" name="username" placeholder="Username in email" title="Email address required as username" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');">
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem;">Password:</div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" class="text_field" name="password" required pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&])[\w!@#$%^&]{8,}$" placeholder="Your password" title="Password must have at least 8 characters with 1 special symbol !@#$%^& 1 number, 1 lowercase and 1 UPPERCASE" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:''); form.repassword.pattern=this.value">
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem;">Retype Password:</div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-key"></span>
            <input type="password" class="text_field" name="repassword" required placeholder="Retype your password" title="Password does not match" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');">
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem;">Full Name:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" class="text_field" name="fullname" placeholder="Full Name">
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem;">Other Email:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="text" class="text_field" name="mail" required pattern="^[\w.-]+@[\w-]+(.[\w-]+)*$" placeholder="Your email address" title="Please enter a valid email" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');">
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem;">Phone:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-envelope"></span>
            <input type="text" class="text_field" name="phone" required pattern="^\d{10}$" placeholder="Your phone number" title="Please enter a valid phone number" onchange="this.setCustomValidity(this.validity.patternMismatch?this.title:'');">
        </div>
        <button class="btn mt-3">Register</button>
    </form>
  </div>
</body>
</html>
