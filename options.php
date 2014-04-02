<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = wp_get_theme();
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Background Defaults
	$background_defaults = array(
		'color' => '#eeeeee',
		'image' => '',
		'repeat' => 'no-repeat',
		'position' => 'center center',
		'attachment'=>	'fixed' );


	$options_trans = array(
		'fade' => 'Fade',
		'scrollHorz' => 'Scroll'
		);

	// Typography Options
/*	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Aqua' => 'Aqua', 'Arvo Regular' => 'Arvo Regular', 'Cassannet' => 'Cassannet', 'Chunk Five' => 'ChunkFive', 'Fanwood' => 'Fanwood', 'Forum' => 'Forum', 'Habana' => 'Habana', 'Helvetica Neue' => 'Helvetica Neue', 'Kankin' => 'Kankin', 'Neutratext Book' => 'Neutratext Book', 'Nevis' => 'Nevis Bold' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => '#cccccc'
	); */


	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/images/';


	$options = array();


	$options[] = array(
		'name' => __('Layout', 'options_framework_theme'),
		'type' => 'heading');


	$options[] = array(
		'name' => __('Logo', 'options_framework_theme'),
		'desc' => __('Logo to appear in header. Will be set to 300px wide. Please upload at 600px wide.', 'options_framework_theme'),
		'id' => 'logo',
		'type' => 'upload');

	$options[] = array(
		'name' => __('Favicon', 'options_framework_theme'),
		'desc' => __('Favicon should be 16px-16px .ico format.', 'options_framework_theme'),
		'id' => 'favicon',
		'type' => 'upload');

	$options[] = array(
		'name' => __('', 'options_framework_theme'),
		'desc' => __('<hr>', 'options_framework_theme'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Wrap Site', 'options_framework_theme'),
		'desc' => __('Wrap the site to a maximum width of 1,200 pixels instead of full-width.', 'options_framework_theme'),
		'id' => 'wrap',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => "Sidebar Position",
		'desc' => "Select weather to use a sidebar and where it should be located.",
		'id' => "example_images",
		'std' => "2c-l-fixed",
		'type' => "images",
		'options' => array(
			'1col-fixed' => $imagepath . '1col.png',
			'2c-l-fixed' => $imagepath . '2cl.png',
			'2c-r-fixed' => $imagepath . '2cr.png')
	);

	$options[] = array(
		'name' => __('', 'options_framework_theme'),
		'desc' => __('<hr>', 'options_framework_theme'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Address', 'options_framework_theme'),
		'desc' => __('Enter the street address of the leaseing center or community.', 'options_framework_theme'),
		'id' => 'address',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Hours', 'options_framework_theme'),
		'desc' => __('Define the operational hours.', 'options_framework_theme'),
		'id' => 'hours',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('Header Text', 'options_framework_theme'),
		'desc' => __('Text to include in the header.', 'options_framework_theme'),
		'id' => 'headertxt',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Footer Text', 'options_framework_theme'),
		'desc' => __('Text to include in the footer.', 'options_framework_theme'),
		'id' => 'footertxt',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Disclaimer', 'options_framework_theme'),
		'desc' => __('Disclaimer text.', 'options_framework_theme'),
		'id' => 'disclaimer',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => __('', 'options_framework_theme'),
		'desc' => __('<hr><p>Further homepage content is managed through widget areas. The sidebar content is also managed through widgets.</p>', 'options_framework_theme'),
		'type' => 'info');





	$options[] = array(
		'name' => __('Homepage Slides', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' => __('Featured Image', 'options_framework_theme'),
		'desc' => __('If you do not wish to enable the slideshow, this featured image will show instead.', 'options_framework_theme'),
		'std' => '/images/featured.gif',
		'id' => 'featured',
		'type' => 'upload');	

	$options[] = array(
		'name' => __('', 'options_framework_theme'),
		'desc' => __('<hr>', 'options_framework_theme'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Enable Slideshow', 'options_framework_theme'),
		'desc' => __('If enabled, the homepage will feature a rotating image slideshow.', 'options_framework_theme'),
		'id' => 'enable_ss',
		'std' => '1',
		'type' => 'checkbox');

	$options[] = array(
		'name' => __('Image 1', 'options_framework_theme'),
		'desc' => __('Set image to be cycled through in homepage slideshow.', 'options_framework_theme'),
		'id' => 'img1',
		'type' => 'upload');	

	$options[] = array(
		'name' => __('Image 1 Caption', 'options_framework_theme'),
		'desc' => __('Set caption for image. Leave blank for no caption.', 'options_framework_theme'),
		'id' => 'img1capt',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 2', 'options_framework_theme'),
		'desc' => __('Set image to be cycled through in homepage slideshow.', 'options_framework_theme'),
		'id' => 'img2',
		'type' => 'upload');	

	$options[] = array(
		'name' => __('Image 2 Caption', 'options_framework_theme'),
		'desc' => __('Set caption for image. Leave blank for no caption.', 'options_framework_theme'),
		'id' => 'img2capt',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 3', 'options_framework_theme'),
		'desc' => __('Set image to be cycled through in homepage slideshow.', 'options_framework_theme'),
		'id' => 'img3',
		'type' => 'upload');	

	$options[] = array(
		'name' => __('Image 3 Caption', 'options_framework_theme'),
		'desc' => __('Set caption for image. Leave blank for no caption.', 'options_framework_theme'),
		'id' => 'img3capt',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Image 4', 'options_framework_theme'),
		'desc' => __('Set image to be cycled through in homepage slideshow.', 'options_framework_theme'),
		'id' => 'img4',
		'type' => 'upload');	

	$options[] = array(
		'name' => __('Image 4 Caption', 'options_framework_theme'),
		'desc' => __('Set caption for image. Leave blank for no caption.', 'options_framework_theme'),
		'id' => 'img4capt',
		'std' => '',
		'type' => 'text');

	$options[] = array(
		'name' => __('Slideshow Speed', 'options_framework_theme'),
		'desc' => __('Length in which each slide is shown. Units in miliseconds. (5 seconds = 5000)', 'options_framework_theme'),
		'id' => 'imgdelay',
		'std' => '5000',
		'type' => 'text',
		'class' => 'mini' );

	$options[] = array(
		'name' => __('Transition Speed', 'options_framework_theme'),
		'desc' => __('Duration of slide transitions. Units in miliseconds. (1 1/2 seconds = 1500)', 'options_framework_theme'),
		'id' => 'imgspeed',
		'std' => '1500',
		'type' => 'text',
		'class' => 'mini' );

	$options[] = array(
		'name' => __('Select a Transition', 'options_framework_theme'),
		'desc' => __('Set how the slides will transition.', 'options_framework_theme'),
		'id' => 'imgtransition',
		'type' => 'select',
		'class' => 'mini',
		'options' => $options_trans);






	$options[] = array(
		'name' => __('Colors and Backgrounds', 'options_framework_theme'),
		'type' => 'heading');

	$options[] = array(
		'name' =>  __('Site Background', 'options_framework_theme'),
		'desc' => __('Change the background CSS.', 'options_framework_theme'),
		'id' => 'background',
		'std' => $background_defaults,
		'type' => 'background' );

	$options[] = array(
		'name' => __('', 'options_framework_theme'),
		'desc' => __('<hr>', 'options_framework_theme'),
		'type' => 'info');

	$options[] = array(
		'name' => __('Color #1', 'options_framework_theme'),
		'desc' => __('This color will appear throughout the site.', 'options_framework_theme'),
		'id' => 'color1',
		'std' => '#333333',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Color #2', 'options_framework_theme'),
		'desc' => __('This color will appear throughout the site. Leave blank to enherant color 1.', 'options_framework_theme'),
		'id' => 'color2',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Color #3', 'options_framework_theme'),
		'desc' => __('This color will appear throughout the site. Leave blank to enherant color 2.', 'options_framework_theme'),
		'id' => 'color3',
		'std' => '',
		'type' => 'color' );

	$options[] = array(
		'name' => __('', 'options_framework_theme'),
		'desc' => __('<hr>', 'options_framework_theme'),
		'type' => 'info');


	$options[] = array(
		'name' => __('Body Text', 'options_framework_theme'),
		'desc' => __('This sets the color of your body text.', 'options_framework_theme'),
		'id' => 'bodycolor',
		'std' => '#333333',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Header Text', 'options_framework_theme'),
		'desc' => __('This sets the color of your header text.', 'options_framework_theme'),
		'id' => 'headercolor',
		'std' => '#333333',
		'type' => 'color' );

	$options[] = array(
		'name' => __('Menu Text', 'options_framework_theme'),
		'desc' => __('This sets the color of your menu links.', 'options_framework_theme'),
		'id' => 'menucolor',
		'std' => '#ffffff',
		'type' => 'color' );




/* I might not want to do this... seems hard... 

	$options[] = array(
		'name' => __('Fonts', 'options_framework_theme'),
		'type' => 'heading' );

	$options[] = array( 'name' => __('Body Font', 'options_framework_theme'),
		'desc' => __('Select which font to use for paragrah text.', 'options_framework_theme'),
		'id' => "body_text",
		'std' => $typography_options,
		'type' => 'typography',
		'options' => $typography_options );

	$options[] = array(
		'name' => __('Header Font', 'options_framework_theme'),
		'desc' => __('Select which font to use for headers text.', 'options_framework_theme'),
		'id' => "header_text",
		'std' => $typography_options,
		'type' => 'typography',
		'options' => $typography_options );

		$options[] = array(
		'name' => __('Menu Font', 'options_framework_theme'),
		'desc' => __('Select which font to use for the navigation menu.', 'options_framework_theme'),
		'id' => "header_text",
		'std' => $typography_options,
		'type' => 'typography',
		'options' => $typography_options );

*/

	/**
	 * For $settings options see:
	 * http://codex.wordpress.org/Function_Reference/wp_editor
	 *
	 * 'media_buttons' are not supported as there is no post to attach items to
	 * 'textarea_name' is set by the 'id' you choose
	 */

/*	$wp_editor_settings = array(
		'wpautop' => true, // Default
		'textarea_rows' => 5,
		'tinymce' => array( 'plugins' => 'wordpress' )
	);

	$options[] = array(
		'name' => __('Default Text Editor', 'options_framework_theme'),
		'desc' => sprintf( __( 'You can also pass settings to the editor.  Read more about wp_editor in <a href="%1$s" target="_blank">the WordPress codex</a>', 'options_framework_theme' ), 'http://codex.wordpress.org/Function_Reference/wp_editor' ),
		'id' => 'example_editor',
		'type' => 'editor',
		'settings' => $wp_editor_settings );
*/		

	return $options;
}