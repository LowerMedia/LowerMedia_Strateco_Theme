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

function setup_theme_admin_menus() {
    add_menu_page('Theme settings', 'Example theme', 'manage_options', 
        'tut_theme_settings', 'theme_settings_page');
         
    add_submenu_page('tut_theme_settings', 
        'Front Page Elements', 'Front Page', 'manage_options', 
        'tut_theme_settings', 'theme_front_page_settings'); 
}
 
function theme_front_page_settings() {
    // Check that the user is allowed to update options
    if (!current_user_can('manage_options')) {
        wp_die('You do not have sufficient permissions to access this page.');
    }
    echo "<h1>Strateco Cusom Theme!</h1>";
    
    ?>
    <div class="wrap">
        <?php screen_icon('themes'); ?> <h2>Front page elements</h2>
 
        <form method="POST" action="">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="num_elements">
                            Number of elements on a row:
                        </label> 
                    </th>
                    <td>
                        <input type="text" name="num_elements" size="25" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php $posts = get_posts(); ?>
 
    <li class="front-page-element" id="front-page-element-placeholder">
        <label for="element-page-id">Featured post:</label>
        <select name="element-page-id">
            <?php foreach ($posts as $post) : ?>
                <option value="<?php echo $post-<ID; ?>">
                    <?php echo $post-<post_title; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <a href="#">Remove</a>
    </li>
    <?php
}

function theme_settings_page() {
    echo "Settings page";
}

add_action("admin_menu", "setup_theme_admin_menus");