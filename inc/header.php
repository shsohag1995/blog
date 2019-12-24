<?php
	
	include "config/config.php"; 
	include "lib/Database.php";  
	include "helpers/Format.php"; 


	$db = new Database();
	$fm = new Format();
?>
<!DOCTYPE html>
<html>
<head>
	<?php
		if(isset($_GET['pageid'])) {
			$id = $_GET['pageid'];
			$title_sql = "SELECT * FROM tbl_page WHERE id = '$id' ";
			$title_query = $db->select($title_sql);
			if( $title_query ) {
				$title_data = $title_query->fetch_assoc()
	?>

	<title><?php echo ucwords($title_data['name'])."-".TITLE;?></title>

	<?php 
			}
		} else {
			echo "<title>".$fm->title()."-".TITLE."</title>";
		}
	?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
<?php
if(isset($_GET['id'])) {
	$meta_sql = "SELECT * FROM tbl_post";
	$meta_query = $db->select($meta_sql);
	if($meta_query) {
		$meta_data = $meta_query->fetch_assoc();
	
?>
	<meta name="keywords" content="<?php echo $meta_data['tags'];?>">
<?php
	}
} else {
?>
	<meta name="keywords" content="<?php echo KEYWORDS;?>">
<?php 
}
?>
	
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body >
	<div class="headersection templete clear">
		<a href="index.php">
		<?php 
			$title_slogan_sql = "SELECT * FROM tbl_title_slogan WHERE id = '1'";
			$title_slogan_query = $db->select($title_slogan_sql);
			if($title_slogan_query) {
				$title_slogan_result = $title_slogan_query->fetch_assoc();
		?>

			<div class="logo">
				<img src="images/<?php echo $title_slogan_result['logo'];?>" alt="<?php echo 
				$title_slogan_result['logo'];?>"/>
				<h2><?php echo $title_slogan_result['title'];?></h2>
				<p><?php echo $title_slogan_result['slogan'];?></p>
			</div>
		<?php 
			} else {
				echo "<h2 class='error'>Somehing went wrong.Please ask your developer to fix the issue.</h2>";
			}
		?>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php 
				    $socialmedia_sql = "SELECT * FROM tbl_socialmedia WHERE id = '1'";
				    $socialmedia_query = $db->select($socialmedia_sql);
				    if($socialmedia_query) {
				        $socialmedia_result = $socialmedia_query->fetch_assoc();
				?>
				<a href="<?php echo $socialmedia_result['fb'];?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $socialmedia_result['tw'];?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $socialmedia_result['ln'];?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $socialmedia_result['gp'];?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php } else { echo "<script>alert('Please ask your developer to add social icons');</script>";}
				?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="GET">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
<?php
	$currentpage = basename($_SERVER['SCRIPT_FILENAME'],".php");
?>
		<li><a <?php if($currentpage == 'index') {echo  'id="active"'; }?> href="index.php">Home</a></li>
		<?php 
			$page_sql = "SELECT * FROM tbl_page";
			$page_query = $db->select($page_sql);
			if($page_query) {
				while($page_data = $page_query->fetch_assoc()) {
		?>
		<li><a <?php if(isset($_GET['pageid']) && $_GET['pageid'] == $page_data['id']) {echo 'id="active"';}?> href="page.php?pageid=<?php echo $page_data['id'];?>"><?php echo $page_data['name'];?></a></li>
		<?php 
				}
			}
		?>
		<li><a <?php if($currentpage == 'contact') {echo  'id="active"'; }?> href="contact.php">Contact</a></li>
	</ul>
</div>

	