<?php
    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
?>

<style>
    .left {
        float: left;
        width: 70%;
    } 
    .right {
        float: left;
        width: 30%;
    }
    .right img {
        width: 160px;
        height: 170px;
    }
</style>

<div class="grid_10">
    <div class="box round first grid">
    <h2>Update Site Title and Description</h2>
    <div class="left">
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title  = $fm->validation($_POST['title']);
        $slogan = $fm->validation($_POST['slogan']);
        $title = mysqli_real_escape_string($db->link,$title);
        $slogan = mysqli_real_escape_string($db->link,$slogan);

        $file_name      = $_FILES['logo']['name'];

        

        
        if( empty($file_name) ) {
            
            $sql = "UPDATE `tbl_title_slogan` SET `title` = '$title', `slogan` = '$slogan' WHERE id = '1'";
            $query = $db->update($sql);

            if($query) {
                echo "<span class='success'>Data updated successfully!</span>";
            } else {
                echo "<span class='error'>Failed to update data!</span>";
            }
        } else {  
            if($title == "" || $slogan == "") {
                echo '<span class="error">Fill each field</span>';
            }  
            $permited       = array( "png" );
            $file_size      = $_FILES["logo"]["size"]; 
            $file_temp_name = $_FILES['logo']['tmp_name']; 
            $div = explode(".",$file_name);
            $file_ext = strtolower(end($div));
            $logo_image = "logo.".$file_ext;
            $uploaded_image = "upload/".$logo_image;



            if( in_array($file_ext,$permited) === false ) {
                echo "<span class='error'>You can only upload.".$permited."</span>";
            } else {
                move_uploaded_file($file_temp_name,$uploaded_image);

                $sql = "UPDATE `tbl_title_slogan` SET `title` = '$title', `slogan` = '$slogan',
                `logo` = '$logo_image' WHERE id = '1'";
                $query = $db->update($sql);

                if($query) {
                    echo "<span class='success'>Data updated successfully!</span>";
                } else {
                    echo "<span class='error'>Failed to update data!</span>";
                }
            }
        }
}
?> 

<?php
    $sql = "SELECT * FROM tbl_title_slogan";
    $query = $db->select($sql);
    if($query) {
        while($result = $query->fetch_assoc()) {
?>
        
        <div class="block sloginblock">               
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Website Title..."  name="title" value ="<?php echo $result['title'];?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Website Slogan..." name="slogan" value ="<?php echo $result['slogan'];?>" class="medium" />
                    </td>
                </tr>
				 
                 <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>

                     <td>
                        <input type="file" name="logo">
                    </td>
                 </tr>
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
        </div>
        <div class="right">
            <img src="upload/<?php echo $result['logo'];?>" alt="<?php echo $result['logo'];?>">
        </div>
    </div>

<?php
        }
    } else {
        echo "<span class='error'>Something went wrong.Please check database.Or Ask your developer to fix this issue.</span>";
    }
?>    
</div> 
<?php include "inc/admin_footer.php"; ?> 