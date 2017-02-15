<?php
//left(column,no);
include_once('includes/connect.php');
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
		posts.posted as posted,posts.image as image FROM posts INNER JOIN categories ON categories.category_id=posts.category_id 
		ORDER BY posts.post_id DESC LIMIT $start, $per_page";
$query = mysqli_query($con, $stm);


?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Blog</title>

		<meta name="description" content="A bloging application" />
		<meta name="author" content="Abdulhakim" />
		
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="/font-awesome/4.2.0/css/font-awesome.min.css" />
 		 
	</head>
	
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
          <!-- ><li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"> Java <b class="caret"></b> </a> 
            <ul class="dropdown-menu"> 
              <li><a href="#">jmeter</a></li> 
              <li><a href="#">EJB</a></li> 
              <li><a href="#">Jasper Report</a></li> 
              <li class="divider"></li> <li><a href="#">Separated link</a></li> 
              <li class="divider"></li> <li><a href="#">One more separated link</a></li> 
            </ul> 
          </li> <-->
        </ul> 
        </div><!--/.navbar-collapse -->
      </div>
    </nav>
	<body class="">
		 
		<div class="container">
			<div class="row">
				<div class="container" >
					<div class="row">
					<?php while ( $row= mysqli_fetch_assoc($query)){
						//lastchar = strpos($col, ''); echo substr($col,0,$lastchar).linkid
								echo'<div class="col-sm-3">';
								$image = '<img class="editable img-responsive" style="ma"  width="135px" height="100px"  src="data:image;base64, '.$row['image'].'" >';
								echo $image;
								echo '</div>';
								$id = $row['post_id'];
								echo '<div class="col-sm-8">';
								echo '<h2 style="margin-top:40px;">'.$row['title'].'</h2>';
									$body = $row['body'];
									$lastpos = stripos($body, '');
								echo '<p>'.substr($body, $lastpos).'<a href="post.php?id='.$id.'">...View more</a> </p>';

								echo '<p>'.$row['category'].' <span> <b>Date posted:</b> '.$row['posted'].'</span> </p>';
								echo '</div>';
								
						}
						
						
					?>
				</div>
					<div class="pull-right">
						<?php
						if ($prev>0) {
							echo '<a href="blog.php?p='.$prev.'"><button class="btn btn-default">Prev</button></a>';
						}
						if ($page<$pages) {
							echo '<a href="blog.php?p='.$next.'"><button class="btn btn-default">Next</button></a>';
						}
						?>
					</div>
					
				</div>
				<div class="col-sm-3 ">
					
				</div>
			</div>
			
		</div>



		<script src="js/jquery.2.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	<body>
</html>