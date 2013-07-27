<?php
	session_start();
	if(empty($_SESSION['priv']) || $_SESSION['priv'] != 99) {
			header('Location: index.php');
			exit;
	}
    require_once('constants.php');
	if(isset($_POST['submit'])) {
		$name = $_POST['name'];
		$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
	}
?>
<!DOCTYPE html>
<html>

<head>
<title>Classy CMS New Page</title>
<!-- Bootstrap -->
<link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">    
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
    window.onload=function(){
        $("tr").click(function(e) {
            if (e.target.type == "checkbox") {
                e.stopPropagation();
            } else {
                var $checkbox = $(this).find(':checkbox');
                $checkbox.trigger('click');
            }
        });

        var $cells = $("td");

        $("#search").keyup(function() {
            var val = $.trim(this.value).toUpperCase();
            if (val === "")
                $cells.parent().show();
            else {
                $cells.parent().hide();
                $cells.filter(function() {
                    return -1 != $(this).text().toUpperCase().indexOf(val); }).parent().show();
            }
        });
    }
</script>
<style>
	body {
		padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
		background: url(images/satinweave.png) repeat 0 0;
	}
    .field-search{
        background-color: #FFFFFF;
        border: 1px solid #DDDDDD;
        border-radius: 4px 4px 4px 4px;
        margin: 15px 0;
        padding: 39px 19px 14px;
        position: relative;
    }
    .field-search:after {
        background-color: #F5F5F5;
        border: 1px solid #DDDDDD;
        border-radius: 4px 0 4px 0;
        color: #9DA0A4;
        content: "Fields";
        font-size: 12px;
        font-weight: bold;
        left: -1px;
        padding: 3px 7px;
        position: absolute;
        top: -1px;
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
        <li class="active"><a href="pages.php"><i class="icon-briefcase icon-white"></i> Pages</a></li>
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
<form action="newPage.php" method="post">
	<legend><h1>New Page</h1></legend> 
    <?php if(isset($error)) echo $error; ?>
	<div class="row">
        <div style="text-align:center" class="span12">
			<input maxlength="50" type="text" placeholder="Page Name" name="name" id="name" value="<?php if(isset($name)) echo $name; ?>">
        </div>
    </div>
    <div class="row">
    	<div class="offset1 span10">
            <div class="field-search" style="overflow:auto; max-height:500px">
                <input maxlength="50" type="text" placeholder="Search..." name="search" id="search">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th style="text-align:center">Select</th>
                            <th style="text-align:center">Field</th>
                            <th style="text-align:center">Type</th>
                            <th style="text-align:center">Preview</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
                            $all = $db->prepare("SELECT * FROM classyFields ORDER BY id ASC");
                            $all->execute();
                            
                            if($all->rowCount() > 0) {
                                $allRows = $all->fetchAll(PDO::FETCH_BOTH);
                                foreach($allRows as $row) {
                                    print '<tr>';
                                    print '<td style="text-align:center"><input type="checkbox" name="fields" value="'.$row['id'].'"></td>';
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
                                    print '<td style="text-align:center">'.substr(htmlspecialchars($row['content']),0,50).'</td>';
                                    print '</tr>';
                                }
                            }
                        ?>
                    </tbody>
              </table>
          </div>
        </div>
    </div>
    <div class="row">
    	<div style="text-align:center" class="span12">
            <button type="submit" name="submit" class="btn btn-large btn-primary">Create</button> <a href="pages.php" class="btn btn-large">Cancel</a>
        </div>
    </div>
</form>
</div>
</body>

</html>