<?php
	session_start();
	if(empty($_SESSION['priv']) || $_SESSION['priv'] != 99) {
			header('Location: index.php');
			exit;
	}
?>
<!DOCTYPE html>
<html>

<head>
<title>Classy CMS Panel</title>
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
        <li class="active"><a href="panel.php"><i class="icon-home icon-white"></i> Home</a></li>
        <li><a href="pages.php"><i class="icon-briefcase icon-white"></i> Pages</a></li>
        <li><a href="fields.php"><i class="icon-edit icon-white"></i> Fields</a></li>
        <li><a href="#"><i class="icon-folder-open icon-white"></i> Media</a></li>
        <li><a href="#"><i class="icon-user icon-white"></i> Users</a></li>
        <li><a href="settings.php"><i class="icon-wrench icon-white"></i> Settings</a></li>
        <li><a href="#"><i class="icon-plus-sign icon-white"></i> Extras</a></li>
        <li><a href="logout.php"><i class="icon-minus icon-white"></i> Logout</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="container">
	<div class="row">
        <ul class="thumbnails">
            <li class="span12">
                <a href="#" onClick="alert('This is Classy CMS!'); return false;" class="thumbnail">
                    <img alt="Classy CMS" style="width:900px; height:300px;" src="images/ClassySplash.png">
                </a>
            </li>
        </ul>
    </div>
	<div class="row">
        <ul class="thumbnails">
            <li class="span4">
                <a href="pages.php" class="thumbnail">
                    <img alt="Pages" style="width:300px; height:200px;" src="images/Pages.png">
                </a>
            </li>
            <li class="span4">
                <a href="fields.php" class="thumbnail">
                    <img alt="Fields" style="width:300px; height:200px;" src="images/Fields.png">
                </a>
            </li>
            <li class="span4">
                <a href="#" onClick="alert('This feature is not available in beta.'); return false;" class="thumbnail">
                    <img alt="Media" style="width:300px; height:200px;" src="images/Media.png">
                </a>
            </li>
        </ul>
	</div>
    <div class="row">
        <ul class="thumbnails">
            <li class="span4">
                <a href="#" onClick="alert('This feature is only available in the business edition.'); return false;" class="thumbnail">
                    <img alt="Users" style="width:300px; height:200px;" src="images/Users.png">
                </a>
            </li>
            <li class="span4">
                <a href="settings.php" class="thumbnail">
                    <img alt="Settings" style="width:300px; height:200px;" src="images/Settings.png">
                </a>
            </li>
            <li class="span4">
                <a href="#" onClick="alert('This feature is only available in the business edition.'); return false;" class="thumbnail">
                    <img alt="Extras" style="width:300px; height:200px;" src="images/Extras.png">
                </a>
            </li>
        </ul>
	</div>
</div>
</body>

</html>