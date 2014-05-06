<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( ' | ', true, 'right' ); ?></title>
<link rel="shortcut icon" href="<?php echo of_get_option( 'favicon', 'no entry' ); ?>" />

<!-- FONT IMPORTS -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>

<!--link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fonts/aqua/aqua.css" />
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fonts/fanwood/fanwood-webfont.css" /-->

<!-- STYLESHEET -->
<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_uri(); ?>" />

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/fonts/entypo/entypo.css" />

<?php wp_head(); ?> <?php //jquery is loaded in wp_head() ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/cycle2.min.js" type="text/javascript" language="javascript"></script>


<?php // theme colors

$cl1 = of_get_option( 'color1' );
$cl2 = of_get_option( 'color2' );
$cl3 = of_get_option( 'color3' );
$clbody = of_get_option( 'bodycolor' );
$clheader = of_get_option( 'headercolor' );
$clmenu = of_get_option( 'menucolor' );
$background = of_get_option( 'background' );

if ( $cl1 ) {

	if ( $cl2 ) {
		
	} else {
		$cl2 = $cl1;

		if ( $cl3 ) {
			
		} else {
			$cl3 = $cl2;
		}

	}

?>

<style type="text/css">

.cl1 {
	background:<?php echo $cl1; ?>;
}

.cl2, header nav li.current_page_item {
	background:<?php echo $cl2; ?>;
}

.cl3 {
	background:<?php echo $cl3; ?>;
}

.cl1b {
	border-color:<?php echo $cl1; ?>;
}

.cl2b {
	border-color:<?php echo $cl2; ?>;
}

.cl3b {
	border-color:<?php echo $cl3; ?>;
}

body, p, span, article, section {
	color:<?php echo $clbody; ?>;
}

h1, h2, h3, h4, h5, h6, a, a:link, a:active {
	color:<?php echo $clheader; ?>;
}

#header-menu ul li a {
	color:<?php echo $clmenu; ?>;
}

<?php if ( $background != '' ) { ?>
	
body {
	background-color:<?php echo $background[color]; ?>;
	background-image:url(<?php echo $background[image]; ?>);
	background-position: <?php echo $background[position]; ?>;
	background-attachment: <?php echo $background[attachment]; ?>;
	background-repeat: <?php echo $background[repeat]; ?>;
	<?php if ($background[attachment] == "fixed") {	?>	
	-webkit-background-size: cover;
	-moz-background-size: cover;
	-o-background-size: cover;
	background-size: cover;
	<?php } ?>
}

<?php } // end condition for background 
?>

</style>

<?php } // end condition for template colors 
?>


</head>

<body <?php body_class(); ?>>

<?php $wrapper = of_get_option( 'wrap' );

	if ( $wrapper ) {
	echo '<div id="wrapper" class="hfeed">';
	}

?>

<header id="header" role="banner">

<div id="headcopy" class="cl1">
  <div class="wrapper">
		<p><?php echo of_get_option( 'headertxt', 'not set' ); ?></p>
  </div>
</div>

  <div class="wrapper">

	<div id="header-main" class="full">

	<div id="topnav">

		<nav id="header-menu" role="navigation">
		<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
		</nav>

	</div>


	<div id="logo">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( get_bloginfo( 'name' )); ?>">
			<img src="<?php echo of_get_option( 'logo', 'no entry' ); ?>" alt="<?php esc_attr_e( get_bloginfo( 'name' )); ?>" border="0" />
		</a>
	</div>

	</div>

  </div>
</header>

<div id="container">