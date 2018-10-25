<?php get_template_part("isajax-header") ?>

<!-- ajax-single.php -->
<?php


$is_single = true;

global $posX;
global $posY;
global $zIndex;

$posX   = 32;
$posY   = 62;
$zIndex = 100;

?>
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

<?php 

global $data_legende;
$data_legende 			 = array();
$data_legende["title"] 	 = get_the_title();
$data_legende["duree"] 	 = get_field('duree');
$data_legende["date"] 	 = get_the_time('Y');
$data_legende["cote"] 	 = get_field('cote');
$data_legende["nom"] 	 = get_field('nom');
$data_legende["prenom"]  = get_field('prenom');
$data_legende["types"] 	 = "catégorie pour les types";
$data_legende["section"] = "catégorie pour les sections";
$data_legende["langue"]  = get_field('langue');

 ?>

<div class="solo draggable" data-id="post-<?php the_ID(); ?>" id="post-<?php the_ID(); ?>" style="top:<?= $posY; ?>px;left:<?= $posX; ?>px;z-index:<?= $zIndex; ?>;" data-legende="<?php echo htmlentities(json_encode($data_legende, JSON_HEX_APOS)); ?>">
	<div class="handle"></div>
	<div class="close"></div>
	
	<div class="scroll-container optiscroll">
		<div class="container">

			<div class="post_content">
				<?php the_content(); ?>
			</div>

			<ul class="meta">
				<li><span>Titre :</span><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"><?php the_title() ?></a></li>
				<li><span>Durée :</span><?php echo $data_legende["duree"] ?></li>
				<li><span>Date :</span><?php echo $data_legende["date"] ?></li>
				<li><span>Cote :</span><?php echo $data_legende["cote"] ?></li>
				<li><span>Nom :</span><?php echo $data_legende["prenom"] . ' ' .$data_legende["nom"] ?></li>
				<li><span>Types :</span><?php echo $data_legende["types"] ?></li>
				<li><span>Sections :</span><?php echo $data_legende["section"] ?></li>
				<li><span>Langue :</span><?php echo $data_legende["langue"] ?></li>
			</ul>
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