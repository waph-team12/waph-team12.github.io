<?php
  	$mysqli = new mysqli('localhost' ,'waph-team12', 'Pa$$w0rd', 'waph_team');
	if ($mysqli->connect_errno) 
	{
		printf("Database connection failed; %s\n", $mysqli->connect_errno);
		exit();
	}

	function sanitize_input($input){
		$input = trim($input);
		$input = stripslashes($input);
		$input = htmlspecialchars($input);
		return $input;
	}

	function addnewuser($username, $password, $fullname, $mail, $phone) {
		$username = sanitize_input($username);
		$password = sanitize_input($password);
		$fullname = sanitize_input($fullname);
		$mail = sanitize_input($mail);
		$phone = sanitize_input($phone);
		global $mysqli;
		$prepared_sql = "INSERT INTO users (username,password,fullname,mail,phone,superuser,enable) VALUES (?, md5(?), ?, ?, ?,0,1);";
		$stmt = $mysqli->prepare($prepared_sql);
		$stmt->bind_param("sssss", $username, $password, $fullname, $mail, $phone);

		if($stmt->execute())
			return TRUE;
		return FALSE;
  	}

	function checklogin_mysql($username, $password) {
		$username = sanitize_input($username);
		$password = sanitize_input($password);
    		global $mysqli;
		$prepared_sql = "SELECT * FROM users WHERE username = ? AND password = md5(?) AND enable = 1";
    		$stmt = $mysqli->prepare($prepared_sql);
    		$stmt->bind_param("ss", $username, $password);
    		$stmt->execute();
    		$result = $stmt->get_result();

    		if($result->num_rows == 1)
        		return TRUE;
    		return FALSE;
	}

	function is_superuser($username) {
		$username = sanitize_input($username);
    		global $mysqli;
		$prepared_sql = "SELECT superuser FROM users WHERE username = ?";
    		$stmt = $mysqli->prepare($prepared_sql);
    		$stmt->bind_param("s", $username);
    		$stmt->execute();
		$stmt->bind_result($superuser);
    		$stmt->fetch();
		return $superuser === 1;
	}

function registered_users(){
    global $mysqli;
    $query = "SELECT username, fullname, enable  FROM users WHERE superuser=0";
    $result = $mysqli->query($query);
    $htmlContent = "";

    if ($result && $result->num_rows > 0) {
        // Loop through each row of the result set
        while ($row = $result->fetch_assoc()) {
            // Concatenate HTML content
            $htmlContent .= "<link rel='stylesheet' href='styles.css'>";
            $htmlContent .= "<div class='text-center mt-4 name' style='font-size: 1rem'>UserName:" . htmlentities($row["username"]) . " | Full Name:"  . htmlentities($row["fullname"]) . 
                            "|<form method='post'><input type='hidden' name='username' value='" . $row["username"] . "'>";
            
            // Determine if the user is enabled or disabled and display the appropriate button
            if ($row["enable"] == 1) {
                $htmlContent .= "<input type='submit' name='disable' value='Disable' style='text-decoration: none; font-size: 0.8rem; color: #03A9F4; background-color: transparent; border: none; cursor: pointer;'>";
            } else {
                $htmlContent .= "<input type='submit' name='enable' value='Enable' style='text-decoration: none; font-size: 0.8rem; color: #03A9F4; background-color: transparent; border: none; cursor: pointer;'>";
            }
		
            $htmlContent .= "</form></div>";
        }
        echo $htmlContent; // Output the HTML content
    } else {
        echo "<p class='text-center mt-4 name' style='font-size: 1rem'>No users found</p>";
    }
}

function enableUser($username){
    global $mysqli;
    $query = "UPDATE users SET enable = 1 WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
}

