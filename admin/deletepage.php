<?php 
    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
    if( !isset($_GET['pageid']) || $_GET['pageid'] == NULL ) {
    	echo "<script> window.location = 'index.php'</script>";
    } else {
    	$id = $_GET['pageid'];
    	$sql = "DELETE FROM tbl_page WHERE id = '$id'";
    	$query = $db->delete($sql);
    	if($query) {
    		echo "<script>alert('Page Deleted successfully!'); window.location = 'index.php';</script>";
    	} else {
    		echo "<script>alert('Something went wrong could not delete page.Please ask your developer to fix the issue.</script>; window.location = 'index.php';";
    	}
    }
?>


<?php include "inc/admin_footer.php";?>