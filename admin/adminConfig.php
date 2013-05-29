<?php
	if(isset($_POST['submit'])) {
		require_once("constants.php");
		
		$user = $_POST['user'];
		$pass = sha1($_POST['pass']);
		$email = $_POST['email'];
		
		if(empty($user) || empty($pass) || empty($email)) {
			
		} else {
			$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
			$prep = $db->prepare("INSERT INTO classyUsers (username, password, email, priv) VALUES (?,?,?,99)");
			$prep->execute(array($user,$pass,$email));
			header("Location: cleanup.php");
			exit;
		}					
	}
?>
<!DOCTYPE html>
<html>

<head>
<title>Classy CMS Installer</title>
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">    
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		background-color: #f5f5f5;
	}
	.form-signin {
        max-width: 300px;
        padding: 19px 29px 29px;
        margin: 0 auto 20px;
        background-color: #fff;
        border: 1px solid #e5e5e5;
        -webkit-border-radius: 5px;
           -moz-border-radius: 5px;
                border-radius: 5px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      }
	  .form-signin input[type="text"],
      .form-signin input[type="password"] {
        font-size: 16px;
        height: auto;
        margin-bottom: 15px;
        padding: 7px 9px;
      }
</style>
</head>

<body>

<div class="container form-signin">
        	<?php
				if(isset($_POST['submit'])) {
					if(empty($user) || empty($pass) || empty($email)) {
						echo 'Please enter values for all fields.';
					}				
				}
			?>
            <form action="adminConfig.php" method="post">
            <legend>Classy CMS Installer :<br>Administrator Account Creation</legend>
            <div class="control-group">
                <label class="control-label" for="user">Username: </label>
                <div class="controls">
                	<input type="text" name="user" class="input-block-level" id="user" placeholder="Username">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="pass">Password: </label>
                <div class="controls">
                	<input type="password" name="pass" class="input-block-level" id="pass" placeholder="Password">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="email">Email: </label>
                <div class="controls">
              	  <input type="email" name="email" id="email" class="input-block-level" placeholder="Email">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="submit" class="btn btn-primary">Create Account</button>
                </div>
            </div>
            </form>
</div>
</body>

</html>