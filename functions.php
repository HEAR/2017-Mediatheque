<?php


if ( function_exists('register_nav_menus') )
register_nav_menus(
	array(
		'main_menu'	=> __('Menu principal')
	)
);

// https://wordpress.stackexchange.com/questions/13484/how-to-get-all-posts-with-any-post-status

// !!! http://boiteaweb.fr/la-navigation-avec-ajax-7743.html


add_filter( 'template_include', 'comgraph_template_include' );
function comgraph_template_include( $template ) {
	if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH']== 'comgraphXMLHttpRequest' ):
		$pre = dirname( $template );
		$suf = basename( $template );
		$_template = $pre . '/ajax-' . $suf;
		if( !file_exists( $_template ) )
			$_template = $template;
		$template = $_template;
	endif;
	return $template;
}

// Pour enlever la mention «Protégé : » ou «Privé : » du titre
// https://css-tricks.com/snippets/wordpress/remove-privateprotected-from-post-titles/#comment-73313
function title_format($content) {
	return '🔒%s';
}
add_filter('private_title_format', 'title_format');
add_filter('protected_title_format', 'title_format');



// http://www.geekpress.fr/wp-query-creez-des-requetes-personnalisees-dans-vos-themes-wordpress/
// https://www.billerickson.net/customize-the-wordpress-query/
// https://wordpress.stackexchange.com/questions/13484/how-to-get-all-posts-with-any-post-status
function mediatheque_query($query) {

    if($query->is_main_query() ):
        
    	$query->set( 'order', 'ASC' );
    	$query->set( 'posts_per_page', '-1' );
    	$query->set( 'post_status' , array('publish', 'private') );

    endif;

}
add_action('pre_get_posts', 'mediatheque_query');


// MOTEUR DE RECHERCHE
// https://gist.github.com/jaredatch/27c42dfdf02b20256cf7b160ab6e55db

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ja_global_enqueues() {
	wp_enqueue_style(
		'jquery-auto-complete',
		'https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.css',
		array(),
		'1.0.7'
	);
	wp_enqueue_script(
		'jquery-auto-complete',
		'https://cdnjs.cloudflare.com/ajax/libs/jquery-autocomplete/1.0.7/jquery.auto-complete.min.js',
		array( 'jquery' ),
		'1.0.7',
		true
	);
	wp_enqueue_script(
		'jquery-ui-draggable'
	);
	wp_enqueue_script(
		'global',
		get_template_directory_uri() . '/js/global.min.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);
	wp_enqueue_script(
		'mediatheque',
		get_template_directory_uri() . '/js/script.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);
	wp_localize_script(
		'global',
		'global',
		array(
			'search_api' => home_url( 'wp-json/ja/v1/search' )
		)
	);
}
add_action( 'wp_enqueue_scripts', 'ja_global_enqueues' );



/**
 * WP REST API register custom endpoints
 *
 * @since 1.0.0
 */
function ja_rest_api_register_routes() {
	register_rest_route( 'ja/v1', '/search', array(
		'methods'  => 'GET',
		'callback' => 'ja_rest_api_search',
	) );
}
add_action( 'rest_api_init', 'ja_rest_api_register_routes' );
/**
 * WP REST API search results.
 *
 * @since 1.0.0
 * @param object $request
 */
function ja_rest_api_search( $request ) {
	if ( empty( $request['term'] ) ) {
		return;
	}
	$results = new WP_Query( array(
		'post_type'     => array( 'post', 'page' ),
		'post_status'   => 'publish',
		'posts_per_page'=> 30,
		's'             => $request['term'],
	) );
	if ( !empty( $results->posts ) ) {
		return $results->posts;
	}
}