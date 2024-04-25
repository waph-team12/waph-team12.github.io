<?php
  require "session_auth.php";
  require "database.php";
  $error_message = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['title']) && !empty($_POST['content'])) {
        $post_id = $_GET['post_id'];
        $title = sanitize_input($_POST['title']);
        $content = sanitize_input($_POST['content']);
        $owner = $_SESSION['username'];
      
        $success = editmypost($post_id, $title, $content, $owner);
        if ($success) {
            header("Location: myposts.php");
            exit();
        } else {
            $error_message = "Error: Failed to update the post.";
        }
    } else {
        $error_message = "Error: Title and content are required.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>WAPH-Edit Post page</title>
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
        Edit Post<br>
        <p style="font-size: 1rem; padding: 10px;" id="digit-clock"></p>
    </div>
    <div class="text-center mt-4">
      <a href="myposts.php">Your Posts</a> <hr>
    </div>
    <?php
      $rand = bin2hex(openssl_random_pseudo_bytes(16));
      $_SESSION['nocsrftoken'] = $rand;
      if(isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
      } else {
        echo "No ID provided!";
      }
    ?>
      <form method="POST" class="p-3 mt-3">
        <input type="hidden" class="text_field" name="nocsrftoken" value="<?php echo $rand; ?>">
        <div class="text-center mt-4 name" style="font-size: 1.2rem; padding: 14px;">Title:</div>
        <div class="form-field d-flex align-items-center">
            <span class="far fa-user"></span>
            <input type="text" class="text_field" name="title" id="titleInput" required>
        </div>
        <div class="text-center mt-4 name" style="font-size: 1.2rem;">Content:</div>
        <div class="form-field d-flex align-items-center">
            <span class="fas fa-user"></span>
            <input type="text" class="text_field" name="content" id="contentInput" required>
        </div>
        <button type="submit" class="btn mt-3">Edit post</button>
    </form>
    <?php
    if (!empty($error_message)) {
        echo '<p style="color: red;">' . $error_message . '</p>';
    }
    ?>
  </div>
</body>
</html>
