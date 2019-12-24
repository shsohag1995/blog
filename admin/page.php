
<?php 
    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
    if( !isset($_GET['page_id']) || $_GET['page_id'] == NULL ) {
        echo "<script> window.location = 'index.php'</script>";
    } else {
        $pageid = $_GET['page_id'];
    }
?> 
<style>
    .delete_btn {
        margin-left: 10px;
    }
    .delete_btn a {
        background: #f0f0f0 none repeat scroll 0 0;
        border: 1px solid #ddd;
        color: #444;
        cursor: pointer;
        font-size: 20px;
        font-weight: normal;
        padding: 2px 10px;
    }
</style>
    <!-- Load TinyMCE -->
    <script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setupTinyMCE(); 
        });
    </script>
       
        <div class="grid_10">
        
            <div class="box round first grid">
                <h2>Update Page</h2>
<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($db->link,$_POST['name']);
        $content = mysqli_real_escape_string($db->link,$_POST['content']);

        if($name == "" || $content == "") {
            echo '<span class="error">Fill each field</span>';
        } else {
            $sql = "UPDATE `tbl_page` SET `name` = '$name' , `content` = '$content' WHERE id = '$pageid' " ;
            $query = $db->update($sql);
            if($query) {
                echo "<span class='success'>Page Updated successfully!</span>";
            } else {
                echo "<span class='error'>Failed to Update Page.Please try again!</span>";
            }
        }
    }
?>
                <div class="block">   
<?php 
    $show_page_sql = "SELECT * FROM tbl_page WHERE id = '$pageid' ";
    $show_page_query = $db->select($show_page_sql);
    if($show_page_query) {
        $show_page_result = $show_page_query->fetch_array()
?>            
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $show_page_result['name'];?>" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr> 

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="content"><?php echo $show_page_result['content'];?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <input type="submit" value="Update">
                                <span class="delete_btn"><a onclick="return confirm('Are you sure want to delete this page?');" href="deletepage.php?pageid=<?php echo $show_page_result['id'];?>" >Delete</a></span>
                            </td>
                        </tr>
                    </table>
                    </form>
<?php } else { echo "<script>window.location = 'index.php';</script>";} ?>
                </div>
            </div>
        </div>
<?php include "inc/admin_footer.php"; ?>
