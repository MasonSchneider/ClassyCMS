<?php
	session_start();
	if(empty($_SESSION['priv']) || $_SESSION['priv'] != 99) {
			header('Location: index.php');
			exit;
	}
	require_once('constants.php');
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		$db = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
		$prep = $db->prepare("DELETE FROM classyPages WHERE id = ?");
		$prep->execute(array($id));
		if($prep->rowCount() <= 0) {
			die("Error occured during deletion.");	
		}
	}
	header("Location: pages.php");
	exit;
?>