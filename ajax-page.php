<?php get_template_part("isajax-header") ?>

<!-- ajax-page.php -->

<?php $is_single = false; ?>

<section class="page" id="post-<?php the_ID(); ?>">
	<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
		
		<h2><?php the_title(); ?></h2>				
		<div class="post_content">
		<?php the_content(); ?>
		</div>


	<?php endwhile; ?>
	<?php else : ?>
		<p>Désolé, mais vous cherchez quelque chose qui ne se trouve pas ici.</p>
	<?php endif; ?>
</section>

<!-- fin ajax-page.php -->

<?php get_template_part("isajax-footer") ?>