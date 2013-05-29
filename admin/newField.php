<?php 
	session_start();
	if(empty($_SESSION['priv']) || $_SESSION['priv'] != 99) {
			header('Location: index.php');
			exit;
	}
	if(isset($_GET['type'])) {
		switch($_GET['type']) {
			case 1:
				header("Location: newContent.php");
				exit;
				break;
			case 2:
				header("Location: newTitle.php");
				exit;
				break;
			case 3:
				header("Location: newMedia.php");
				exit;
				break;
			default:
				header("Location: newContent.php");
				exit;
		}
	} else {
			header("Location: newContent.php");
			exit;
	}
?>