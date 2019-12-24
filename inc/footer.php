</div><!-- End of  class " contentsection contemplete clear "  -->

	<div class="footersection templete clear">
	  <div class="footermenu clear">

		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <?php 
	      $copyright_sql = "SELECT * FROM copyright WHERE id = '1'";
	      $copyright_query = $db->select($copyright_sql);
	      if($copyright_query) {
	          $copyright_result = $copyright_query->fetch_assoc();
	  ?>
	  <p>&copy; <?php echo $copyright_result['copyright']; echo " ".date('Y'); ?>.</p>
	  <?php } ?>
	</div>
	<div class="fixedicon clear">
		<?php 
		    $socialmedia_sql = "SELECT * FROM tbl_socialmedia WHERE id = '1'";
		    $socialmedia_query = $db->select($socialmedia_sql);
		    if($socialmedia_query) {
		        $socialmedia_result = $socialmedia_query->fetch_assoc();
		?>
		<a href="<?php echo $socialmedia_result['fb'];?>"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?php echo $socialmedia_result['tw'];?>"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?php echo $socialmedia_result['ln'];?>"><img src="images/in.png" alt="LinkedIn"/></a>
		<a href="<?php echo $socialmedia_result['gp'];?>"><img src="images/gl.png" alt="GooglePlus"/></a>
		<?php } else { echo "<script>alert('Please ask your developer to add social icons');</script>";}
		?>
	</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
<script id="dsq-count-scr" src="//tech-khalid.disqus.com/count.js" async></script>
</body>
</html> 