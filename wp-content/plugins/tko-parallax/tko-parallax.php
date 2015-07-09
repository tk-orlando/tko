<?php	 	 
add_action( 'init', 'custom_post_type' );
function custom_post_type() {
$labels = array(
	'name' => _x( 'TKO Parallax', 'general name' ),
	'singular_name' => _x( 'Page', 'singular name' ),
	'add_new' => _x( 'Add New', 'tko-parallax' ),
	'add_new_item' => __( 'Add New Page' ),
	'edit_item' => __( 'Edit Page' ),
	'new_item' => __( 'New Page' ),
	'all_items' => __( 'All Pages' ),
	'view_item' => __( 'View Page' ),
	'search_items' => __( 'Search Pages' ),
	'not_found' => __( 'No pages found' ),
	'not_found_in_trash' => __( 'No pages found in the Trash' ),
	'parent_item_colon' => '',
	'menu_name' => 'TKO Parallax'
 	 'menu_name' => 'TKO Parallax'
);
$args = array(
	'labels' => $labels,
	'public' => true,
	'menu_position' => null,
	'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments', 'page-attributes' ),
	'has_archive' => true,
);
register_post_type( 'tko-parallax', $args);
}
?>