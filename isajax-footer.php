<?php
global $is_ajax;
global $wp;
global $is_single;

// https://codex.wordpress.org/Function_Reference/home_url
$current_url = site_url( add_query_arg( array(), $wp->request ), "relative" );


if($is_ajax){
	echo json_encode(
		array(	"title" => get_the_title(),
				"relative_url" => $current_url,
				"is_single" => $is_single ,
				"body_class" => join( ' ', get_body_class() ),
				"content" => ob_get_clean(),
		)
	);
}

?>