<?php

    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
?>
<div class="grid_10">

    <div class="box round first grid">

        <h2>Update Copyright Text</h2>

        <div class="block copyblock"> 
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $copyright  = $fm->validation($_POST['copyright']);

    $copyright = mysqli_real_escape_string($db->link,$copyright);


    $sql = "UPDATE copyright SET `copyright` = '$copyright' WHERE id = '1'";
    $query = $db->update($sql);
    if($query) {
        echo "<span class='success'>Data updated successfully!</span>";
    } else {
        echo "<span class='error'>Something went wrong please ask your developer to fix the issue!</span>";
    }
}
?>
<?php 
    $copyright_sql = "SELECT * FROM copyright WHERE id = '1'";
    $copyright_query = $db->select($copyright_sql);
    if($copyright_query) {
        $copyright_result = $copyright_query->fetch_assoc();
?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" placeholder="Enter Copyright Text..." name="copyright" value="<?php echo $copyright_result['copyright'];?>" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
<?php } ?>
        </div>
    </div>
</div> 

<?php
    include "inc/admin_footer.php";
?>