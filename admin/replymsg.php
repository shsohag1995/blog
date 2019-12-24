
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
        $to = $fm->validation($_POST['to']);
        $from = $fm->validation($_POST['from']);
        $subject = $fm->validation($_POST['subject']);
        $msg = $fm->validation($_POST['msg']);

        $to = mysqli_real_escape_string($db->link,$to);
        $from = mysqli_real_escape_string($db->link,$from);
        $subject = mysqli_real_escape_string($db->link,$subject);
        $msg = mysqli_real_escape_string($db->link,$msg);

        $sendmail = mail($to, $subject, $msg, $from);
        if( $sendmail ) {
            echo "<span class='success'>Message Sent successfully!</span>";
        } else {
            echo "<span class='error'>Could not send message . Something went wrong in the server. Please ask your developer to fix the issue!</span>";
        }
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
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" name="to" readonly value="<?php echo $msg_data['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="from" placeholder="Enter your Email" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Enter subject" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Message </label>
                            </td>
                            <td>
                                <textarea name="msg" class="tinymce"><?php echo $msg_data['msg'];?></textarea>
                            </td>
                        </tr>
                     
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
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
