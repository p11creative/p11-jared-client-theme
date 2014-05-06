<?php
add_action( 'after_setup_theme', 'blankslate_setup' );
function blankslate_setup()
{
load_theme_textdomain( 'blankslate', get_template_directory() . '/languages' );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
global $content_width;
if ( ! isset( $content_width ) ) $content_width = 640;
register_nav_menus(
array( 'main-menu' => __( 'Main Menu' ) )
);
}
add_action( 'wp_enqueue_scripts', 'blankslate_load_scripts' );
function blankslate_load_scripts()
{
wp_enqueue_script( 'jquery' );
}
add_action( 'comment_form_before', 'blankslate_enqueue_comment_reply_script' );
function blankslate_enqueue_comment_reply_script()
{
if ( get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }
}
add_filter( 'the_title', 'blankslate_title' );
function blankslate_title( $title ) {
if ( $title == '' ) {
return '&rarr;';
} else {
return $title;
}
}
add_filter( 'wp_title', 'blankslate_filter_wp_title' );
function blankslate_filter_wp_title( $title )
{
return $title . esc_attr( get_bloginfo( 'name' ) );
}
add_action( 'widgets_init', 'blankslate_widgets_init' );
function blankslate_widgets_init()
{
register_sidebar( array (
'name' => __( 'Sidebar Widget Area'),
'id' => 'primary-widget-area',
'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
'after_widget' => "</li>",
'before_title' => '<h3 class="widget-title">',
'after_title' => '</h3>',
) );

register_sidebar( array (
'name' => __( 'Homepage: Featured Left' ),
'id' => 'featured-left',
'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
'after_widget' => "</div>",
'before_title' => '<h1 class="featured-title">',
'after_title' => '</h1>',
) );

register_sidebar( array (
'name' => __( 'Homepage: Featured Center' ),
'id' => 'featured-center',
'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
'after_widget' => "</div>",
'before_title' => '<h1 class="featured-title">',
'after_title' => '</h1>',
) );

register_sidebar( array (
'name' => __( 'Homepage: Featured Right' ),
'id' => 'featured-right',
'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
'after_widget' => "</div>",
'before_title' => '<h1 class="featured-title">',
'after_title' => '</h1>',
) );

register_sidebar( array (
'name' => __( 'Homepage: Subfeature' ),
'id' => 'subfeature',
'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
'after_widget' => "</div>",
'before_title' => '<h1 class="featured-title">',
'after_title' => '</h1>',
) );

}
function blankslate_custom_pings( $comment )
{
$GLOBALS['comment'] = $comment;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
<?php 
}
add_filter( 'get_comments_number', 'blankslate_comments_number' );
function blankslate_comments_number( $count )
{
if ( !is_admin() ) {
global $id;
$comments_by_type = &separate_comments( get_comments( 'status=approve&post_id=' . $id ) );
return count( $comments_by_type['comment'] );
} else {
return $count;
}
}



/* ---- CUSTOM META BOX FOR GALLERIES ---- */


// Little function to return a custom field value
function wpshed_get_custom_field( $value ) {
    global $post;

    $custom_field = get_post_meta( $post->ID, $value, true );
    if ( !empty( $custom_field ) )
        return is_array( $custom_field ) ? stripslashes_deep( $custom_field ) : stripslashes( wp_kses_decode_entities( $custom_field ) );

    return false;
}

