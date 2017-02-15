<?php
//left(column,no);
include_once('includes/init.php');
include_once('includes/connect.php');

$queryCat = mysqli_query($con,"SELECT * FROM categories");
$user_id =$_SESSION['user_id'];
if (isset($_POST['submit'])) {
		//if submitted
	//store values in variables
	$title = $_POST['title'];
	$body = $_POST['body'];
	$category = $_POST['category'];
	
	if ($_FILES['image']['tmp_name']=='') {
		//escape string
		$title= htmlspecialchars($title);
		$body= htmlspecialchars($body);
		$category= htmlspecialchars($category);

		$title = mysqli_real_escape_string($con,$title);
		$body = mysqli_real_escape_string($con,$body);
		$category = mysqli_real_escape_string($con,$category);
		//format html tags as string

		$body = htmlentities($body);
		//user id logged in
		


		//if all variable contain values
		if ($title && $body && $category) {
			
			// insert data into database
			$query = mysqli_query($con,"INSERT INTO posts (title,body, category_id,posted, user_id)
						VALUES('$title','$body','$category',NOW(),'$user_id')");

			if ($query==TRUE) {
				//if query is inserted 
				 echo'<script>alert("Blog post Created");</script>';
			}else{
				//if query is not inserted 
				 echo'<script>alert("Unable to create post");</script>';
				
			}
		}else{
			// if varibles do not contain values
			echo "Something is missing";
		}
	}else{
		if (getimagesize($_FILES['image']['tmp_name'])==FALSE) {
			echo'<script>alert("Please enter a valid image");</script>';
		}else{
			$image = addslashes($_FILES['image']['tmp_name']);
			$image_name = addslashes($_FILES['image']['name']);
		    $image_size = $_FILES['image']['size'];
			$image= file_get_contents($image);
			$image= base64_encode($image);

			if ($image_size>32200) {
				//if image size is bigger 
				echo'<script>alert("Image size is bigger. Please choose an image less than 30kb");</script>';
			}else{
					//escape string
					$title= htmlspecialchars($title);
					$body= htmlspecialchars($body);
					$category= htmlspecialchars($category);

					$title = mysqli_real_escape_string($con,$title);
					$body = mysqli_real_escape_string($con,$body);
					$category = mysqli_real_escape_string($con,$category);
					//format html tags as string

					$body = htmlentities($body);
					//user id logged in
					

					//if all variable contain values
					if ($title && $body && $category) {
						
						// insert data into database
						$query = mysqli_query($con,"INSERT INTO posts (title,body, category_id,posted,image_name,image, user_id)
									VALUES('$title','$body','$category',NOW(),'$image_name','$image','$user_id')");

						if ($query==TRUE) {
							//if query is inserted 
							 echo'<script>alert("Blog post Created");</script>';
						}else{
							//if query is not inserted 
							 echo'<script>alert("Unable to create post");</script>';
							
						}
					}else{
						// if varibles do not contain values
						echo "Something is missing";
					}
			}
		}
	}
			

	
		
		
}	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Create Post</title>

		<meta name="description" content="A bloging application" />
		<meta name="author" content="Abdulhakim" />
		
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="/font-awesome/4.2.0/css/font-awesome.min.css" />
 		 <script src="sweetalert/dist/jquery-2.1.3.min.js"></script>
  
      <!-- SweetAlert -->
       <script src="sweetalert/dist/sweet-alert.min.js"></script>
        <script src="sweetalert/dist/sweetalert-dev.js"></script>
    <script src="sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="sweetalert/dist/sweetalert.css">
    

	</head>
	<body>
	<?php include_once('navbar_admin.html');?>
	
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
       
      </div>
    </div>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-8 col-sm-offset-2">
          <form action="" method="post" class="form" enctype="multipart/form-data">
					<p><label>Title:</label> <input type="text" required class="form-control" name="title" style="width:750px;"></p>

					<p><label for="body">Body:</label>
					<textarea name="body" cols=23 rows=10 class="form-control" required></textarea></p>
					<select name="category" class="form-control" style="width:200px;">
						<?php
						while ($row = mysqli_fetch_assoc($queryCat)) {
							echo '<option value="'.$row['category_id'].'">'.$row['category'].'</option>';
						}
						?>
						
					</select>
					<label for="image"><input type="file" name="image" style="margin-top:10px" class="form-image" /></label>
					<p><input type="submit" value="Create post" class="btn btn-success" style="margin-top:10px" name="submit"></p>
				</form>
        </div>
       
      </div>

      <hr>

      
    </div> <!-- /container -->
    <footer>
        <p>&copy; 2016 Company, Inc.</p>
      </footer>
  </div>
	
		<script src="js/jquery.2.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>