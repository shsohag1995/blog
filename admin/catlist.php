<?php
	include "inc/admin_header.php";
	include "inc/admin_sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
        	if(isset($_GET['deleteCatId'])) {
        		$deleteId = $_GET['deleteCatId'];
        		$sql = "DELETE FROM tbl_category WHERE id = '$deleteId'";
        		$query = $db->delete($sql);
        		if($query) {
        			echo "<span class='success'> Data Deleted Successfully!</span>";
        		} else {
        			echo "<span class='error'>Could not delete data . Something went wrong!</span>";
        		}
        	}
        ?>

        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Category Name</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = "SELECT * FROM tbl_category ORDER BY id DESC";
					$query = $db->select($sql);
					if($query) {
						$i = 0;
						while($result = $query->fetch_assoc()) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><a href="edit_category.php?editCatId=<?php echo $result['id'];?>">Edit</a> || <a onclick="return confirm('Are You sure want to delete ?');" href="?deleteCatId=<?php echo $result['id'];?>">Delete</a></td>
				</tr>
				<?php
						}
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