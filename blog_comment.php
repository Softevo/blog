<?php
//left(column,no);
include_once('includes/init.php');
include_once('includes/connect.php');
/*
$query_cout = mysqli_query($con, "SELECT * FROM posts");
$count = mysqli_num_rows($query_cout);

$per_page =2;
// number of pages
$pages = ceil($count/$per_page);

if (isset($_GET['p']) && is_numeric($_GET['p'])) {
  $page = $_GET['p'];
}else{
  $page =1;
}

if ($page<=0) {
  $start = 0;
}else{
  $start = $page * $per_page - $per_page;
}

$prev = $page-1;
$next = $page +1;
/*$per_page = 1;
$pages = ceil($count/$per_page);
if (isset($_GET['p']) && is_numeric($_GET['p'])) {
  $page =$_GET['p'];
}else{
  $page = 1;
}
if ($page<=0) {
  $start = 0;
}else{
  $start = $page * $per_page - $per_page;
}
$prev = $page - 1;LIMIT $start, $per_page
$next = $page +1;
<?php
             if ($page < $pages) {
              echo '<a href="blog.php?p='.$next.'"><button class="btn btn-default">Next</button></a>';
             }
             if ($prev > 0 ) {
              echo '<a href="blog.php?p='.$prev.'">Prev</a>';
             } 

            ?>
*/
if (isset($_GET['comment'])) {
  $comment = $_GET['comment'];
  if ($comment=='deleted') {
    echo'<script>alert("Comment Deleted");</script>';
  }
}
if (isset($_GET['id'])) {
  $blog_id = $_GET['id'];
}
$query = mysqli_query($con, "SELECT * FROM comments WHERE post_id ='$blog_id'");


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>View comments</title>

		<meta name="description" content="A bloging application" />
		<meta name="author" content="Abdulhakim" />
		
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="/font-awesome/4.2.0/css/font-awesome.min.css" />
 		 
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
          <h2>Comments</h2>
          <?php while ( $row= mysqli_fetch_assoc($query)){
            //lastchar = strpos($col, ''); echo substr($col,0,$lastchar).linkid
               $comment_id = $row['comment_id'];

              echo'<div class="form-group"><h5>Name: '.$row['name'].'</h5>
              <blockquote id="block-comment">'.$row['comment'].'</blockquote>
              <p>Date Posted: '.$row['date_posted'].'</p>';
              echo '<div class="pull-right"><a href="deletecomment.php?id='.$comment_id.'&blog='.$blog_id.'"><button class="btn btn-danger">Delete</button></a></div> </div>';
            }
            
            
          ?>
          <div class="pull-right">
           
        </div>
       
      </div>

      <hr>

      
    </div> <!-- /container -->

	
		<script src="js/jquery.2.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>