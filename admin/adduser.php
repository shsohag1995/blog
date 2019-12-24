<?php

    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
    if(! Session::get('userRole') == '0' ) {
        echo "<script>window.location = 'index.php'</script>";
    }
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
       <div class="block copyblock"> 
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = $fm->validation($_POST['username']);
                $username = mysqli_real_escape_string($db->link,$username);

                $password = $fm->validation(md5($_POST['password']));
                $password = mysqli_real_escape_string($db->link,$password);

                $role = $fm->validation($_POST['role']);
                $role = mysqli_real_escape_string($db->link,$role);
                if( $username == '' || $_POST['password'] == '' || $role == '') {
                    echo "<span class='error'> Fill each field</span>";
                } else {

                    $sql = "INSERT INTO tbl_user(`username`,`password`,`role`) VALUES('$username','$password','$role')";
                    $query = $db->insert($sql);
                    if($query) {
                        echo "<span class='success'>User Created Successfully!</span>";
                    } else {
                        echo "<span class='error'>Something went wrong! Please try again.</span>";
                    }
                    
                }
            }
        ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td><label>Username</label></td>
                    <td>
                        <input type="text" name="username" required placeholder="Enter User Name..." class="medium" />
                    </td>
                </tr>                   
                <tr>
                    <td><label>Password</label></td>
                    <td>
                        <input type="password" name="password" required placeholder="Enter Password..." class="medium" />
                    </td>
                </tr>                   
                <tr>
                    <td><label>User Role</label></td>
                    <td>
                        <select name="role" id="select">
                            <option value="" >Select Role</option>
                            <option value="0">Admin</option>
                            <option value="1">Author</option>
                            <option value="2">Editor</option>
                        </select>
                    </td>
                </tr>
				<tr> 
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>


<?php
    include "inc/admin_footer.php";
?>