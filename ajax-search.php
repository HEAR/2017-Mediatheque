<?php get_template_part("isajax-header") ?>

<!-- ajax-search.php -->

<?php $is_single = false; ?>

<section class="archives search-result">

	<ul>


<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

		<li class="publique" id="archive-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><span class="prenom">Prénom</span> <span class="nom">Nom</span> | <?php the_title(); ?></a</h2>
		</li>

<?php endwhile; ?>
<?php endif; ?>

	</ul>
</div>
<!-- fin ajax-search.php -->

<?php get_template_part("isajax-footer") ?>