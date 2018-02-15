<?php get_header(); ?>

<!-- archive.php -->



<section class="archives">

	<ul>
		

<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>

		<li class="publique">
			<h2><span class="prenom">Prénom</span> <span class="nom">Nom</span></h2>

			<h2><?php the_title(); ?></h2>

		<div class="post" id="post-<?php the_ID(); ?>">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
				<!-- 
				<p class="postmetadata"><?php the_time('j F Y') ?> par <?php the_author() ?> | Cat&eacute;gorie: <?php the_category(', ') ?> | <?php comments_popup_link('Pas de commentaires', '1 Commentaire', '% Commentaires'); ?> <?php edit_post_link('Editer', ' &#124; ', ''); ?></p>
				
				<div class="post_content">
					<?php the_excerpt(); ?>
				</div> -->
		</div>
	
		</li>

<?php endwhile; ?>
<?php endif; ?>

	</ul>
</div>

<!-- fin archive.php -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>