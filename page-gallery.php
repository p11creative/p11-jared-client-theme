<?php
/*
Template Name: Gallery
*/

get_header(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/inc/galleria-flickr/galleria-1.3.5.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/inc/galleria-flickr/plugins/flickr/galleria.flickr.min.js"></script>

<section id="content" class="page full" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


<section id="featured-img" class="gallery cl2b">
  <div class="wrapper">

	<h1 class="cl1 gallery-title"><?php the_title(); ?></h1> 

	<div id="galleria">

	<script>

		jQuery(document).ready(function() {

			Galleria.loadTheme('<?php echo get_template_directory_uri(); ?>/inc/galleria-flickr/themes/twelve/galleria.twelve.min.js');

			Galleria.run('#galleria');
			
			Galleria.configure({
				flickr: 'set:<?php echo wpshed_get_custom_field( 'galset' ); ?>',
					transition: 'fadeslide',
					transitionSpeed: 1200,
					// width: 1200,
					// height: 550,
					flickrOptions:{    
					imageSize: 'big', 
					thumbSize: 'small'
				}
			});

		});

	</script>

	</div>

  </div>
</section>

<section class="entry-content full cl3b">
  <div class="wrapper">
<?php the_content(); ?>

<?php edit_post_link(); ?>

  </div>
</section>
</article>

<?php endwhile; endif; ?>
</section>




<?php get_footer(); ?>