<?php get_template_part("isajax-header") ?>
<?php // get_header(); ?>


<!-- index.php -->

<?php $is_single = false; ?>

<?php get_search_form(); ?>
 

 <div id="main"></div>


<!--
<div id="content">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">

		<?php if(get_post_status( $ID ) != 'private' || is_user_logged_in() ) : ?>

			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
			
			<p class="postmetadata"><?php the_time('j F Y') ?> par <?php the_author() ?> | Cat&eacute;gorie: <?php the_category(', ') ?> | <?php comments_popup_link('Pas de commentaires', '1 Commentaire', '% Commentaires'); ?> <?php edit_post_link('Editer', ' &#124; ', ''); ?></p>
			
			<div class="post_content">
			
				<?php the_content(); ?>

			</div>
			
		<?php else : ?>

			<h2><?php the_title(); ?></h2>
			
			<p class="postmetadata"><?php the_time('j F Y') ?> par <?php the_author() ?> | Cat&eacute;gorie: <?php the_category(', ') ?> | <?php comments_popup_link('Pas de commentaires', '1 Commentaire', '% Commentaires'); ?> <?php edit_post_link('Editer', ' &#124; ', ''); ?></p>
			
			<div class="post_content">
			
				<p>Vous n'avez pas accès à ce contenu</p>

			</div>

		<?php endif; ?>

		</div>


		
<?php endwhile; ?>
<div class="navigation">
<?php posts_nav_link(' - ','page suivante','page pr&eacute;c&eacute;dente'); ?>
</div>
<?php else : ?>
<h2>Oooopppsss...</h2>
<p>Désolé, mais vous cherchez quelque chose qui ne se trouve pas ici .</p>
<?php include (TEMPLATEPATH . "/searchform.php"); ?>
<?php endif; ?>
</div>
-->

<?php 

	$wp_query = null;
	$wp_query = $original_query;
	wp_reset_postdata();

 ?>

<!-- fin index.php -->

<?php // get_sidebar(); ?>
<?php // get_footer(); ?>

<?php get_template_part("isajax-footer") ?>