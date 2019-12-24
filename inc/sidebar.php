
		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
						<?php 
							$sql = "SELECT * FROM tbl_category";
							$cat_result = $db->select($sql);
							if($cat_result) {
								while($row = $cat_result->fetch_array()) {
						?>
						<li>
							<a href="category_post.php?category=<?php echo $row['id'];?>">
							<?php echo $row['name'];?>								
							</a>
						</li> 
						<?php
								}
							} else {
						?>
						<li>No category found</li>
						<?php
							}
						?>					
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				<?php 
					$sql = "SELECT * FROM tbl_post ORDER BY id DESC LIMIT 5";
					$cat_result = $db->select($sql);
					if($cat_result) {
						while($row = $cat_result->fetch_array()) {
				?>
					<div class="popular clear">
						<h3><a href="post.php?id=<?php echo $row['id']; ?>"><?php echo $row['title']; ?></a></h3>
						<a href="post.php?id=<?php echo $row['id']; ?>"><img src="admin/upload/<?php echo $row['image']; ?>" alt="post image"/></a>
						<?php echo $fm->textshorten($row['body'],120); ?>	
					</div>
				<?php
						} 
					}
				?>

					
			</div>
			
		</div>