<?php
include_once('includes/connect.php');
//if it is submitted
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];
  // html special characters
  $name = htmlspecialchars($name);
  $email = htmlspecialchars($email);
  $subject = htmlspecialchars($subject);
  $message = htmlspecialchars($message);
  //escape string
  $name = mysqli_real_escape_string($con,$name);
  $email = mysqli_real_escape_string($con,$email);
  $subject = mysqli_real_escape_string($con,$subject);
  $message = mysqli_real_escape_string($con,$message);
// check for null
  if ($name && $email && $subject && $message) {
    $query = mysqli_query($con, "INSERT INTO contact VALUES(NULL,'$name','$email','$subject','$message')");
    if ($query==TRUE) {
       echo'<script>alert("Message Sent");</script>';
      // mysql_close($con);
    }
  }else{
    echo "something is missing";
  }

}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Contact Us</title>

		<meta name="description" content="A bloging application" />
		<meta name="author" content="Abdulhakim" />
		
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="/font-awesome/4.2.0/css/font-awesome.min.css" />
 		<style rel="stylesheet">
input#submit{
  margin-top: 10px;
  width: 560px;
}
    </style>
	</head>
	<body>
	<nav class="navbar navbar-inverse navbar-fixed ">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Siteevo.com</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav"> 
          <li><a href="index.php">Home</a></li> 
          <li class="active"><a href="blog.php">Blog</a></li> 
          <li><a href="about-us.php">About Us</a></li> 
          <li><a href="contact-us.php">Contact Us</a></li> 
         
        </ul> 
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	
    <!-- Main jumbotron for a primary marketing message or call to action -->
     

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-6">
          <h2>Location</h2>
          <p>Address: 27 avenue, houston </p>
          <p>State: Califonia</p>
        </div>
        <div class="col-md-6">
          <h2>Contact Us</h2>
          <h5>Fill in the following details</h5>
          <form action="" method="post">
            <label for="name">Name:</label><input type="text" name="name" required class="form-control" />
            <label for="email">Email:</label><input type="text" name="email" required class="form-control" />
            <label for="subject">Subject:</label><input type="text" name="subject" required class="form-control" />
            <label for="message">Message:</label><textarea type="text" name="message" required class="form-control"></textarea>
           <p><input id="submit" type="submit" class="btn btn-success" name="submit" class="form-control"/></p>
          </form>
       </div>
        
      </div>

      <hr>

      <footer>
        <p>&copy; 2016 Company, Inc.</p>
      </footer>
    </div> <!-- /container -->

	
		<script src="js/jquery.2.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
