<!-- footer.php -->


	</div> <!-- fin fond -->


	<div id="overlay"></div>



	<nav class="draggable">
		<div class="handle"></div>
		<?php
		if ( has_nav_menu( 'main_menu' ) ) {
			wp_nav_menu( array('menu'=>'main_menu') );
		}
		?>
		<div class="col2"></div>
		<div class="col3"></div>
	</nav>


	<footer>
		<button class="close-all"><!-- Generator: Adobe Illustrator 22.1.0, SVG Export Plug-In  -->
			<svg version="1.1"
				 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
				 x="0px" y="0px" width="22.36px" height="22.36px" viewBox="0 0 22.36 22.36" enable-background="new 0 0 22.36 22.36"
				 xml:space="preserve">
			<defs>
			</defs>
			<g>
				<rect x="10.18" y="-3.631" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -4.6311 11.1798)" width="2" height="29.622"/>
			</g>
			<g>
				<rect x="-3.631" y="10.18" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -4.6311 11.1802)" width="29.622" height="2"/>
			</g>
			</svg>
		</button>
		<button class="prev"><!-- Generator: Adobe Illustrator 22.1.0, SVG Export Plug-In  -->
			<svg version="1.1"
				 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
				 x="0px" y="0px" width="14px" height="16px" viewBox="0 0 14 16" enable-background="new 0 0 14 16" xml:space="preserve">
			<defs>
			</defs>
			<g>
				<polygon points="14,0 14,16 0,8.615"/>
			</g>
			</svg>
		</button>
		<button class="next"><!-- Generator: Adobe Illustrator 22.1.0, SVG Export Plug-In  -->
			<svg version="1.1"
				 xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:a="http://ns.adobe.com/AdobeSVGViewerExtensions/3.0/"
				 x="0px" y="0px" width="14px" height="16px" viewBox="0 0 14 16" enable-background="new 0 0 14 16" xml:space="preserve">
			<defs>
			</defs>
			<g>
				<polygon points="0,0 0,16 14,8.615"/>
			</g>
			</svg>
		</button>
		<!-- <p>Copyright blablabla 2018</p> -->
	</footer>


</main>


<!-- <?php echo get_num_queries(); ?> requêtes. <?php timer_stop(1); ?> secondes. -->

<?php wp_footer(); ?>
</body>
</html>