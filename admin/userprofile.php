
<?php 
    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
    $userid = Session::get('userId');
    $userrole = Session::get('userRole');
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
        $name = $fm->validation($_POST['name']);
        $name = mysqli_real_escape_string($db->link,$name);
        Session::set('name',$name);

        $username = $fm->validation($_POST['username']);
        $username = mysqli_real_escape_string($db->link,$username);

        $email = $fm->validation($_POST['email']);
        $email = mysqli_real_escape_string($db->link,$email);

        $details = $fm->validation($_POST['details']);
        $details = mysqli_real_escape_string($db->link,$details);

        if( $name == '' || $username == '' || $email == '' || $details == "") {
            echo "<span class='error'>Field must not be empty</span>";
        }

        $sql = "UPDATE `tbl_user` SET `name` = '$name', `username` = '$username', `email` = '$email', `details` = '$details' WHERE `tbl_user`.`id` = '$userid' AND `tbl_user`.`role` = '$userrole' ";
        $query = $db->update($sql);
        if($query) {
            echo "<span class='success'>User Data updated successfully!</span>";
        } else {
            echo "<span class='error'>Failed to update user data!</span>";
        }
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
                                <input type="text" name="name" required placeholder="Enter Name..." class="medium" value="<?php echo $user_data['name'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" required placeholder="Enter Username..." class="medium" value="<?php echo $user_data['username'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="email" name="email"required  placeholder="Enter Email..." class="medium" value="<?php echo $user_data['email'];?>"/>
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea  class="tinymce" required name="details"><?php echo $user_data['details'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
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
