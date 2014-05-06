<?php get_header(); ?>

<?php 

//featured image and slideshow
$featured = of_get_option( 'featured' );
$enable_ss = of_get_option( 'enable_ss' );

//slideshow images
$img1 = of_get_option( 'img1' );
$img1capt = of_get_option( 'img1capt' );
$img2 = of_get_option( 'img2' );
$img2capt = of_get_option( 'img2capt' );
$img3 = of_get_option( 'img3' );
$img3capt = of_get_option( 'img3capt' );
$img4 = of_get_option( 'img4' );
$img4capt = of_get_option( 'img4capt' );

// slideshow variables
$imgsp = of_get_option( 'imgspeed' );
$imgdel = of_get_option( 'imgdelay' );
$imgtrans = of_get_option( 'imgtransition' );



if ( $enable_ss ) { ?>

	<section id="slider" 
	class="cycle-slideshow" 
	data-cycle-timeout="<?php echo $imgdel; ?>" 
	data-cycle-fx="<?php echo $imgtrans; ?>" 
	data-cycle-speed="<?php echo $imgsp; ?>" 
	data-cycle-overlay-plugin="caption2" 
	data-cycle-overlay-fx-out="fadeOut"
    data-cycle-overlay-fx-in="fadeIn"
    >

<?php if ( $img1 ) { ?> 
			<img src="<?php echo $img1; ?>"<?php if ( $img1capt ) { echo ' data-cycle-title="'.$img1capt.'" data-cycle-desc=""'; } ?> />
<?php } ?>
<?php if ( $img2 ) { ?> 
			<img src="<?php echo $img2; ?>"<?php if ( $img2capt ) { echo ' data-cycle-title="'.$img2capt.'" data-cycle-desc=""'; } ?> />
<?php } ?>
<?php if ( $img3 ) { ?> 
			<img src="<?php echo $img3; ?>"<?php if ( $img3capt ) { echo ' data-cycle-title="'.$img3capt.'" data-cycle-desc=""'; } ?> />
<?php } ?>
<?php if ( $img4 ) { ?> 
			<img src="<?php echo $img4; ?>"<?php if ( $img4capt ) { echo ' data-cycle-title="'.$img4capt.'" data-cycle-desc=""'; } ?> />
<?php } ?>

	<div class="cycle-overlay cl1"></div>

	<div id="progress" class="cl2"></div>

	</section>

	<script type="text/javascript">

		function overlayFade() {
			jQuery('.cycle-overlay').hide().fadeIn(<?php echo $imgsp; ?>).delay(<?php echo $imgdel-$imgsp; ?>).fadeOut(<?php echo $imgsp; ?>, overlayFade);
		}

		overlayFade();

		var progress = jQuery('#progress'),
		slideshow = jQuery( '.cycle-slideshow' );

		slideshow.on( 'cycle-initialized cycle-before', function( e, opts ) {
		    progress.stop(true).css( 'width', 0 );
		});

		slideshow.on( 'cycle-initialized cycle-after', function( e, opts ) {
		    if ( ! slideshow.is('.cycle-paused') )
		        progress.animate({ width: '100%' }, opts.timeout, 'linear' );
		});

		slideshow.on( 'cycle-paused', function( e, opts ) {
		   progress.stop(); 
		});

		slideshow.on( 'cycle-resumed', function( e, opts, timeoutRemaining ) {
		    progress.animate({ width: '100%' }, timeoutRemaining, 'linear' );
		});
		

	</script>


<?php } else {

	if ( $featured ) {

		echo '<section id="feature-img"><img src="'.$featured.'" /></section>';

	}	else {

		echo '<section id="featured-img"><img src="'.get_template_directory_uri().'/images/featured.jpg" /></section>';

	}

}

?>

