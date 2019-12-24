
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
                <h2>View Post</h2>
<?php
    if( !isset($_GET['viewpostId']) || $_GET['viewpostId'] == NULL ) {
        echo "<script> alert('something went wrong in this part</script>";
    } else {    
        $id = $_GET['viewpostId'];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script> window.location = 'postlist.php'</script>";
    }
?>
    <?php 

        $get_post_sql = "SELECT * FROM tbl_post  WHERE id = '$id'";
        $get_post_query = $db->select($get_post_sql);
        if( $get_post_query ) {
            $post_data = $get_post_query->fetch_assoc();
    ?>
                <div class="block">               
                 <form action="" method="POST">
                    <table class="form">

                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" readonly placeholder="Enter Post Title..." class="medium" value="<?php echo $post_data['title'];?>"/>
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select readonly id="select" name="category">
                                <?php 
                                    $show_cat_sql = "SELECT * FROM tbl_category";
                                    $show_cat_sql_query = $db->select($show_cat_sql);
                                    if($show_cat_sql_query) {
                                        $show_cat = $show_cat_sql_query->fetch_assoc(); 
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
                                ?> 
                                   
                                </select>
                            </td>
                        </tr>                                     
                        <tr>
                            <td>
                                <label>Image</label>
                            </td>
                            <td>
                                <img height="150px" width="250px" src="upload/<?php echo $post_data['image'];?>" alt="<?php echo $post_data['image'];?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" readonly><?php echo $post_data['body'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post_data['tags'];?>" class="medium">
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $post_data['author'];?>"class="medium">
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
            echo "<script> window.location = 'postlist.php'</script>";
        }
    ?>
            </div>
        </div>
<?php include "inc/admin_footer.php"; ?>
