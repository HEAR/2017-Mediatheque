<!-- searchform.php -->

<!-- <form method="get" id="searchform" action="<?php bloginfo('home'); ?>/">
<div>
<input type="text" value="<?php the_search_query(); ?>" name="s" id="s" />
<input type="submit" id="searchsubmit" value="Chercher" />
</div>
</form>
 -->

<section class="search">
	<form class="navbar-form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<div class="form-group">
			<input type="text" name="s" class="form-control search-autocomplete" placeholder="Recherche">
		</div>
		<button type="submit" class="fa fa-search">Envoyer</button>
	</form>
</section>

<!-- fin searchform.php -->