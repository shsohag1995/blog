
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
                <h2>Add New Slider</h2>
<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = mysqli_real_escape_string($db->link,$_POST['title']);
        
        $permited       = array("jpg","jpeg","png","gif");
        $file_name      = $_FILES['image']['name'];
        $file_size      = $_FILES["image"]["size"]; 
        $file_temp_name = $_FILES['image']['tmp_name'];
        $div = explode(".",$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).".".$file_ext;
        $uploaded_image = "upload/slider/".$unique_image;

        if($title == "" || $file_name == "") {
            echo '<span class="error">Fill each field</span>';
        } elseif( in_array($file_ext,$permited) === false ) {
            echo "<span class='error'>You can only upload.".implode(" , ".$permited)."</span>";
        } else {
            move_uploaded_file($file_temp_name, $uploaded_image);

            $sql = "INSERT INTO `tbl_slider` (`title`,`image`) VALUES ('$title','$unique_image')";
            $query = $db->insert($sql);
            if($query) {
                echo "<span class='success'>Slider Image Inserted successfully!</span>";
            } else {
                echo "<span class='error'>Failed to insert Slider Image!</span>";
            }
        }
    }
?>
                <div class="block">               
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                                                   
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Add Slider" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/admin_footer.php"; ?>
