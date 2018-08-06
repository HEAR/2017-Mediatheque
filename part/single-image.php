<!-- image.php -->
<div class="solo draggable">
	<div class="handle"></div>
	
	<div class="media-container">

	<?php

		$image = get_sub_field('url');

		echo '<img src="' . $image['url'] . '" alt="' . $image['alt'] . '" />'."\n";
	?>
	</div>
</div>


<!-- fin image.php -->
