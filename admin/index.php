<?php
	session_start();
	if(isset($_SESSION['priv']) && $_SESSION['priv'] == 99) {
			header('Location: panel.php');
			exit;
	}
	if(isset($_POST['submit'])) {
		require_once("constants.php");
		
		$user = $_POST['user'];
		$pass = sha1($_POST['pass']);
		
		if(empty($user) || empty($pass)) {
			$error = '<span class="label label-important">Please enter values for all fields.</span>';
		} else {
			$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
			$prep = $db->prepare("SELECT * FROM classyUsers WHERE username = ? AND password = ?");
			$prep->execute(array($user,$pass));
			if($prep->rowCount() == 1) { // Login succesful
				$account = $prep->fetch(PDO::FETCH_BOTH);
				if($account['priv'] != 99) {
					header('Location: ../');
					exit;
				}
				$_SESSION['priv'] = $account['priv'];
				$_SESSION['user'] = $account['username'];
				header("Location: panel.php");
				exit;
			} else {
				$error = '<span class="label label-important">Failed to login, account not found.</span>';
			}
		}					
	}
?>
<!DOCTYPE html>
<html>

<head>
<title>Classy CMS Login</title>
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
      .form-signin .form-signin-heading,
      .form-signin .checkbox {
        margin-bottom: 10px;
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
					echo $error;					
				}
			?>
            <form action="index.php" method="post">
            <legend><h2 class="form-signin-heading">Classy CMS Login</h2></legend>
           
                	<input type="text" name="user" class="input-block-level" id="user" placeholder="Username">
                
                	<input type="password" name="pass" class="input-block-level" id="pass" placeholder="Password">
             
                    <button type="submit" name="submit" class="btn btn-primary">Login</button>
        
            </form>
</div>
</body>

</html>