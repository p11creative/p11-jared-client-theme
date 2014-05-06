<?php get_header();

$rev = wpshed_get_custom_field( 'reverse' );
$sqft = wpshed_get_custom_field( 'sqft' );
$bed = wpshed_get_custom_field( 'beds' );
$bath = wpshed_get_custom_field( 'baths' );

?>

<section id="content" role="main">

<ul id="fp-details">
	<li><?php if ( is_numeric($bed) ) { 
		if ( $bed > 1 ) { 
				echo $bed." Bedrooms";
			} else { 
				echo $bed." Bedroom";
			} 
		} else { 
			echo $bed; 
		} ?></li>
	<li><?php if ( is_numeric($bath) ) { 
		if ( $bed > 1 ) { 
				echo $bed." Baths";
			} else { 
				echo $bed." Bath";
			} 
		} else { 
			echo $bed; 
		} ?></li>	
	<li><?php echo $sqft; ?></li>
</ul>

<?php if ($rev == 2) { ?>

<button id="standard" class="rev" onClick="javascript:swapRev(1);">Standard</button>
<button id="reverse" class="rev" onClick="javascript:swapRev(0);">Reverse</button>

<?php } ?>


<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div id="sta-img"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('full'); } //FLOORPLAN IMAGE ?></div>

<?php 

if ($rev == 2) { 
	echo '<div id="rev-img">';
	if (class_exists('MultiPostThumbnails') && $rev == 2) : 
		MultiPostThumbnails::the_post_thumbnail(get_post_type(), 'secondary-image', NULL,  'secondary-featured-thumbnail'); 
	endif; //REVERSE IMAGE 
	echo '</div>';
}

?>

<?php the_content(); ?>

<?php endwhile; endif; ?>

</section>
<?php get_sidebar(); ?>
<?php get_footer(); ?>