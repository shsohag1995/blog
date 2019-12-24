
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
    if( !isset($_GET['editpostId']) || $_GET['editpostId'] == NULL ) {
        echo "<script> alert('something went wrong in this part</script>";
    } else {    
        $id = $_GET['editpostId'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $title = mysqli_real_escape_string($db->link,$_POST['title']);
        $category = mysqli_real_escape_string($db->link,$_POST['category']); 
        $body = mysqli_real_escape_string($db->link,$_POST['body']);
        $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
        $author = mysqli_real_escape_string($db->link,$_POST['author']);
        $userid = mysqli_real_escape_string($db->link,$_POST['userid']);

        $file_name      = $_FILES['image']['name'];

        

        if($title == "" || $category == "" || $body == "" || $tags == "" || $author == "") {
            echo '<span class="error">Fill each field</span>';
        }
        if( empty($file_name) ) {
            
                $sql = "UPDATE `tbl_post` SET `cat` = '$category', `title` = '$title', `body` = '$body', 
                `author` = '$author', `tags` = '$tags', `userid` = '$userid' WHERE `id` = '$id' ";
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
                $uploaded_image = "upload/".$unique_image;



                if( in_array($file_ext,$permited) === false ) {
                    echo "<span class='error'>You can only upload.".implode(" , ".$permited)."</span>";
                } else {
                    move_uploaded_file($file_temp_name,$uploaded_image);

                    $sql = "UPDATE `tbl_post` SET `cat` = '$category', `title` = '$title', `body` = '$body',
                    `image` = '$unique_image',`author` = '$author', `tags` = '$tags', `userid` = '$userid' WHERE `id` = '$id' ";
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

        $get_post_sql = "SELECT * FROM tbl_post  WHERE id = '$id'";
        $get_post_query = $db->select($get_post_sql);
        if( $get_post_query ) {
            while( $post_data = $get_post_query->fetch_assoc()) {
    ?>
                <div class="block">               
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" value="<?php echo $post_data['title'];?>"/>
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
                                    <option 
                                    <?php if($show_cat['id'] == $post_data['cat']) { ?>
                                        selected = "selected"
                                    <?php } ?>
                                    value="<?php echo $show_cat['id'];?>">
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
                                <img height="150px" width="150px" src="upload/<?php echo $post_data['image'];?>" alt="<?php echo $post_data['image'];?>">
                                <br>
                                <input type="file" name="image"/>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea  class="tinymce" name="body"><?php echo $post_data['body'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $post_data['tags'];?>" class="medium" placeholder="Enter tags here...">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" name="author" value="<?php echo $post_data['author'];?>"class="medium" placeholder="Enter author name...">
                                <input type="hidden" name="userid" value="<?php echo Session::get("userId");?>"class="medium" placeholder="Enter author name...">
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
    <?php 
            }
        } else {
            echo "<script> window.location = 'postlist.php'";
        }
    ?>
            </div>
        </div>
<?php include "inc/admin_footer.php"; ?>
