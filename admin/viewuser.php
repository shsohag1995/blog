
<?php 
    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
    if(!isset($_GET['userId']) || $_GET['userId'] == NULL) {
        echo "<script>window.location = 'userlist.php'</script>";
    } else {
        $userid = $_GET['userId'];
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
                <h2>Update Post</h2>
<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {       
        echo "<script>window.location = 'userlist.php'</script>";
    }
?>
    <?php 

        $get_user_sql = "SELECT * FROM tbl_user  WHERE id = '$userid'";
        $get_user_query = $db->select($get_user_sql);
        if( $get_user_query ) {
             $user_data = $get_user_query->fetch_assoc() 
    ?>
                <div class="block">               
                 <form action="" method="POST">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name"  readonly placeholder="Enter Name..." class="medium" value="<?php echo $user_data['name'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username"  readonly placeholder="Enter Username..." class="medium" value="<?php echo $user_data['username'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" name="email" readonly  placeholder="Enter Email..." class="medium" value="<?php echo $user_data['email'];?>"/>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea  class="tinymce"  readonly name="details"><?php echo $user_data['details'];?></textarea>
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
                </div>
    <?php 
        } else {
            echo "<script> window.location = 'postlist.php'";
        }
    ?>
            </div>
        </div>
<?php include "inc/admin_footer.php"; ?>
