<?php  
	include "inc/header.php"; 
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
<?php 
	if(!isset($_GET['search']) || $_GET['search'] == NULL) {
		header("Location: 404.php");
	} else {
		$search = $_GET['search'];
		$sql = "SELECT * FROM tbl_post WHERE title LIKE '%$search%' or body LIKE '%$search%' or tags LIKE '%$search%' ";
		$post = $db->select($sql);
		if( $post ) {
			echo "<h3 style='font-size: 26px; padding: 10px 0; text-align: center; color: #ac7511;'> Showing result for <span style='color: #000;'>$search</span> </h3>";
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
		 		echo "$search keyword not found!!";
		 	}
		 } 
		?>
		</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
