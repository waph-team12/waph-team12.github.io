<?php
require "database.php";
require "session_auth.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH - Post page</title>
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
        Post Page <br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p>
    </div>
    <div class="text-center mt-4">
      <a href="index.php">Home Page</a>
    </div>
    <hr>
    <h2 class="text-center mt-4 name" style="font-size: 1.2rem; padding: 10px;">Welcome <?php echo isset($_SESSION['username']) ? htmlentities($_SESSION['username']) : "Guest"; ?> to Mini-Facebook! <br/></h2>
    <?php
      if(isset($_GET['id'])) {
        $id = $_GET['id'];
      } else {
        echo "No ID provided!";
      }
    ?>
    <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 10px;">
        Post: <?php echo "ID: " . $id; ?>
    </div>
    <?php display_post($id) ?>
    <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 10px;">
        Comments:
    </div>
    <?php display_comments($id) ?>
    <hr>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id; ?>" method="POST" class="p-3 mt-3">
        <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 14px;">Comment:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" class="text_field" name="comment_content" required>
        </div>
        <button class="btn mt-3">Add comment</button>
    </form>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $comment_content = $_POST["comment_content"];
        $commenter = $_SESSION["username"];
        addnewcomment($id, $comment_content, $commenter);
        header("Location: {$_SERVER['PHP_SELF']}?id=$id");
        exit;
      }
    ?>
  </div>
</body>
</html>
