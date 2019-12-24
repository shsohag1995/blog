
<?php 
    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
    if(!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script> window.location = 'inbox.php'</script>";
    } else {
        $id = $_GET['msgid'];
    }
?> 
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE(); 
        });
    </script>
       
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>View Message</h2>
<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'inbox.php'</script>";
    }
?>
                <div class="block">  
<?php 
    $sql = "SELECT * FROM tbl_msg WHERE id = '$id'";
    $query = $db->select($sql);
    if( $query ) {
        $msg_data = $query->fetch_assoc();
?>

                 <form action="" method="post" >
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $msg_data['firstname']." ".$msg_data['lastname'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $msg_data['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Message </label>
                            </td>
                            <td>
                                <textarea class="medium" readonly ><?php echo $msg_data['msg'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $fm->formatDate($msg_data['date']);?>"class="medium" />
                            </td>
                        </tr>
                     
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>

<?php 
    } else {
        echo "<h2>Something went wrong.Please ask your developer to fix the issue</h2>";
    }
?>
                </div>
            </div>
        </div>
<?php include "inc/admin_footer.php"; ?>
