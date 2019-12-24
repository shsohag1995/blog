

<?php 
    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
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
    if( !isset($_GET['editSlideId']) || $_GET['editSlideId'] == NULL ) {
        echo "<script> alert('something went wrong in this part');</script>";
    } else {    
        $id = $_GET['editSlideId'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = mysqli_real_escape_string($db->link,$_POST['title']);
        $file_name      = $_FILES['image']['name'];

        

        if($title == "") {
            echo '<span class="error">Fill each field</span>';
        }
        if( empty($file_name) ) {
            
                $sql = "UPDATE `tbl_slider` SET`title` = '$title' WHERE `id` = '$id' ";
                $query = $db->update($sql);

            if($query) {
                echo "<span class='success'>Data updated successfully!</span>";
            } else {
                echo "<span class='error'>Failed to update data!</span>";
            }
        } else {  

             
                $permited       = array("jpg","jpeg","png","gif");
                $file_size      = $_FILES["image"]["size"]; 
                $file_temp_name = $_FILES['image']['tmp_name'];
                $div = explode(".",$file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()),0,10).".".$file_ext;
                $uploaded_image = "upload/slider/".$unique_image;



                if( in_array($file_ext,$permited) === false ) {
                    echo "<span class='error'>You can only upload.".implode(" , ".$permited)."</span>";
                } else {
                    move_uploaded_file($file_temp_name,$uploaded_image);

                    $sql = "UPDATE `tbl_slider` SET `title` = '$title',
                    `image` = '$unique_image' WHERE `id` = '$id' ";
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

        $get_slider_sql = "SELECT * FROM tbl_slider  WHERE id = '$id'";
        $get_slider_query = $db->select($get_slider_sql);
        if( $get_slider_query ) {
            $slider_data = $get_slider_query->fetch_assoc();
    ?>
                <div class="block">               
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" value="<?php echo $slider_data['title'];?>"/>
                            </td>
                        </tr>
                     
                                                      
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img height="200px" width="350px" src="upload/slider/<?php echo $slider_data['image'];?>" alt="<?php echo $slider_data['image'];?>">
                                <br>
                                <input type="file" name="image"/>
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
