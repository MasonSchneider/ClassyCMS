<?php
	session_start();
	if(empty($_SESSION['priv']) || $_SESSION['priv'] != 99) {
			header('Location: index.php');
			exit;
	}
	
	require_once('constants.php');
	$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
	
	if(isset($_POST['submit'])) {
		$name = $_POST['name'];
		$content = $_POST['content'];
		$id = $_POST['id'];
		
		if(!empty($content) && !empty($name) && !empty($id)) {
			if(!preg_match('/\s/',$name)) {
				$exist = $db->prepare("SELECT * FROM classyFields WHERE name=?");
				$exist->execute(array($name));
				$row = $exist->fetch(PDO::FETCH_BOTH);
				if($exist->rowCount() == 0 || $row['id'] == $id) {
					$insert = $db->prepare("UPDATE classyFields SET name=?, content=? WHERE id=?");
					$insert->execute(array($name, $content, $id));
					header("Location: fields.php");
					exit;
				} else {
					$error = '<span class="label label-important">This field name already exists, please try again.</span>';
				}
			} else {
				$error = '<span class="label label-important">There can not be spaces in the name.</span>';
			}
		} else {
			$error = '<span class="label label-important">All areas were not completed.</span>';	
		}
	} else if(isset($_GET['id'])) {
		$old = $db->prepare("SELECT * FROM classyFields WHERE id = ?");
		$old->execute(array($_GET['id']));
		$old = $old->fetch(PDO::FETCH_BOTH);
		$name = $old['name'];
		$id = $old['id'];
		$content = $old['content'];
	} else {
		header('Location: fields.php');
		exit;
	}
?>
<!DOCTYPE html>
<html>

<head>
<title>Classy CMS Edit Content</title>
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
<script type="text/javascript" src="tinymce/tinymce.min.js"></script>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    theme: "modern",
	forced_root_block : false,
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons paste"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media | forecolor backcolor emoticons",
    image_advtab: true
});
</script>



</head>

<body>
<div class="navbar navbar-fixed-top navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
      <a class="brand" href="panel.php">Classy CMS</a>
      <ul class="nav">
        <li><a href="panel.php"><i class="icon-home icon-white"></i> Home</a></li>
        <li><a href="#"><i class="icon-briefcase icon-white"></i> Pages</a></li>
        <li class="active"><a href="fields.php"><i class="icon-edit icon-white"></i> Fields</a></li>
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
<form action="editContent.php" method="post">
<input type="hidden" name="id" value="<?php if(isset($id)) echo $id; ?>">
	<legend><h1>New Field</h1></legend> 
    <?php if(isset($error)) echo $error; ?>
	<div class="row">
        <div style="text-align:center" class="span12">
			<input maxlength="50" type="text" placeholder="Field Name" name="name" id="name" value="<?php if(isset($name)) echo $name; ?>">
        </div>
    </div>
    <div class="row">
    	<div class="span12">
            <textarea id="content" rows="20" name="content"><?php if(isset($content)) echo $content; ?></textarea><br />
        </div>
    </div>
    <div class="row">
    	<div style="text-align:center" class="span12">
            <button type="submit" name="submit" class="btn btn-large btn-primary">Save</button> <a href="fields.php" class="btn btn-large">Cancel</a>
        </div>
    </div>
</form>
</div>
</body>

</html>