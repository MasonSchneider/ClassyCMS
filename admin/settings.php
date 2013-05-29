<?php
	session_start();
	if(empty($_SESSION['priv']) || $_SESSION['priv'] != 99) {
			header('Location: index.php');
			exit;
	}
	require_once('constants.php');
?>
<!DOCTYPE html>
<html>

<head>
<title>Classy CMS Fields</title>
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">    
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		background: url(images/satinweave.png) repeat 0 0;
	}
</style>
</head>

<body>
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="panel.php">Classy CMS</a>
      <ul class="nav">
        <li><a href="panel.php"><i class="icon-home icon-white"></i> Home</a></li>
        <li><a href="#"><i class="icon-briefcase icon-white"></i> Pages</a></li>
        <li><a href="fields.php"><i class="icon-edit icon-white"></i> Fields</a></li>
        <li><a href="#"><i class="icon-folder-open icon-white"></i> Media</a></li>
        <li><a href="#"><i class="icon-user icon-white"></i> Users</a></li>
        <li class="active"><a href="settings.php"><i class="icon-wrench icon-white"></i> Settings</a></li>
        <li><a href="#"><i class="icon-plus-sign icon-white"></i> Extras</a></li>
        <li><a href="logout.php"><i class="icon-minus icon-white"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="container">
	<div class="row">
    	<div class="span3">
            <a href="#" onClick="alert('This is where you can edit your installed settings.'); return false;" class="thumbnail">
                <img alt="Classy CMS" style="width:300px; height:200px;" src="images/Settings.png">
            </a>
        </div>
        <div class="span8 offset1">
            <br />
            <br />
            <a href="dbSettings.php" class="btn btn-large btn-block btn-primary">Change Database Settings</a>
            <br />
            <br />
            <a href="adminSettings.php" class="btn btn-large btn-block btn-primary">Change Administrator Password</a>
        </div>
    </div>
</div>
</body>

</html>