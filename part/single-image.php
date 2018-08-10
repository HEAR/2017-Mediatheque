<!-- image.php -->
<?php

global $posX;
global $posY;
global $zIndex;
global $data_legende;

$posX   += 20;
$posY   += 20;
$zIndex -= 1;

?>

<div class="solo draggable" style="top:<?= $posY; ?>px;left:<?= $posX; ?>px;z-index:<?= $zIndex; ?>;" data-legende="<?php echo htmlentities(json_encode($data_legende, JSON_HEX_APOS)); ?>">
	<div class="handle"></div>
	<div class="close"></div>
	
	<div class="media-container">

	<?php

		$image = get_sub_field('url');

		echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />'."\n";
	?>
	</div>
</div>


<!-- fin image.php -->
