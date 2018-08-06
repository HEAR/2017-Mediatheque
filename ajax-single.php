<?php get_template_part("isajax-header") ?>

<!-- ajax-single.php -->

<?php $is_single = true; ?>


<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<div class="solo draggable" id="post-<?php the_ID(); ?>">
	<div class="handle"></div>
	
	<div class="container">
		<h2><?php the_title(); ?></h2>

		<p class="postmetadata"><?php the_time('j F Y') ?> par <?php the_author() ?> | Cat&eacute;gorie: <?php the_category(', ') ?>

		<div class="post_content">
		<?php the_content(); ?>
		</div>

	</div>
</div>


<?php

// check if the flexible content field has rows of data
if( have_rows('documents') ):

	// loop through the rows of data
	while ( have_rows('documents') ) : the_row();

		if( get_row_layout() == 'video' ):

			get_template_part("part/single", "video");

		elseif( get_row_layout() == 'pdf' ): 

			get_template_part("part/single", "pdf");

		elseif( get_row_layout() == 'image' ): 

			get_template_part("part/single", "image");

		endif;

	endwhile;

else :

	// no layouts found

endif;

?>



<?php endwhile; ?>
<?php endif; ?>

<!-- fin ajax-single.php -->


<?php get_template_part("isajax-footer") ?>