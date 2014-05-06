<div class="clear"></div>
</div>

<?php $wrapper = of_get_option( 'wrap' );

if ( $wrapper ) {
echo '</div>';
}

?>

<footer id="footer" role="contentinfo" class="<?php if ( $wrapper ) { echo 'wrapperfix'; } ?>">
  <div class="wrapper">
	
	<div id="copyright" class="left helf">
	&copy;<?php echo " ".date( 'Y' )." ".get_bloginfo( 'name' ); ?>
	</div>
  
	<div class="right half tright">
	<?php echo of_get_option( 'footertxt', 'not set' ); ?>
	</div>

  </div>
</footer>

<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/functions.js" type="text/javascript" language="javascript"></script>

</body>
</html>