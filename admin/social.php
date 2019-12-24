<?php

    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fb  = $fm->validation($_POST['fb']);
    $tw = $fm->validation($_POST['tw']);
    $ln = $fm->validation($_POST['ln']);
    $gp = $fm->validation($_POST['gp']);

    $fb = mysqli_real_escape_string($db->link,$fb);
    $tw = mysqli_real_escape_string($db->link,$tw);
    $ln = mysqli_real_escape_string($db->link,$ln);
    $gp = mysqli_real_escape_string($db->link,$gp);


    $sql = "UPDATE tbl_socialmedia SET `fb` = '$fb',`tw` = '$tw',`ln` = '$ln',`gp` = '$gp' WHERE id = '1'";
    $query = $db->update($sql);
    if($query) {
        echo "<span class='success'>Data updated successfully!</span>";
    } else {
        echo "<span class='error'>Something went wrong please ask your developer to fix the issue!</span>";
    }
}
?>
        <div class="block">            
<?php 
    $socialmedia_sql = "SELECT * FROM tbl_socialmedia WHERE id = '1'";
    $socialmedia_query = $db->select($socialmedia_sql);
    if($socialmedia_query) {
        $socialmedia_result = $socialmedia_query->fetch_assoc();
?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="fb" placeholder="Facebook link.." value="<?php echo $socialmedia_result['fb'];?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="tw" placeholder="Twitter link.." value="<?php echo $socialmedia_result['tw'];?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="ln" placeholder="LinkedIn link.." value="<?php echo $socialmedia_result['ln'];?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="gp" placeholder="Google Plus link.." value="<?php echo $socialmedia_result['gp'];?>" class="medium" />
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

<?php    } else {
        echo "<span class='error'>Couldn't fetch social media link's.Please ask your developer to fix the issue!.</span>";
    }
?>
        </div>
    </div>
</div>

<?php
    include "inc/admin_footer.php";
?>