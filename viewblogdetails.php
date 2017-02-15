<?php
//left(column,no);
include_once('includes/connect.php');
if (!isset($_GET['id'])) {
	header('location:blog.php');
}else{
	$id = $_GET['id'];
}
$stm = "SELECT posts.post_id AS post_id, posts.title AS title, posts.body as body, categories.category as category,
		posts.posted as posted FROM posts INNER JOIN categories ON categories.category_id=posts.category_id WHERE posts.post_id='$id'";
$query = mysqli_query($con, $stm);

if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$comment = $_POST['comment'];
	// secure data
	$name = htmlspecialchars($name);
	$email = htmlspecialchars($email);
	$comment = htmlspecialchars($comment);
	// real escape
	$name = mysqli_real_escape_string($con, $name);
	$email = mysqli_real_escape_string($con, $email);
	$comment = mysqli_real_escape_string($con, $comment);

	// prepare statement
	$queryComment = mysqli_query($con,"INSERT INTO comments (post_id, name, email, comment,date_posted) VALUES ('$id','$name','$email','$comment',NOW())");
	if ($queryComment===TRUE) {
		echo'<script>alert("Comment Added, Thank you for commenting");</script>';
	}else{
		echo "Unable to add comment";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Posts</title>

		<meta name="description" content="A bloging application" />
		<meta name="author" content="Abdulhakim" />
		
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="css/style.css" />
 	<style rel="stylesheet">

input#comment-btn{
	margin-top: 10px;
}
blockquote#block-comment{
	font-size: 15px;
}
 	</style>	 
	</head>
	<?php include_once('navbar_admin.html');?>

	<body class="">
		<div id="container">
			<div class="row">
				<div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-2">
					<?php while ( $row= mysqli_fetch_assoc($query)){
						//lastchar = strpos($col, ''); echo substr($col,0,$lastchar).linkid
								$post_id = $row['post_id'];
								echo '<h2 class="blog-title">'.$row['title'].'</h2>';
									
								echo '<p id="body">'.$row['body'].'</p>';

								echo '<p>'.$row['category'].' <span> <b>Date posted:</b> '.$row['posted'].'</span> </p>';
								echo '<hr />';
								
						} 
						echo "<h2>Comments</h2>";
						$query = mysqli_query($con, "SELECT * FROM comments WHERE post_id='$post_id'");
						while ($row = mysqli_fetch_assoc($query)) {
							echo'<h5>Name: '.$row['name'].'</h5>
							<blockquote id="block-comment">'.$row['comment'].'</blockquote>
							<p>Date Posted: '.$row['date_posted'].'</p>';
						}
					?>
					<hr />
					<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
										<label for="name">Name: </label><input type="text" class="form-control" style="width:230px;" name="name" />
										<label for="email">Email: </label><input type="email" class="form-control" style="width:230px;" name="email" />
										<label for="comment">Comment</label><textarea name="comment" class="form-control" style="width:230px;"></textarea>
										<p><input type="submit" id="comment-btn" class="btn btn-success" name="submit" value="Add Comment" /></p>
									</form>
				</div>
			</div>
			
		</div>



		<script src="js/jquery.2.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	<body>
</html>