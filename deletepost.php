<?php
//left(column,no);
include_once('includes/init.php');
include_once('includes/connect.php');
if (isset($_GET['action'])) {
  $action= $_GET['action'];
  if ($action=='deleted') {
     echo'<script>alert("Blog post Deleted");</script>';
  }else{
     echo'<script>alert("Error. Unable ton delete");</script>';
  }
}
$query_cout = mysqli_query($con, "SELECT * FROM posts");
$count = mysqli_num_rows($query_cout);

$per_page =4;
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
$stm = "SELECT posts.post_id AS post_id, posts.title AS title, LEFT(posts.body, 400) as body, categories.category as category,
    posts.posted as posted FROM posts INNER JOIN categories ON categories.category_id=posts.category_id 
    ORDER BY posts.post_id DESC LIMIT $start, $per_page";
$query = mysqli_query($con, $stm);


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Delete Post</title>

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
          <?php while ( $row= mysqli_fetch_assoc($query)){
            //lastchar = strpos($col, ''); echo substr($col,0,$lastchar).linkid

                $id = $row['post_id'];
                echo '<h2 style="margin-top:40px;">'.$row['title'].'</h2>';
                  $body = $row['body'];
                  $lastpos = stripos($body, '');
                echo '<p>'.substr($body, $lastpos).'<a href="viewblogdetails.php?id='.$id.'">...View more</a> </p>';

                echo '<p>'.$row['category'].' <span> <b>Date posted:</b> '.$row['posted'].'</span> </p>';
                
                echo '<a href="deleteblobpost.php?id='.$id.'"><button class="btn btn-danger">Delete blog post</button></a>';
            }
            
            
          ?>
          <div class="pull-right">
            <?php
            if ($prev>0) {
              echo '<a href="viewcomments.php?p='.$prev.'"><button class="btn btn-default">Prev</button></a>';
            }
            if ($page<$pages) {
              echo '<a href="viewcomments.php?p='.$next.'"><button class="btn btn-default">Next</button></a>';
            }
           
             
            
            ?>
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