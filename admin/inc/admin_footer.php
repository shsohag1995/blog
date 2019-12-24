
 <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
    	                <?php 
                                    $show_page_sql = "SELECT * FROM copyright where id=1";
                                    $show_page_query = $db->select($show_page_sql);
                                    if($show_page_query) {
                                        while($show_page_result = $show_page_query->fetch_array()) {
                                ?>
                                   <p>
                                    &copy; Copyright <a href=""><?php echo $show_page_result['copyright'];?></a>. All Rights Reserved.
                                   </p>
                                <?php
                                        }
                                    }
                                ?>
        
    </div>
</body>
</html>
