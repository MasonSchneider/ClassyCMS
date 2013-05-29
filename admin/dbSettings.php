<?php
	session_start();
	if(empty($_SESSION['priv']) || $_SESSION['priv'] != 99) {
			header('Location: index.php');
			exit;
	}
	require_once('constants.php');
	
	if(isset($_POST['submit'])) {
		$dbHost = $_POST['dbHost'];
		$dbName = $_POST['dbName'];
		$dbUser = $_POST['dbUser'];
		$dbPass = $_POST['dbPass'];
		if(empty($dbName) || empty($dbPass) || empty($dbUser) || empty($dbHost)) {
			
		} else {
			try{
				// Check if info is correct
				$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
				
				// Store info
				$myFile = "constants.php";
				unlink($myFile);
				$fh = fopen($myFile, 'w') or die("FAILED TO STORE CONSTANTS");
				$stringData = "<?php\n";
				fwrite($fh, $stringData);
				$stringData = '$dbHost = "'.$dbHost."\";\n";
				fwrite($fh, $stringData);
				$stringData = '$dbName = "'.$dbName."\";\n";
				fwrite($fh, $stringData);
				$stringData = '$dbUser = "'.$dbUser."\";\n";
				fwrite($fh, $stringData);
				$stringData = '$dbPass = "'.$dbPass."\";\n";
				fwrite($fh, $stringData);
				$stringData = "?>\n";
				fwrite($fh, $stringData);
				fclose($fh);
				
				// Create Tables
				$db->exec('CREATE TABLE `classyUsers` (`id` INT NOT NULL AUTO_INCREMENT ,`username` VARCHAR( 50 ) NOT NULL ,`password` VARCHAR( 50 ) NOT NULL ,`email` VARCHAR( 50 ) NOT NULL ,`priv` INT NOT NULL ,PRIMARY KEY ( `id` ))');
				$db->exec('CREATE TABLE `classyFields` (`id` INT NOT NULL AUTO_INCREMENT ,`name` VARCHAR( 50 ) NOT NULL ,`type` INT NOT NULL ,`content` TEXT NOT NULL ,PRIMARY KEY ( `id` ))');
				
				header('Location: settings.php');
				exit;
				
			} catch (Exception $e) {
				
			}
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
					if(empty($dbName) || empty($dbPass) || empty($dbUser) || empty($dbHost)) {
						echo '<span class="label label-important">Please enter values for all fields.</span>';
					} else {
						try{
							// Check if info is correct
							$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
							
						} catch (Exception $e) {
							echo '<span class="label label-important">Failed to connect to database: ' . $e->getMessage() . '</span>';
						}
					}
				}
			?>
            <form  action="dbSettings.php" method="post">
            <legend>Classy CMS Settings : <br>Database Configuration</legend>
            <div class="control-group">
                <label class="control-label" for="dbHost">Database Host: </label>
                <div class="controls">
                	<input type="text" name="dbHost" class="input-block-level" id="dbHost" placeholder="localhost" value="<?php echo $dbHost ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="dbName">Database Name: </label>
                <div class="controls">
                	<input type="text" name="dbName" class="input-block-level" id="dbName" placeholder="Database" value="<?php echo $dbName ?>">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="dbUser">Username: </label>
                <div class="controls">
              	  <input type="text" name="dbUser" class="input-block-level" id="dbUser" placeholder="Username" value="<?php echo $dbUser ?>">
                </div>
            </div>
             <div class="control-group">
                <label class="control-label" for="dbPass">Password: </label>
                <div class="controls">
              	  <input type="password" name="dbPass" class="input-block-level" id="dbPass" placeholder="Password" value="<?php echo $dbPass ?>">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="submit" class="btn btn-primary">Change</button> <a href="settings.php" class="btn">Cancel</a>
                </div>
            </div>
            </form>
</div>
</body>

</html>