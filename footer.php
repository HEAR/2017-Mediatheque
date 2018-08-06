<!-- footer.php -->


</div> <!-- fin fond -->


<div id="overlay"></div>



<nav class="draggable">
	<div class="handle"></div>
	<?php
	if ( has_nav_menu( 'main_menu' ) ) {
		wp_nav_menu( array('menu'=>'main_menu') );
	}
	?>
	<div class="col2"></div>
	<div class="col3"></div>
</nav>


</main>


<!-- <?php echo get_num_queries(); ?> requêtes. <?php timer_stop(1); ?> secondes. -->

<?php wp_footer(); ?>
</body>
</html>