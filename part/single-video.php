<!-- video.php -->
<?php

global $posX;
global $posY;
global $zIndex;
global $data_legende;

$posX   += 20;
$posY   += 20;
$zIndex -= 1;

?>
<div class="solo draggable" data-id="post-<?php the_ID(); ?>"  style="top:<?= $posY; ?>px;left:<?= $posX; ?>px;z-index:<?= $zIndex; ?>;" data-legende="<?php echo htmlentities(json_encode($data_legende, JSON_HEX_APOS)); ?>">
	<div class="handle"></div>
	<div class="close"></div>
	
	<div class="scroll-container">
		<div class="media-container optiscroll">
			<?php

			$iframe = get_sub_field('url');

			// use preg_match to find iframe src
			preg_match('/src="(.+?)"/', $iframe, $matches);
			$src = $matches[1];

			// add extra params to iframe src
			$params = array(
				'controls'    => 0,
				'hd'        => 1,
				'autohide'    => 1
			);

			$new_src = add_query_arg($params, $src);
			$iframe = str_replace($src, $new_src, $iframe);
			$attributes = 'frameborder="0"';
			$iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);
			echo "$iframe\n";

			?>
		</div>
	</div>
</div>
<!-- fin video.php -->
