<?php

	include "inc/admin_header.php";
	include "inc/admin_sidebar.php";
	if( isset($_GET['deletepostId'])) {
		$postId = $_GET['deletepostId'];
		$img_sql = "SELECT * FROM tbl_post WHERE id = '$postId'";
		$img_query = $db->select($img_sql);
		if($img_query) {
			$img = $img_query->fetch_assoc();
			$imgLink = "upload".$img['image'];
			$delete_post_sql = "DELETE FROM tbl_post WHERE id = '$postId'";
			$delete_query = $db->delete($delete_post_sql);
			ob_get_clean();
			if($delete_query) {
				echo "<script>alert('Data Deleted Successfully!</script>";
				echo "<script>window.location = 'postlist.php'</script>";
				unlink($imgLink);
			}
		} else {
			echo "<script>alert('Could Not Delete Data . Please Try again!</sctirp>";
			echo "<script>window.location = 'postlist.php'</script>";
		}
	} 
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr> 
					<th width="5%">No</th>
					<th width="15%">Post Title</th>
					<th width="20%">Description</th>
					<th width="10%">Category</th>
					<th width="10%">Image</th>
					<th width="10%">Author</th>
					<th width="10%">Tags</th>
					<th width="10%">Date</th>
					<th width="10%">Action</th>
				</tr>
			</thead>
			<tbody>
	<?php
		$sql = "SELECT tbl_post.*,tbl_category.name FROM tbl_post INNER JOIN tbl_category ON tbl_post.cat = tbl_category.id ORDER BY tbl_post.id DESC";
		$query = $db->select($sql);
		if($query) {
			$i = 0;
			while($result = $query->fetch_assoc()) {
				$i++;
	?>		
			<tr class="odd gradeX">
					<td style="text-align: center"><?php echo $i;?></td>
					<td style="text-align: center"><?php echo $result['title'];?></td>
					<td style="text-align: center"><?php echo $fm->textShorten($result['body'],50);?></td>
					<td style="text-align: center"><?php echo $result['cat'];?></td>
					<td style="text-align: center"><img height="70px" width="70px" src="upload/<?php echo $result['image'];?>" alt="<?php echo $result['image'];?>"></td>
					<td style="text-align: center"><?php echo $result['author'];?></td>
					<td style="text-align: center"><?php echo $result['tags'];?></td>
					<td style="text-align: center"><?php echo $fm->formatDate($result['date']);?></td>
					<td style="text-align: center"> <a href="viewpost.php?viewpostId=<?php echo $result['id'];?>">View</a> 
						<?php 
							if( $fm->evdo($result['userid']) ) { ?>
						||<a href="editpost.php?editpostId=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are you sure want to delete data!');" href="?deletepostId=<?php echo $result['id'];?>">Delete</a>
					<?php } ?>
					</td>
				</tr>

	<?php
			}
		} else {
			echo "<tr class='odd gradeX'><td colspan='9'><h2>No Data Found</h2></td></tr>";
		}
	?>
					
			</tbody>
		</table>

       </div>
    </div>
</div> 
<script>
	$(document).ready(function(){
		$('.datatable').dataTable();
	});
</script>
<?php
	include "inc/admin_footer.php";
?>

<?php
	
?>