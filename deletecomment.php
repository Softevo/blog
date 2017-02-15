<?php
include_once('includes/init.php');
if (isset($_GET['id']) && isset($_GET['blog'])) {
	$id = $_GET['id'];
	$blog = $_GET['blog'];
	include_once('includes/connect.php');
	$query = mysqli_query($con,"DELETE FROM comments WHERE comment_id='$id'");
	// check for query
	if ($query==TRUE) {
		header('location:blog_comment.php?id='.$blog.'&comment=deleted');
	}
}

?>