// Only shows meta box on gallery page
$post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
$template_file = get_post_meta($post_id,'_wp_page_template',TRUE);
  // check for a template type
  if ($template_file == 'page-gallery.php') {

// Register the Metabox
function wpshed_add_custom_meta_box() {
    add_meta_box( 'wpshed-meta-box', 'Flickr Gallery', 'wpshed_meta_box_output', 'page', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'wpshed_add_custom_meta_box' );

// Output the Metabox
function wpshed_meta_box_output( $post ) {
    // create a nonce field
    wp_nonce_field( 'my_wpshed_meta_box_nonce', 'wpshed_meta_box_nonce' ); ?>
    
    <p>
        <label for="galset">Flickr Set ID:</label><br />
        <input type="text" name="galset" id="galset" value="<?php echo wpshed_get_custom_field( 'galset' ); ?>" size="50" />
    </p>

    <p>Galleries are ran through <a href="http://www.flickr.com/" targget="_blank">Flickr</a> photo sets. Create your set and then retreive the ID by navigating to the set's page, and then copying it's ID from the URL. The URL should be structured something like this:
    <blockquote>https://www.flickr.com/photos/{user}/sets/{set ID}/</blockquote>
    </p>
    
    <?php
}

// Save the Metabox values
function wpshed_meta_box_save( $post_id ) {
    // Stop the script when doing autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // Verify the nonce. If insn't there, stop the script
    if( !isset( $_POST['wpshed_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['wpshed_meta_box_nonce'], 'my_wpshed_meta_box_nonce' ) ) return;

    // Stop the script if the user does not have edit permissions
    if( !current_user_can( 'edit_post' ) ) return;

    // Save the textfield
    if( isset( $_POST['galset'] ) )
        update_post_meta( $post_id, 'galset', esc_attr( $_POST['galset'] ) );

    // Save the textarea
    if( isset( $_POST['galuser'] ) )
        update_post_meta( $post_id, 'galuser', esc_attr( $_POST['galuser'] ) );
}
add_action( 'save_post', 'wpshed_meta_box_save' );

}



/* ---- CUSTOM POST TYPE FOR FLOOR PLANS ---- */


add_action( 'init', 'create_post_type' );
function create_post_type() {
    register_post_type( 'floor-plan',
        array(
            'labels' => array(
                'name' => __( 'Floor Plans' ),
                'singular_name' => __( 'Floor Plan' ),
                'menu_name' => __( 'Floor Plans' ),
                'name_admin_bar' => __( 'Floor Plan' ),
                'add_new' => __( 'Add New', 'Floor Plan' ),
                'edit_item' => __( 'Edit Floor Plan' ),
                'new_item' => __( 'New Floor Plan' ),
                'view_item' => __( 'View Floor Plan' )
            ),
        'public' => true,
        'has_archive' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-admin-home',
        'hierarchical' => false,
        'supports' => array( 'title', 'thumbnail', 'editor' )
        )
    );
}

// Register the Metabox
function add_custom_meta_box() {
    add_meta_box( 'fp-meta-box', 
        'Floor Plan Details', 
        'meta_box_output', 
        'floor-plan', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'add_custom_meta_box' );

// Output the Metabox
function meta_box_output( $post ) {
    // create a nonce field
    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' ); ?>

<div class="inside">
    <table class="form-table">

        <tr valign="top">
            <th scope="row"><label for="sqft"><?php _e('Square Feet', 'sqft'); ?></label></th>
            <td><input type="text" id="sqft" name="sqft" value="<?php echo wpshed_get_custom_field( 'sqft' ); ?>" /></td>
        </tr>

        <tr valign="top">
            <th scope="row"><label for="beds"><?php _e('Bedrooms', 'beds'); ?></label></th>
        <td><input type="text" id="beds" name="beds" value="<?php echo wpshed_get_custom_field( 'beds' ); ?>" /></td>
        </tr>

        <tr valign="top">
            <th scope="row"><label for="baths"><?php _e('Bathrooms', 'baths'); ?></label></th>
        <td><input type="text" id="baths" name="baths" value="<?php echo wpshed_get_custom_field( 'baths' ); ?>" /></td>
        </tr>

        <tr valign="top">
            <th scope="row"><label for="mtitle"><?php _e('Meta Title', 'mtitle'); ?></label></th>
            <td><input type="text" id="mtitle" maxlength="70" name="mtitle" value="<?php echo wpshed_get_custom_field( 'mtitle' ); ?>" style="width:100%;" /></td>
        </tr>

        <tr valign="top">
            <th scope="row"><label for="mdesc"><?php _e('Meta Description', 'mdesc'); ?></label></th>
            <td><input type="text" id="mdesc" maxlength="200" name="mdesc" value="<?php echo wpshed_get_custom_field( 'mdesc' ); ?>" style="width:100%;" /></td>
        </tr>

        <tr valign="top">
            <th scope="row"><label for="reverse"><?php _e('Has Reverse Plan', 'reverse'); ?></label></th>
            <td>OFF <input type="range" name="reverse" id="reverse" min="1" max="2" value="<?php echo wpshed_get_custom_field( 'reverse' ); ?>" style="width:50px;" /> ON</td>
        </tr>

    </table>
</div>
<?php
}

// Save the Metabox values
function meta_box_save( $post_id ) {
    // Stop the script when doing autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // Verify the nonce. If insn't there, stop the script
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

    // Stop the script if the user does not have edit permissions
    if( !current_user_can( 'edit_post' ) ) return;

    if( isset( $_POST['sqft'] ) )
        update_post_meta( $post_id, 'sqft', esc_attr( $_POST['sqft'] ) );

    if( isset( $_POST['beds'] ) )
        update_post_meta( $post_id, 'beds', esc_attr( $_POST['beds'] ) );

    if( isset( $_POST['baths'] ) )
        update_post_meta( $post_id, 'baths', esc_attr( $_POST['baths'] ) );

    if( isset( $_POST['mtitle'] ) )
        update_post_meta( $post_id, 'mtitle', esc_attr( $_POST['mtitle'] ) );

    if( isset( $_POST['mdesc'] ) )
        update_post_meta( $post_id, 'mdesc', esc_attr( $_POST['mdesc'] ) );

    if( isset( $_POST['reverse'] ) )
        update_post_meta( $post_id, 'reverse', esc_attr( $_POST['reverse'] ) );
}

add_action( 'save_post', 'meta_box_save' );


/* --------------------------- */

include_once('inc/multi-post-thumbnails.php');

if (class_exists('MultiPostThumbnails')) {

new MultiPostThumbnails(array(
'label' => 'Reverse Image',
'id' => 'secondary-image',
'post_type' => 'floor-plan'
 ) );

 }




define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
require_once dirname( __FILE__ ) . '/inc/options-framework.php';

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */

add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>

<?php
}