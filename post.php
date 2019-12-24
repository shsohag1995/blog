<?php
	include "inc/header.php"; 
 	if(!isset($_GET['id']) || $_GET['id'] == NULL) {
 		header("Location: 404.php");
 	} else {
 		$id = $_GET['id'];
 		$sql = "SELECT * FROM tbl_post WHERE id = $id";
 		$post = $db->select($sql);
 		if( $post ) {
 			$result = $post->fetch_array();
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $result['title']; ?></h2>
				<h4>
					<?php echo $fm->formatDate($result['date']); ?> <a href="#"><?php echo $result['author']; ?></a>
				</h4>
				<img src="admin/upload/<?php echo $result['image']; ?>" alt="post image"/>
				<?php echo $result['body']; ?>
				
				<div class="relatedpost clear">
					<h2>Related articles</h2>
					<?php 
						$catid =  $result['cat'];
						$id = $result['id'];
						$rel_post_sql = "SELECT * FROM tbl_post WHERE cat = $catid AND id NOT IN ( select id from tbl_post WHERE id = $id )";
						$query = $db->select($rel_post_sql);
						if($query) {
							while($rel_post_result = $query->fetch_array()) {
					?>
							<a href="?id=<?php echo $rel_post_result['id'];?>"><img src="admin/upload/<?php echo $rel_post_result['image'];?>" alt="post image"/></a>
					<?php 
							}
						} else {
							echo "<h4> NO Related Post Found.</h4>";
						}
					?>

					
				</div>
	</div>
	<!-- disqus commenting system integrated -->
	<div id="disqus_thread"></div>
	<script>

	/**
	*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
	*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
	/*
	var disqus_config = function () {
	this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
	this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
	};
	*/
	(function() { // DON'T EDIT BELOW THIS LINE
	var d = document, s = d.createElement('script');
	s.src = 'https://tech-khalid.disqus.com/embed.js';
	s.setAttribute('data-timestamp', +new Date());
	(d.head || d.body).appendChild(s);
	})();
	</script>
	<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>



	<!-- end of the section                              -->
		</div> 
<?php
		//}//end of while loop  		
	} else {
		header("location :404.php");
		}//end of second if else block
}//end of first if else block 
?>


<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
