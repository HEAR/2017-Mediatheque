<!-- pdf.php -->


<div class="solo draggable">
	<div class="handle"></div>
	
	<div class="container">

<?php

$downloads = get_sub_field('download');

if( $downloads ):
	foreach( $downloads as $post):
		setup_postdata($post);
		
		// https://tech-tamer.com/how-to-keep-an-uploaded-file-private-in-wordpress/
		// https://wordpress.org/plugins/download-monitor/
		// https://www.download-monitor.com/kb/download-repository-retrieve_single/
		// https://www.shawnhooper.ca/2015/01/01/protect-wordpress-attachments-pdfs/
		// https://wordpress.org/support/topic/cannot-acces-private-property-dlm_downloadid/
		try {

			$download = download_monitor()->service( 'download_repository' )->retrieve_single( get_the_ID() );
			echo "<a href='".$download->get_the_download_link()."' class='pdf' rel='nofollow'>".$download->get_the_title()."</a>\n" ;

		} catch ( Exception $exception ) {
			// no download with ID 4 found
		}

		break;
	endforeach;
	wp_reset_postdata();
endif;

?>
	</div>
</div>

<!-- fin pdf.php -->
