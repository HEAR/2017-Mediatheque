<?php get_template_part("isajax-header") ?>

<!-- ajax-search.php -->

<?php $is_single = false; ?>

<section class="archives search-result">

	<ul>


<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

		<?php 

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

		<li class="publique" id="archive-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" data-legende="<?php echo htmlentities(json_encode($data_legende, JSON_HEX_APOS)); ?>"><span class="prenom"><?php the_field('prenom'); ?></span> <span class="nom"><?php the_field('nom'); ?></span><!--  | <?php the_title(); ?> --></a></h2>
		</li>

<?php endwhile; ?>
<?php endif; ?>

	</ul>
</div>
<!-- fin ajax-search.php -->

<?php get_template_part("isajax-footer") ?>