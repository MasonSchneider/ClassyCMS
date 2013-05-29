<?php 
	session_start();
	if(empty($_SESSION['priv']) || $_SESSION['priv'] != 99) {
			header('Location: index.php');
			exit;
	}
	if(isset($_GET['id']) && isset($_GET['type'])) {
		
		$id = $_GET['id'];
		
		switch($_GET['type']) {
			case 1:
				header("Location: editContent.php?id=$id");
				exit;
				break;
			case 2:
				header("Location: editTitle.php?id=$id");
				exit;
				break;
			case 3:
				header("Location: editMedia.php?id=$id");
				exit;
				break;
			default:
				header("Location: editContent.php?id=$id");
				exit;
		}
	} else {
			header("Location: fields.php");
			exit;
	}
?>