function disableUser($username){
    global $mysqli;
    $query = "UPDATE users SET enable = 0 WHERE username = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->close();
}

    function editprofile($username, $fullname, $mail, $phone) {
		$username = sanitize_input($username);
		$fullname = sanitize_input($fullname);
		$mail = sanitize_input($mail);
		$phone = sanitize_input($phone);
		global $mysqli;
		$prepared_sql = "UPDATE users SET fullname = ?, mail = ?, phone = ? WHERE username = ?;";
    		$stmt = $mysqli->prepare($prepared_sql);
    		$stmt->bind_param("ssss", $fullname, $mail, $phone, $username);

    		if($stmt->execute())
      			return TRUE;
    		return FALSE;
   	}

    function changepassword($username, $password) {
		$username = sanitize_input($username);
		$password = sanitize_input($password);
    		global $mysqli;

    		$prepared_sql = "UPDATE users SET password = md5(?) WHERE username = ?;";
    		$stmt = $mysqli->prepare($prepared_sql);
    		$stmt->bind_param("ss", $password, $username);

    		if($stmt->execute())
      			return TRUE;
    		return FALSE;
    	}

    function display_posts() {
    		global $mysqli;
    		$query = "SELECT post_ID, title, content, post_time, owner FROM posts";
    		$result = $mysqli->query($query);
    		$htmlContent = "";

    		if ($result && $result->num_rows > 0) {
        	// Loop through each row of the result set
           	  while ($row = $result->fetch_assoc()) {
           	  	echo "<link rel='stylesheet' href='styles.css'>";
            		// Format the output: title, post_time, owner in bold on one line, content on the next line
			$htmlContent .= "<div class='text-center mt-4'> <a href='post.php?id=" . $row['post_ID'] . "'>Title:" . $row['title'] . "</a>";
            		$htmlContent .= "<p class='text-center mt-4 name' style='font-size: 1rem'>Post time:" . $row['post_time'] . ", Owner:" . $row['owner'] . "</p>";			
            		$htmlContent .= "<p class='text-center mt-4 name' style='font-size: 1rem'>Content:" . $row['content'] . "</p> <hr>";
          	 }
    		} else {
        		$htmlContent = "<p class='text-center mt-4 name' style='font-size: 1rem'>No posts found</p>";
    		}

	    echo $htmlContent;
    	}

    function display_post($id) {
    		global $mysqli;
	       	$prepared_sql = "SELECT title, content, owner FROM posts WHERE post_ID = ?;";
    		$stmt = $mysqli->prepare($prepared_sql);
    		$stmt->bind_param("s", $id);

    		if(!$stmt->execute())
    			{$title =  NULL; $content = NULL; $owner = NULL;}
    		if(!$stmt->bind_result($title, $content, $owner)) 
    			echo "Binding failed";
	    
	    	while ($stmt->fetch()) {
			echo "<link rel='stylesheet' href='styles.css'>";
    			echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Title:" . htmlentities($title) . "</p>";
			echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Owner:" . htmlentities($owner) . "</p>";
			echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Content:" . htmlentities($content) . "</p>";
    		}
    }

    function display_user_posts($owner) {
    		global $mysqli;
	       	$prepared_sql = "SELECT post_ID, title, content, post_time FROM posts WHERE owner = ?;";
    		$stmt = $mysqli->prepare($prepared_sql);
    		$stmt->bind_param("s", $owner);

    		if(!$stmt->execute())
    			{$post_ID = NULL; $title =  NULL; $content = NULL; $post_time = NULL;}
    		if(!$stmt->bind_result($post_ID, $title, $content, $post_time)) 
    			echo "Binding failed";
	    
	    	while ($stmt->fetch()) {
			echo "<link rel='stylesheet' href='styles.css'>";
			echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Title:" . htmlentities($title) . "| <a href='editpost.php?post_id=$post_ID'>Edit</a>
   				| <a href='javascript:void(0);' onclick='deletePost($post_ID)'>Delete</a> </p>";
			echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Post time:" . htmlentities($post_time) . "</p>";
			echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Content:" . htmlentities($content) . "</p> <hr>";
    		}
    }
    
    function delete_post($post_ID) {
    		global $mysqli;
	       	$prepared_sql = "DELETE FROM posts WHERE post_ID = ?;";
    		$stmt = $mysqli->prepare($prepared_sql);
    		$stmt->bind_param("i", $post_ID);

	    	if($stmt->execute()){
			header("Location: {$_SERVER['PHP_SELF']}");
			return TRUE;
		}
		return FALSE;
    }

