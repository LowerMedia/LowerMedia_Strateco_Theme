<?php

/*
#
#   ADD STAFF MEMBER CONTENT TYPE (CUSTOM POST TYPE)
#
*/

function codex_custom_init() {
  $labels = array(
    'name' => 'Staff Members',
    'singular_name' => 'Staff Member',
    'add_new' => 'Add Staff Member',
    'add_new_item' => 'Add New Staff Member',
    'edit_item' => 'Edit Staff Member',
    'new_item' => 'New Staff Member',
    'all_items' => 'All Staff Members',
    'view_item' => 'View Staff Member',
    'search_items' => 'Search Staff Members',
    'not_found' =>  'No Staff Members found',
    'not_found_in_trash' => 'No Staff Members found in Trash', 
    'parent_item_colon' => '',
    'menu_name' => 'Staff Members'
  );

  $args = array(
    'labels' => $labels,
    'description'   => 'Staff Member for Strateco',
    'menu_position' => 1,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true, 
    'query_var' => true,
    'rewrite' => array( 'slug' => 'staff_members' ),
    'capability_type' => 'post',
    'has_archive' => true, 
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
  ); 

  register_post_type( 'staff_members', $args );
}
add_action( 'init', 'codex_custom_init' );

/*
#
#   CREATE ADMIN PAGE FOR THEME SETTINGS
#
*/

require_once ( get_stylesheet_directory() . '/theme-options.php' );

function lm_layout_view() {
    global $lm_options;
    $settings = get_option( 'lm_options', $lm_options );
    if( $settings['layout_view'] == 'fluid' ) : ?>
        <style type="text/css">
        #wrapper {
            width: 94%;
            max-width:1140px;
            min-width:940px;
        }
        #branding, #branding img, #access, #main, #colophon {
            width:100%;
        }
        </style>
    <?php endif;
}

add_action( 'wp_head', 'lm_layout_view' );

/*
#
#   REGISTER SOCIAL MEDIA MENU
#
*/

function register_social_media_menu() {
  register_nav_menu('social-media-menu',__( 'Social Media Menu' ));
}
add_action( 'init', 'register_social_media_menu' );

/*
#
#   REGISTER LOWERMEDIA.JS
#
*/

function lowermedia_scripts() {
    wp_enqueue_script(
        'custom-script',
        get_stylesheet_directory_uri() . '/lowermedia.js',
        array( 'jquery' )
    );
}

add_action( 'wp_enqueue_scripts', 'lowermedia_scripts' );

function custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );





/*############################################################################################
#
#   Create Meta Boxes
#   
*/
add_action( 'add_meta_boxes', 'lowermedia_add_staff_title_meta_boxes' );
/* Create one or more meta boxes to be displayed on the post editor screen. */
function lowermedia_add_staff_title_meta_boxes() {

    add_meta_box(
        'lowermedia-staff-title',            // Unique ID
        esc_html__( 'Staff Title', 'example' ),      // Title
        'lowermedia_staff_title_meta_box',       // Callback function
        'staff_members',                    // Admin page (or post type)
        'normal',                   // Context ('side', 'advanced', 'normal')
        'high'                  // Priority ('high', 'core', 'default' or 'low')
    );
}

/* Display the post meta box. */
function lowermedia_staff_title_meta_box( $object, $box ) { ?>

    <?php wp_nonce_field( basename( __FILE__ ), 'lowermedia_staff_title_link_nonce' ); ?>

    <p>
        <label for="lowermedia-staff-title">
            <?php _e( "Add Staff Title", 'example' ); ?>
        </label>
        <br />
        <br />
        <input style='width:250px' class="widefat" type="text" name="lowermedia-staff-title" id="lowermedia-staff-title" value="<?php echo esc_attr( get_post_meta( $object->ID, 'lowermedia_staff_title_link', true ) ); ?>" size="15" />
    </p>
<?php }

/* Save post meta on the 'save_post' hook. */
add_action( 'save_post', 'lowermedia_save_staff_title_link_meta', 10, 2 );

/* Meta box setup function. */
function lowermedia_staff_title_meta_boxes_setup() {

    /* Add meta boxes on the 'add_meta_boxes' hook. */
    add_action( 'add_meta_boxes', 'lowermedia_add_staff_title_meta_boxes' );

    /* Save post meta on the 'save_post' hook. */
    add_action( 'save_post', 'lowermedia_save_staff_title_link_meta', 10, 2 );
}


/* Save the meta box's post metadata. */
function lowermedia_save_staff_title_link_meta( $post_id, $post ) {

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['lowermedia_staff_title_link_nonce'] ) || !wp_verify_nonce( $_POST['lowermedia_staff_title_link_nonce'], basename( __FILE__ ) ) )
        return $post_id;

    /* Get the post type object. */
    $post_type = get_post_type_object( $post->post_type );

    /* Check if the current user has permission to edit the post. */
    if ( !current_user_can( $post_type->cap->edit_post, $post_id ) )
        return $post_id;

    /* Get the posted data and sanitize it for use as an HTML class. */
    $new_meta_value = ( isset( $_POST['lowermedia-staff-title'] ) ?  $_POST['lowermedia-staff-title'] : '' );

    /* Get the meta key. */
    $meta_key = 'lowermedia_staff_title_link';

    /* Get the meta value of the custom field key. */
    $meta_value = get_post_meta( $post_id, $meta_key, true );

    /* If a new meta value was added and there was no previous value, add it. */
    if ( $new_meta_value && '' == $meta_value )
        add_post_meta( $post_id, $meta_key, $new_meta_value, true );

    /* If the new meta value does not match the old value, update it. */
    elseif ( $new_meta_value && $new_meta_value != $meta_value )
        update_post_meta( $post_id, $meta_key, $new_meta_value );

    /* If there is no new meta value but an old value exists, delete it. */
    elseif ( '' == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, $meta_key, $meta_value );
}

/* Filter the post class hook with our custom post class function. */
add_filter( 'post_class', 'lowermedia_staff_title_link' );
function lowermedia_staff_title_link( $classes ) {

    /* Get the current post ID. */
    $post_id = get_the_ID();

    /* If we have a post ID, proceed. */
    if ( !empty( $post_id ) ) {

        /* Get the custom post class. */
        $post_class = get_post_meta( $post_id, 'lowermedia_staff_title_link', true );

        /* If a post class was input, sanitize it and add it to the post class array. */
        if ( !empty( $post_class ) )
            $classes[] = sanitize_html_class( $post_class );
    }

    return $classes;
}