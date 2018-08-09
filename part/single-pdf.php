<!-- pdf.php -->
<?php

global $posX;
global $posY;
global $zIndex;

$posX   += 20;
$posY   += 20;
$zIndex -= 1;

?>

<div class="solo draggable" style="top:<?= $posY; ?>px;left:<?= $posX; ?>px;z-index:<?= $zIndex; ?>;">
	<div class="handle"></div>
	
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

			echo "<div class='media-container'><a href='". $download->get_the_download_link() ."' class='pdf' rel='nofollow'>". $download->get_the_image() . "</a></div>\n";
			echo "<div class='container'>PDF : <a href='". $download->get_the_download_link() ."' class='pdf' rel='nofollow'><h2>" . $download->get_the_title() . "</h2>" ."</a></div>\n" ;

		} catch ( Exception $exception ) {
			// no download with ID 4 found
		}

		break;
	endforeach;
	wp_reset_postdata();
endif;

?>

</div>

<!-- fin pdf.php -->