<section id="content" class="home-content" role="main">
  <div class="wrapper">

	<div class="third left home-feature ">

		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage: Featured Left')) : ?>

			<h1>Kitty ipsum dolor sit amet</h1>

			<a href="#" class="featured-holder cl3b">
			<div class="featured-overlay cl2b"></div>
			<img src="http://placekitten.com/530/530/" />
			</a>

			<p>Jump stretching chuf attack hairball, I don't like that food eat the grass litter box toss the mousie sleep in the sink stretching. Jump sleep in the sink climb the curtains toss the mousie feed me jump on the table, fluffy fur meow feed me catnip. Biting sleep on your face sleep in the sink sleep on your face attack your ankles, feed me stretching fluffy fur eat knock over the lamp.</p>

		<?php endif; ?>

	</div>

	<div class="third left home-feature middle-feature cl3b">

		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage: Featured Center')) : ?>

			<h1>Claw sunbathe jump on the table</h1>

			<a href="#" class="featured-holder cl3b">
			<div class="featured-overlay cl2b"></div>
			<img src="http://placekitten.com/510/510/" />
			</a>

			<p>Scratched claw sleep on your face chuf leap, puking stuck in a tree claw jump on the table scratched knock over the lamp shed everywhere. Sleep in the sink I don't like that food attack sleep in the sink sniff eat the grass, I don't like that food stuck in a tree I don't like that food sleep on your keyboard leap. Fluffy fur bat chuf kittens sniff, catnip sleep on your keyboard stretching biting stuck in a tree litter box.</p>

		<?php endif; ?>

	</div>

	<div class="third right home-feature">

		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage: Featured Right')) : ?>
			
			<h1>Keyboard hairball litter</h1>

			<a href="#" class="featured-holder cl3b">
			<div class="featured-overlay cl2b"></div>
			<img src="http://placekitten.com/520/520/" />
			</a>

			<p>Attack your ankles rip the couch scratched hairball catnip sniff, attack your ankles rip the couch hairball scratched hiss. Jump on the table toss the mousie scratched stuck in a tree stuck in a tree bat, hiss bat give me fish sniff meow sleep on your face. Rip the couch lay down in your way bat sunbathe, meow give me fish sleep on your face chuf bat judging you eat the grass stuck in a tree.</p>

		<?php endif; ?>	

	</div>

<div class="clearfix"></div>

	<div class="full left home-subfeature cl1b">

			<div class="half right  cl3">

			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage: Featured Right')) : ?>

				<h1>Ac amet iaculis kittens</h1>

				<p>Faucibus iaculis rutrum mauris a vehicula, fluffy fur sniff claw judging you knock over the lamp. Vestibulum litter box cras nec quis attack your ankles shed everywhere, puking stretching tristique nunc leap non. Dolor tempus catnip leap rip the couch, sollicitudin nullam shed everywhere biting libero quis nunc. Pharetra nam claw bat justo, consectetur quis nunc litter box tristique. Non non accumsan bat, quis nunc neque tincidunt a rhoncus consectetur catnip. Faucibus vestibulum nullam sollicitudin, judging you claw give me fish rip the couch nibh sollicitudin I don't like that food. Etiam run judging you sniff, fluffy fur cras nec purr jump orci turpis tempus rip the couch.</p><p>

				Ac amet iaculis kittens, meow aliquam scratched sagittis sollicitudin I don't like that food tortor rip the couch. Meow vel rip the couch sniff feed me, run vehicula vestibulum orci turpis stretching. Scratched feed me elit vel tempus adipiscing, pellentesque stuck in a tree bat eat the grass suscipit nunc. Meow judging you nam vehicula consectetur dolor, in viverra eat the grass judging you run. Enim run elit orci turpis vel, suscipit judging you sunbathe hiss mauris a. Faucibus sleep on your keyboard elit claw libero cras nec, ac etiam attack your ankles scratched etiam. Claw bat chase the red dot eat ac, hairball nam catnip stuck in a tree iaculis. </p>

		<?php endif; ?>	

			</div>

	</div>

<div class="clearfix"></div>

	<div class="full left home-trailer cl2b">

		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage: Featured Right')) : ?>
			
			<h1>Faucibus iaculis rutrum</h1>

			<p>Attack lick litter box bat lick, knock over the lamp suspendisse zzz ac quis nunc dolor. Tempus tortor give me fish rutrum chase the red dot nunc, etiam catnip stretching chuf bat. Nibh sunbathe amet amet nullam ac, orci turpis tincidunt a litter box accumsan catnip ac. Attack stretching fluffy fur iaculis nunc, toss the mousie enim mauris a sunbathe sleep on your keyboard tortor sniff. Shed everywhere sleep on your keyboard vehicula tempus stuck in a tree amet, sleep in the sink sollicitudin attack hiss rhoncus dolor.</p>


		<?php endif; ?>	

	</div>

  </div>
</section>

 

<?php get_footer(); ?>