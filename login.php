<?php
session_start();
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	// connect to db
	include('includes/connect.php');
	// stripslashes
	$username = stripcslashes($username);
	$password = stripcslashes($password);
	//espace string
	$username = mysqli_real_escape_string($con, $username);
	$password = mysqli_real_escape_string($con, $password);
	//hash password
	$password = md5($password);

	$query = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password'");
	$count = mysqli_num_rows($query);
	if ($count==1) {
		while ($row=mysqli_fetch_assoc($query)) {
			$user_type= $row['user_type'];
			if ($user_type!='admin') {
				echo "Not admin";
			}else{
				$_SESSION['user_id']= $row['user_id'];
				$_SESSION['username']= $row['username'];
				$_SESSION['user_type']= $row['user_type'];
				if ($_SESSION['user_type']=='admin') {
					header('location:admin.php');
				}else{
					header('location:logout.php');
				}
				
			}
			exit();
			/*
			$_SESSION['user_id']= $row['user_id'];
			$row['username']= $_SESSION['username'];
			$_SESSION['user_type']= $row['user_type'];
			*/
			
		}
		$_SESSION['username'] = $username;
		header('location:admin.php');
	}else{
		header('location:login.php?msg=invaliduser');
	}


}


?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>My Blog</title>

		<meta name="description" content="A bloging application" />
		<meta name="author" content="Abdulhakim" />
		
		<link rel="stylesheet" href="css/style.css" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="assets/font-awesome/4.2.0/css/font-awesome.min.css" />

 		 
 		 <style>
.parent .popup {
  display: none;
}

.parent:hover .popup {
  display: block;
}

#container{
	padding: 10px;
	width: 500px;
	margin: auto;
	margin-top: 100px;
}

 		 </style>

	</head>

	<body class="">
		<div id="container">
			<div>
				<?php 
if (isset($_GET['msg'])) {
	$msg = $_GET['msg'];
	if ($msg=='invaliduser') {
		echo "Username or password incorrect";
	}elseif ($msg=='notloggedin') {
		echo "You need to login first";
	}elseif ($msg=='logout') {
		echo "You have been logged out";
	}
}

				?>
			</div>
			<h3>Enter you details to login</h3>
			<form action="" method="post">
				<p><label>Username:</label> <input type="text" name="username" ></p>
				<p><label>Password: <input type="password" name="password"></label></p>
				<p><input type="submit" name="submit" value="login"></p>
			</form> 
		</div>


		<script src="js/jquery.2.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	<body>
</html>