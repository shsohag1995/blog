<?php include "inc/header.php"; ?>
<?php 
	if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
		echo "<script>window.location = '404.php'</script>";
	} else {
		$id = $_GET['pageid'];
		$sql = "SELECT * FROM tbl_page WHERE id = '$id' ";
		$query = $db->select($sql);
		if($query) {
			$result = $query->fetch_assoc();
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2><?php echo $result['name'];?></h2>
	
				<?php echo $result['content'];?>
	</div>
		</div>
<?php } } ?>
<?php include "inc/sidebar.php";?>
<?php include "inc/footer.php";?>
