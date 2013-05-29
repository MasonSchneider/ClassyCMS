<?php
	unlink("installer.php");
	unlink("adminConfig.php");
	header("Location: index.php");
	exit;
?>