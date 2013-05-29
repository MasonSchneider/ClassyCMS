<?php
	
	session_start();
	if(empty($_SESSION['priv']) || $_SESSION['priv'] != 99) {
			header('Location: index.php');
			exit;
	}
	require_once('constants.php');

	if(isset($_POST['submit'])) {
		
		$pass = sha1($_POST['pass']);
		
		if(empty($pass)) {
			
		} else {
			$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
			$check = $db->prepare("UPDATE classyUsers SET password=? WHERE priv=99");
			$check->execute(array($pass));
			
			header("Location: logout.php");
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
					if(empty($pass)) {
						echo 'Please enter values for all fields.';
					}				
				}
			?>
            <form action="adminSettings.php" method="post">
            <legend>Classy CMS Settings :<br>Change Password</legend>
            <div class="control-group">
                <label class="control-label" for="pass">Password: </label>
                <div class="controls">
                	<input type="password" name="pass" class="input-block-level" id="pass" placeholder="Password">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="submit" class="btn btn-primary">Update Account</button> <a href="settings.php" class="btn">Cancel</a>
                </div>
            </div>
            </form>
</div>
</body>

</html>