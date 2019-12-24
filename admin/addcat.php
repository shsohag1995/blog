<?php

    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Add New Category</h2>
       <div class="block copyblock"> 
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['cat_name'];
                $name = mysqli_real_escape_string($db->link,$name);

                $sql = "INSERT INTO tbl_category(`name`) VALUES('$name')";
                $query = $db->insert($sql);
                if($query) {
                    echo "<span class='success'>Category Inserted Successfully!</span>";
                } else {
                    echo "<span class='error'>Something went wrong! Please try again.</span>";
                }
            }
        ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="cat_name" required placeholder="Enter Category Name..." class="medium" />
                    </td>
                </tr>
				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>


<?php
    include "inc/admin_footer.php";
?>