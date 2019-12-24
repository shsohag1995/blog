<?php
    if(!isset($_GET['editCatId']) || $_GET['editCatId'] == NULL) {
        header("Location: catlist.php");
    }
    $id = $_GET['editCatId'];

    include "inc/admin_header.php";
    include "inc/admin_sidebar.php";


   
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Category</h2>
       <div class="block copyblock"> 
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['cat_name'];
                $name = mysqli_real_escape_string($db->link,$name);

                $sql = "UPDATE tbl_category SET name = '$name' WHERE id = '$id'";
                $query = $db->update($sql);
                if($query) {
                    echo "<span class='success'>Category Updated Successfully!</span>";
                } else {
                    echo "<span class='error'>Something went wrong! Please try again.</span>";
                }
            }
        ?>
        
        <?php 

            $sql = "SELECT * FROM tbl_category WHERE id = $id ";
            $query = $db->select($sql);
            if($query) {
                $result = $query->fetch_assoc();
        ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" name="cat_name" required placeholder="Enter Category Name..." class="medium" value="<?php echo $result['name'];?>" />
                    </td>
                </tr>
				<tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
            <?php } else {
                echo "<span class='error'>No Data Found!</span>";
            }
            ?>
        </div>
    </div>
</div>


<?php
    include "inc/admin_footer.php";
?>