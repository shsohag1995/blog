<?php

	include "inc/admin_header.php";
	include "inc/admin_sidebar.php";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
<?php
	if(isset($_GET['seenid']) && $_GET['seenid'] != NULL) {
		$id = $_GET['seenid'];
		$seen_msg_sql = "UPDATE tbl_msg SET status = '1' WHERE id = '$id' ";
		$seen_msg_query = $db->update($seen_msg_sql);
		if($seen_msg_query) {
			echo "<span class='success'>Message is tranfered to Seen box</span>";
		} else {
			echo "<span class='error'>Something went wrong. Could not move the msg to the seen box.Ask your developer to fix the issue!</span>";
		}
	}
?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
<?php 
	$sql = "SELECT * FROM tbl_msg WHERE status = '0' ORDER BY id DESC";
	$query = $db->select($sql);
	if($query) {
		$i = 0;
		while($msg_data = $query->fetch_assoc()) {
			$i++;
?>

				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $msg_data['firstname']." ".$msg_data['lastname'];?></td>
					<td><?php echo $msg_data['email'];?></td>
					<td><?php echo $fm->textShorten($msg_data['msg'],30);?></td>
					<td><?php echo $fm->formatDate($msg_data['date']);?></td>
					<td>
						<a href="viewmsg.php?msgid=<?php echo $msg_data['id'];?>">View</a> ||
						<a href="replymsg.php?msgid=<?php echo $msg_data['id'];?>">Reply</a> ||
						<a href="?seenid=<?php echo $msg_data['id'];?>">Seen</a>
					</td>
				</tr>

<?php 
		}
	} else {
?>
				<tr class="odd gradeX">
					<td colspan="6"><h6 style="text-align: center;padding-top: 10px;padding-bottom: 5px;">No data found in the seen box.</h6></td>
				</tr>
<?php
	}
?>
				
			</tbody>
		</table>
       </div>
	</div>
</div>
<div class="grid_10">
    <div class="box round first grid">
		<h2>Seen Message</h2>
       <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name</th>
					<th>Email</th>
					<th>Message</th>
					<th>Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
<?php
	if(isset($_GET['deleteid']) && $_GET['deleteid'] != NULL) {
		$id = $_GET['deleteid'];
		$delete_msg_sql = "DELETE FROM tbl_msg WHERE id = '$id' ";
		$delete_query  = $db->delete($delete_msg_sql);
		if($delete_query) {
			echo "<span class='success'>Message deleted succesfully!</span>";
		} else {
			echo "<span class='error'>Could not delete message.Please ask your developer to fix the issue!</span>";
		}
	}
?>
<?php 
	$sql = "SELECT * FROM tbl_msg WHERE status = '1' ORDER BY id DESC";
	$query = $db->select($sql);
	if($query) {
		$i = 0;
		while($msg_data = $query->fetch_assoc()) {
			$i++;
?>

				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $msg_data['firstname']." ".$msg_data['lastname'];?></td>
					<td><?php echo $msg_data['email'];?></td>
					<td><?php echo $fm->textShorten($msg_data['msg'],30);?></td>
					<td><?php echo $fm->formatDate($msg_data['date']);?></td>
					<td>
						<a href="viewmsg.php?msgid=<?php echo $msg_data['id'];?>">View</a> ||
						<a href="replymsg.php?msgid=<?php echo $msg_data['id'];?>">Reply</a> ||
						<a onclick="return confirm('Are you sure to delete the data?');" href="?deleteid=<?php echo $msg_data['id'];?>">Delete</a>
					</td>
				</tr>

<?php 
		}
	} else {
?>
		<tr class="odd gradeX">
			<td colspan="6"><h6 style="text-align: center;padding-top: 10px;padding-bottom: 5px;">No data found in the seen box.</h6></td>
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