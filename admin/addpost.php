
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
                <h2>Add New Post</h2>
<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = mysqli_real_escape_string($db->link,$_POST['title']);
        $category = mysqli_real_escape_string($db->link,$_POST['category']); 
        $body = mysqli_real_escape_string($db->link,$_POST['body']);
        $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
        $author = mysqli_real_escape_string($db->link,$_POST['author']);
        $userid = mysqli_real_escape_string($db->link,$_POST['userid']);


        $permited       = array("jpg","jpeg","png","gif");
        $file_name      = $_FILES['image']['name'];
        $file_size      = $_FILES["image"]["size"]; 
        $file_temp_name = $_FILES['image']['tmp_name'];
        $div = explode(".",$file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()),0,10).".".$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if($title == "" || $category == "" || $file_name == "" || $body == "" || $tags == "" || $author == "") {
            echo '<span class="error">Fill each field</span>';
        } elseif( in_array($file_ext,$permited) === false ) {
            echo "<span class='error'>You can only upload.".implode(" , ".$permited)."</span>";
        } else {
            move_uploaded_file($file_temp_name, $uploaded_image);

            $sql = "INSERT INTO `tbl_post` (`cat`, `title`, `body`, `image`, `author`, `tags`, `date`,`userid`) VALUES ('$category', '$title', '$body', '$unique_image', '$author', '$tags', CURRENT_TIMESTAMP, '$userid')";
            $query = $db->insert($sql);
            if($query) {
                echo "<span class='success'>Data Inserted successfully!</span>";
            } else {
                echo "<span class='error'>Failed to insert data!</span>";
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
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="category">
                                    <option>Select One</option>
                                <?php 
                                    $show_cat_sql = "SELECT * FROM tbl_category";
                                    $show_cat_sql_query = $db->select($show_cat_sql);
                                    if($show_cat_sql_query) {
                                        while($show_cat = $show_cat_sql_query->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $show_cat['id'];?>">
                                        <?php echo $show_cat['name'];?>                       
                                    </option>
                                <?php    
                                        }
                                    }
                                ?>                     
                                </select>
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
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="body"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" class="medium" placeholder="Enter tags here...">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" class="medium" value="<?php echo Session::get('username');?> ">
                                <input type="hidden" name="userid" class="medium" value="<?php echo Session::get('userId');?> ">
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/admin_footer.php"; ?>
