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

function sa_layout_view() {
    global $sa_options;
    $settings = get_option( 'sa_options', $sa_options );
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

add_action( 'wp_head', 'sa_layout_view' );