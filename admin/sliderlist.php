<?php
	include "inc/admin_header.php";
	include "inc/admin_sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
    <?php
        if( isset($_GET['deleteSlideId']) ) {
        		$slideId = $_GET['deleteSlideId'];
        		$img_sql = "SELECT * FROM tbl_slider WHERE id = '$slideId'";
        		$img_query = $db->select($img_sql);
        		if($img_query) {
        			$img = $img_query->fetch_assoc();
        			$imgLink = "upload/slider/".$img['image'];
        			$delete_post_sql = "DELETE FROM tbl_slider WHERE id = '$slideId'";
        			$delete_query = $db->delete($delete_post_sql);
        			if($delete_query) {
        				echo "<script>alert('Data Deleted Successfully!</script>";
        				echo "<script>window.location = 'sliderlist.php'</script>";
        				unlink($imgLink);
        			}
        		} else {
        			echo "<script>alert('Could Not Delete Data . Please Try again!</sctirp>";
        			echo "<script>window.location = 'sliderlist.php'</script>";
        		}
        	}
    ?>

        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="8%">Serial No.</th>
					<th width="22%">Title</th>
					<th width="55%">Slider Image</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = "SELECT * FROM tbl_slider ORDER BY id DESC";
					$query = $db->select($sql);
					if($query) {
						$i = 0;
						while($result = $query->fetch_assoc()) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['title']; ?></td>
					<td><img height="150px" src="upload/slider/<?php echo $result['image']; ?>" alt="<?php echo $result['image'];?>"/></td>
					<td><a href="edit_slider.php?editSlideId=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are You sure want to delete ?');" href="?deleteSlideId=<?php echo $result['id'];?>">Delete</a></td>
				</tr>
				<?php
						}
					} else {
				?>
				<tr class="odd gradeX">
					<td colspan="4">No slider Found</td>
				</tr>
				<?php
					}
				?>
				
			</tbody>
		</table>
       </div>
    </div>
</div> 
<?php
	include "inc/admin_footer.php";
?>