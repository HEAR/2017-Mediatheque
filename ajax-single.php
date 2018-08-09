<?php get_template_part("isajax-header") ?>

<!-- ajax-single.php -->
<?php


$is_single = true;

global $posX;
global $posY;
global $zIndex;

$posX   = 10;
$posY   = 10;
$zIndex = 100;

?>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
<div class="solo draggable" id="post-<?php the_ID(); ?>" style="top:<?= $posY; ?>px;left:<?= $posX; ?>px;z-index:<?= $zIndex; ?>;">
	<div class="handle"></div>
	
	<div class="container">
		<h2><?php the_title(); ?></h2>

		<p class="postmetadata"><?php the_time('j F Y') ?> par <?php the_author() ?> | Cat&eacute;gorie: <?php the_category(', ') ?>

		<div class="post_content">
		<?php the_content(); ?>
		</div>

		<div class="meta">
			<p><span class="duree"><?php the_field('duree'); ?></span> - (<span class="date"><?php the_time('Y') ?></span>)</p>
			<p class="cote"><?php the_field('cote'); ?></p>
			<p class="nom"><?php the_field('prenom'); ?> <?php the_field('nom'); ?></p>
			<p class="types"> -> catégorie ?</p>
			<p class="section"> -> catégorie ?</p>
			<p class="langue"><?php the_field('langue'); ?></p>
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