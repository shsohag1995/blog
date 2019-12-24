<?php  
	include "inc/header.php";  
	include "inc/slider.php"; 
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">

			  
<?php 
	$exerpt_length = 100;
//pagination 
	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	} else {
		$page = 1;
	}
	$no_of_records_per_page = 3;
	$offset = ($page - 1) * $no_of_records_per_page;

	$total_pages_sql = "SELECT * FROM tbl_post";
	$result = $db->select($total_pages_sql);
	if( $result ) { 
		$total_rows = mysqli_num_rows($result);
		$total_pages = ceil($total_rows / $no_of_records_per_page);		

		$query = "SELECT * FROM tbl_post LIMIT $offset, $no_of_records_per_page";
		$post = $db->select($query);
		if($post) {
			
			while($result = $post->fetch_assoc()) {
?>
			<div class="samepost clear">
				<h2><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h2>
				<h4><?php echo $fm->formatDate($result['date']); ?> <a href="#"><?php echo $result['author']; ?></a></h4>
				 <a href="post.php?id=<?php echo $result['id'];?>"><img src="admin/upload/<?php echo $result['image']; ?>" alt="post image"/></a>
			<?php  
				if(  strlen($result['body']) > $exerpt_length ) {
					echo $fm->textShorten($result['body'], $exerpt_length);
			?>

				<div class="readmore clear">
					<a href="post.php?id=<?php echo $result['id'];?>">Read More</a>
				</div>
			<?php 
				} else {
					echo $result['body'];
				}
			?>
			</div>
<?php
		}
	echo "<div class='pagination'>";
		for( $i = 1; $i <= $total_pages; $i++) {
			if($i == 1) {
				echo "<span><a href='?page=".$i."'> First Page </a></span>";
			} elseif ($i == $total_pages) {
				echo "<span><a href='?page=".$i."'> Last Page </a></span>";
			} else {
				echo "<span><a href='?page=".$i."'> ".$i." </a></span>";
			}
		}
	echo "</div>";
	} } else {
		echo "<h2>No Post Found</h2>";
	}
?>
		</div>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
