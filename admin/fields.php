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
	<div class="row">
    	<div class="span3">
            <a href="#" onClick="alert('These fields hold your website\'s content.'); return false;" class="thumbnail">
                <img alt="Classy CMS" style="width:300px; height:200px;" src="images/Fields.png">
            </a>
        </div>
        <div class="span8 offset1">
            <br />
            <br />
            <div class="btn-group">
                <a href="newField.php?type=1" class="btn btn-large btn-success span3">New Field</a>
                <button class="btn dropdown-toggle btn-large btn-success" data-toggle="dropdown">
                <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li><a tabindex="-1" href="newField.php?type=1">Content</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Title</a></li>
                    <li class="disabled"><a tabindex="-1" href="#">Media</a></li>
                </ul>
            </div>
            <br />
            <br />
            <div class="btn-group"><a href="#info" data-toggle="modal" class="btn btn-large span4 btn-info">Information about using fields</a></div>
            <div id="info" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 id="myModalLabel">Field Info</h3>
                    </div>
                    <div class="modal-body">
                    <p>Fields are used on your website to display content. <br />Add classy-field-"FIELD NAME" to the class of an html element and classy will fill that element with the field you've named!</p>
                    </div>
                    <div class="modal-footer">
                    <button class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <br />
    <div class="row">
    	<div class="span12">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th style="text-align:center"></th>
                        <th style="text-align:center">Name</th>
                        <th style="text-align:center">Type</th>
                      <th style="text-align:center">Value Preview</th>
                        <th style="text-align:center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
						$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
						$all = $db->prepare("SELECT * FROM classyFields ORDER BY id ASC");
						$all->execute();
						$i = 1;
						if($all->rowCount() > 0) {
							$allRows = $all->fetchAll(PDO::FETCH_BOTH);
							foreach($allRows as $row) {
								print '<tr>';
								print '<td style="text-align:center">'.$i.'</td>';
								$i++;
                       			print '<td style="text-align:center">'.$row['name'].'</td>';
								switch($row['type']) {
									case 1:
										print '<td style="text-align:center">Content</td>';
										break;
									case 2:
										print '<td style="text-align:center">Title</td>';
										break;
									case 3:
										print '<td style="text-align:center">Media</td>';
										break;
								}
                        		print '<td style="text-align:center">'.substr(htmlspecialchars($row['content']),0,100).'</td>';
								print '<td style="text-align:center"><a href="editField.php?id='.$row['id'].'&type='.$row['type'].'"><i class="icon-edit"></i></a> | <a   onClick="var y = confirm(\'You are about to delete the field '.$row['name'].'.\'); if(y == true) return true; else return false; " href="deleteField.php?id='.$row['id'].'"><i class="icon-remove"></i></a></td>';
								print '</tr>';
							}
						}
					?>
            	</tbody>
   		  </table>
        </div>
    </div>
</div>
</body>

</html>