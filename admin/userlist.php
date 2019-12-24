<?php
	include "inc/admin_header.php";
	include "inc/admin_sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php
        	if( Session::get('userRole') == '0') {
	        	if(isset($_GET['deleteUserId'])) {
	        		$deleteId = $_GET['deleteUserId'];
	        		$delete_sql = "DELETE FROM tbl_user WHERE id = '$deleteId'";
	        		$delete_query = $db->delete($delete_sql);
	        		if($delete_query) {
	        			echo "<span class='success'> Data Deleted Successfully!</span>";
	        		} else {
	        			echo "<span class='error'>Could not delete data . Something went wrong!</span>";
	        		}
	        	}
	        }
        ?>

        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Serial No.</th>
					<th>Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Details</th>
					<th>Role</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$sql = "SELECT * FROM tbl_user ORDER BY id DESC";
					$query = $db->select($sql);
					if($query) {
						$i = 0;
						while($result = $query->fetch_assoc()) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><?php echo $result['username']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $fm->textShorten($result['details'],30); ?></td>
					<td>
						<?php
						    if( $result['role'] == '0') {
								echo "Admin";
							} elseif( $result['role'] == '1') {
								echo "Author";
							} elseif( $result['role'] == '2') {
								echo "Editor";
							}
						
						?>						
					</td>
					<td>
						<a href="viewuser.php?userId=<?php echo $result['id'];?>">View </a> 
						<?php if( Session::get('userRole') == '0') { ?>
						|| <a onclick="return confirm('Are You sure want to delete ?')" href="?deleteUserId=<?php echo $result['id'];?>">Delete</a>
						<?php } ?>
					</td>
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