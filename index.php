<?php get_header(); ?>

<!-- index.php -->


<?php 

	// https://wordpress.stackexchange.com/questions/13484/how-to-get-all-posts-with-any-post-status

	global $wp_query;
	$original_query = $wp_query;
	$wp_query = null;
	$wp_query = new WP_Query(
		array(
			'post_status' => array('publish', 'private')
		)
	);
	
 ?>

<div id="content">
<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		<div class="post" id="post-<?php the_ID(); ?>">

		<?php if(get_post_status( $ID ) != 'private' ) : ?>

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


<?php 

	$wp_query = null;
	$wp_query = $original_query;
	wp_reset_postdata();

 ?>

<!-- fin index.php -->

<?php // get_sidebar(); ?>
<?php get_footer(); ?>