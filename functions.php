<?php


if ( function_exists('register_nav_menus') )
register_nav_menus(
	array(
		'main_menu'	=> __('Menu principal')
	)
);

// http://www.geekpress.fr/suppression-accents-media/
add_filter('sanitize_file_name', 'remove_accents' );




/**
 * [annee_agenda_taxo_init description]
 * @return [type] [description]
 */
function annee_taxo_init() {
	// create a new taxonomy

	register_taxonomy(
		'annee',
		'post',
		array(
			'label' => __( 'Année Scolaire' ),
			'rewrite' => array( 'slug' => 'annee_scolaire' ),
			'hierarchical' => true,
			'show_admin_column' => true,
		)
	);
}

add_action( 'init', 'annee_taxo_init' );


$is_ajax = false;

// https://wordpress.stackexchange.com/questions/13484/how-to-get-all-posts-with-any-post-status
// http://www.geekpress.fr/tuto-ajax-wordpress-methode-simple/
// !!! http://boiteaweb.fr/la-navigation-avec-ajax-7743.html
add_filter( 'template_include', 'comgraph_template_include' );
function comgraph_template_include( $template ) {
	global $is_ajax;

	if( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && $_SERVER['HTTP_X_REQUESTED_WITH']== 'comgraphXMLHttpRequest' ):

		$is_ajax = true;

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

    if( $query->is_main_query()  && ! $query->is_single() && ! $query->is_singular() && ! $query->is_page() ):
        
		// $query->set( 'orderby', 'meta_value');	
		// $query->set( 'meta_key', 'nom');
		// $query->set( 'order', 'ASC' );

		// $query->set( 'orderby', array('nom' => 'ASC' ));	
		// 	$query->set( 'orderby',
		// 		array(
		// 		'nom' => 'ASC',
		// 		'prenom' => 'ASC'
		// 	)
		// );


    	// https://wordpress.stackexchange.com/questions/225533/order-by-multiple-meta-keys-in-pre-get-posts/261769
    	// https://support.advancedcustomfields.com/forums/topic/pre_get_posts-order-posts-by-two-different-meta_keys-acf-select-field/
		$query->set('meta_query', array(
			'nom' => array(
				'key' => 'nom',
			),
			'prenom' => array(
				'key' => 'prenom',
			)                    
		));
		 
		$query->set( 'orderby', array(
			'nom' => 'ASC',
			'prenom' => 'ASC'			
		)); 
		
    	$query->set( 'posts_per_page', '-1' );
    	$query->set( 'post_status' , array('publish', 'private') );

    endif;

}

add_action('pre_get_posts', 'mediatheque_query');

// add_filter('pre_get_posts', 'mediatheque_order', 9);





// MOTEUR DE RECHERCHE
// https://gist.github.com/jaredatch/27c42dfdf02b20256cf7b160ab6e55db
// https://goodies.pixabay.com/jquery/auto-complete/demo.html
// https://github.com/Pixabay/jQuery-autoComplete

/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function ja_global_enqueues() {
	wp_enqueue_style(
		'my-mediatheque-extension',
		get_template_directory_uri() . '/style.css',
		array( 'jquery-auto-complete','optiscroll' ),
		'1.0.0'
	);

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
		'scrollto',
		get_template_directory_uri() . '/js/jquery.scrollTo-2.1.2/jquery.scrollTo.min.js',
		array('jquery'),
		'2.1.2'
	);
	wp_enqueue_style(
		'optiscroll',
		get_template_directory_uri() . '/js/Optiscroll-3.2.0/dist/optiscroll.css',
		array(),
		'3.2.0'
	);
	wp_enqueue_script(
		'optiscroll',
		get_template_directory_uri() . '/js/Optiscroll-3.2.0/dist/jquery.optiscroll.min.js',
		array( 'jquery' ),
		'3.2.0'
	);
	wp_enqueue_script(
		'jquery-ui-draggable'
	);
	wp_enqueue_script(
		'jquery-ui-resizable'
	);
	wp_enqueue_script(
		'fitvids',
		get_template_directory_uri() . '/js/jquery.fitvids.js',
		array( 'jquery' ),
		'1.0.0',
		true
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
		array( 'jquery','fitvids','global','jquery-ui-draggable','jquery-ui-resizable','optiscroll' ),
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


/**
 * [force_relative_url description]
 * https://wordpress.stackexchange.com/questions/63323/get-permalink-without-domain-i-e-get-relative-permalink
 * @param  [type] $url [description]
 * @return [type]      [description]
 */
function force_relative_url ($url){
    return preg_replace ('/^(http)?s?:?\/\/[^\/]*(\/?.*)$/i', '$2', '' . $url);
}