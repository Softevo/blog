<?php
include_once('includes/init.php');
include_once('includes/connect.php');
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	//prepare stmt
	$query = $db->query("DELETE FROM posts WHERE post_id='$id'");
	if ($query) {
		header('location:deletepost.php?action=deleted');
	}else{
		header('location:deletepost.php?action=error');
	}
}

?>