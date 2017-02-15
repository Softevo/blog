<?php
include_once('./includes/init.php');
include_once('./includes/connect.php');


$query = mysqli_query($con,"SELECT * FROM posts");
$countOfPost = mysqli_num_rows($query);

$query =mysqli_query($con,"SELECT * FROM comments");
$countOfComments = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Admin</title>

		<meta name="description" content="A bloging application" />
		<meta name="author" content="Abdulhakim" />
		
		<link rel="stylesheet" href="css/style.css" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />
 		 <style>

#container{
	padding: 10px;
	width: 800px;
	margin: auto;
	margin-top: 100px;
}
#menu{
	height: 40px;
	line-height: 40px;
}
#menu ul{
	margin:0;
	padding:0;
}
#menu ul li{
	display: inline;
	list-style: none;
	margin-right: 10px;
	font-size: 18px;
}
#maincontent{
	clear:both;
	margin-top: 5px;
	font-size: 25px;
}
label{
	display: block
}

 		 </style>
	</head>

	<body class="">
		<div id="container">
			<?php include('menu.html');?>
			<div id="maincontent">
				<table>
					<tr>
						<td>Total Blog Post</td>
						<td><?php echo $countOfPost; ?></td>
					</tr>
						<tr>
						<td>Total Comments</td>
						<td><?php echo $countOfComments; ?></td>
					</tr>
				</table>
			</div>
		</div>



		<script src="js/jquery.2.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	<body>
</html>