// Check if a form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["enable"])) {
        enableUser($_POST["username"]);
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit;
    } elseif (isset($_POST["disable"])) {
        disableUser($_POST["username"]);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } elseif (isset($_POST['post_id'])) {
        $post_id = $_POST['post_id'];
        if (delete_post($post_id)) {
            // Deletion successful, you can redirect or do any other action here
            header("Location: {$_SERVER['PHP_SELF']}");
            exit();
        } else {
            echo "Error deleting post";
        }
    }
}

   function display_comments($id) {
    		global $mysqli;
	       	$prepared_sql = "SELECT comment_content, comment_time, commenter FROM comments WHERE post_ID = ?;";
    		$stmt = $mysqli->prepare($prepared_sql);
    		$stmt->bind_param("s", $id);

    		if(!$stmt->execute())
    			{$comment_content =  NULL; $comment_time = NULL; $commenter = NULL;}
    		if(!$stmt->bind_result($comment_content, $comment_time, $commenter)) 
    			echo "Binding failed";
	    
		while ($stmt->fetch()) {
    			echo "<link rel='stylesheet' href='styles.css'>";
    			// Format the output: title, post_time, owner in bold on one line, content on the next line
    			echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Comment:" . htmlentities($comment_content) . "</p> <p class='text-center mt-4 name' style='font-size: 1rem'>Comment time:" . htmlentities($comment_time) . ", Commenter:" . htmlentities($commenter) . "</p>";			
		}	    
    }

    function addnewcomment($id, $comment_content, $commenter){
	    	$id = sanitize_input($id);
		$comment_content = sanitize_input($comment_content);
		$commenter = sanitize_input($commenter);
    		global $mysqli;
	       	$prepared_sql ="INSERT INTO comments (post_ID,comment_content,commenter) VALUES (?, ?, ?);";
		$stmt = $mysqli->prepare($prepared_sql);
		$stmt->bind_param("sss", $id, $comment_content, $commenter);

		if($stmt->execute())
			return TRUE;
		return FALSE;		    
    }

    function view_profile($username){
		$username = sanitize_input($username);
     		global $mysqli;
    		$prepared_sql = "SELECT fullname,mail,phone FROM users WHERE username = ?;";
    		$stmt = $mysqli->prepare($prepared_sql);
    		$stmt->bind_param("s", $username);

    		if(!$stmt->execute())
    			{$fullname =  NULL; $mail = NULL; $phone = NULL;}
    		if(!$stmt->bind_result($fullname,$mail,$phone)) 
    			echo "Binding failed";

    		while($stmt->fetch()){
        		echo "<link rel='stylesheet' href='styles.css'>";
        		echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Full name:" . htmlentities($fullname) . "</p>";
        		echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Other Mail:" . htmlentities($mail) . "</p>";
         		echo "<p class='text-center mt-4 name' style='font-size: 1rem'>Phone:" . htmlentities($phone) . "</p>";
    		}
    	}

	function addnewpost($title, $content, $owner) {
		$title = sanitize_input($title);
		$content = sanitize_input($content);
		$owner = sanitize_input($owner);
		global $mysqli;
		$prepared_sql = "INSERT INTO posts (title,content,owner) VALUES (?, ?, ?);";
		$stmt = $mysqli->prepare($prepared_sql);
		$stmt->bind_param("sss", $title, $content, $owner);

		if($stmt->execute())
			return TRUE;
		return FALSE;
  	}

	function editmypost($post_ID, $title, $content, $owner) {
		
		$post_ID = sanitize_input($post_ID);
		$title = sanitize_input($title);
		$content = sanitize_input($content);
		$owner = sanitize_input($owner);
		global $mysqli;
		$prepared_sql = "UPDATE posts SET title = ?, content = ?, owner = ? WHERE post_ID = ?;";
		$stmt = $mysqli->prepare($prepared_sql);
		$stmt->bind_param("ssss", $title, $content, $owner, $post_ID);

		if($stmt->execute())
			return TRUE;
		return FALSE;
  	}
?>
<script>	
function deletePost(postID) {
    // Create a form and submit it to trigger the deletion
    var form = document.createElement('form');
    form.method = 'post';
    form.action = '<?php echo $_SERVER['PHP_SELF']; ?>';
    var input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'post_id';
    input.value = postID;
    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}
</script>
