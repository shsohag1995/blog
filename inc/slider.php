<div class="slidersection templete clear">
        <div id="slider">
    <?php 
    	$slide_sql = "SELECT * FROM tbl_slider ORDER BY id DESC";
    	$slide_query = $db->select($slide_sql);
    	if( $slide_query) {
    		while($slide  = $slide_query->fetch_assoc()) {
    ?>
    	<a href="#"><img src="admin/upload/slider/<?php echo $slide['image'];?>" alt="<?php echo $slide['image'];?>" title="<?php echo $slide['title'];?>" /></a>
    <?php
    		}
    	}
    ?>          
            
        </div>

</div>