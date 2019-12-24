<?php  
	include "inc/header.php"; 
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
<?php 
	if(!isset($_GET['category']) || $_GET['category'] == NULL) {
		header("Location: 404.php");
	} else {
		$category = $_GET['category'];
		$sql = "SELECT * FROM tbl_post WHERE cat = $category";
		$post = $db->select($sql);
		if( $post ) {
			while($result = $post->fetch_assoc()) {
?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?> <a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/upload/<?php echo $result['image']; ?>" alt="post image"/></a>
				<?php echo $fm->textShorten($result['body'],100); ?>
				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>
			</div>
		<?php 
				}
		 	} else {
		 		echo "<h3>No Post Available in this category</h3>";
		 	}
		 } 
		?>
		</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
