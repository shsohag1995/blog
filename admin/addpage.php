
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
                <h2>Add New Page</h2>
<?php

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = mysqli_real_escape_string($db->link,$_POST['name']);
        $content = mysqli_real_escape_string($db->link,$_POST['content']);

        if($name == "" || $content == "") {
            echo '<span class="error">Fill each field</span>';
        } else {
            $sql = "INSERT INTO `tbl_page` (`name`, `content`) VALUES ('$name', '$content')" ;
            $query = $db->insert($sql);
            if($query) {
                echo "<span class='success'>Page Created successfully!</span>";
            } else {
                echo "<span class='error'>Failed to Create Page.Please try again!</span>";
            }
        }
    }
?>
                <div class="block">               
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr> 

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="content"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="Create"></td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include "inc/admin_footer.php"; ?>
