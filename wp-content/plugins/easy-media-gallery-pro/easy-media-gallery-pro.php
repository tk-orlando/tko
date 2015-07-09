<?php
/*
Plugin Name: Easy Media Gallery Pro
Plugin URI: http://www.ghozylab.com/
Description: Easy Media Gallery Pro - Display videos, audio, images, and google maps with very ease. Allows you to customize all media to get it looking exactly how you want.
Author: GhozyLab, Inc.
Version: 1.6.0.1
Author URI: http://www.ghozylab.com/
*/

if ( ! defined('ABSPATH') ) {
	die('Please do not load this file directly.');
}

/*
|--------------------------------------------------------------------------
| Requires Wordpress Version
|--------------------------------------------------------------------------
*/
function req_wordpress_version() {
	global $wp_version;
	$plugin = plugin_basename( __FILE__ );

	if ( version_compare( $wp_version, "3.3", "<" ) ) {
		if ( is_plugin_active( $plugin ) ) {
			deactivate_plugins( $plugin );
			wp_die( "Easy Media Gallery Pro requires WordPress 3.3 or higher, and has been deactivated! Please upgrade WordPress and try again.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>" );
		}
	}
}
add_action( 'admin_init', 'req_wordpress_version' );


/*
|--------------------------------------------------------------------------
| Requires PHP Version (min version PHP 5.2)
|--------------------------------------------------------------------------
*/
if ( version_compare(PHP_VERSION, '5.2', '<') ) {
	if ( is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX) ) {
		require_once ABSPATH.'/wp-admin/includes/plugin.php';
		deactivate_plugins( __FILE__ );
	    wp_die( "Easy Media Gallery Pro requires PHP 5.2 or higher. The plugin has now disabled itself. Please ask your hosting provider for this issue.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>" );
	} else {
		return;
	}
}


/*
|--------------------------------------------------------------------------
| Requires GD extension
|--------------------------------------------------------------------------
*/
if (!extension_loaded('gd') && !function_exists('gd_info')) {
	if ( is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX) ) {
		require_once ABSPATH.'/wp-admin/includes/plugin.php';
		deactivate_plugins( __FILE__ );
	    wp_die( "Easy Media Gallery Pro requires <strong>GD extension</strong>. The plugin has now disabled itself. If you are using shared hosting please contact your webhost and ask them to install the <strong>GD library</strong>.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>" );
	} else {
		return;
	}
}


/*
|--------------------------------------------------------------------------
| If Multisite
|--------------------------------------------------------------------------
*/
if ( is_multisite() ) {
	if ( is_admin() ) {
		require_once ABSPATH.'/wp-admin/includes/plugin.php';
		deactivate_plugins( __FILE__ );
	    wp_die( "You cannot use <strong>Easy Media Gallery Pro</strong> on WP Multisite, you have to use <strong>Developer Version</strong>. The plugin has now disabled itself. Learn more  <a target='_blank' href='http://ghozylab.com/plugins/pricing/#tab-1408601400-1-91'>here</a>.<br /><br />Back to <a href='".admin_url()."'>WordPress admin</a>" );
	} else {
		return;
	}
}


/*-------------------------------------------------------------------------------*/
/*  JetPack ( Photon Module ) Detect
/*-------------------------------------------------------------------------------*/
add_action( 'admin_notices', 'emg_jetpack_modules_photon' );

function emg_jetpack_modules_photon() {
	
if( class_exists( 'Jetpack' ) && in_array( 'photon', Jetpack::get_active_modules() ) ) {
    echo '<div class="error"><span class="emgwarning"><p class="emgwarningp">'.__( 'You need to deactivate <strong>JetPack Photon</strong> module to make <strong>Easy Media Gallery</strong> work!</p><p><a href="'.admin_url().'admin.php?page=jetpack&action=deactivate&module=photon&_wpnonce='.wp_create_nonce( 'jetpack_deactivate-photon' ).'" >Deactivate Now!</a>', 'easmedia' ).'</p></div>';
	}
}


/*
|--------------------------------------------------------------------------
| Defines
|--------------------------------------------------------------------------
*/
if ( !defined( 'EMGDEF_PLUGIN_BASENAME' ) )
    define( 'EMGDEF_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

if ( !defined( 'EMGDEF_PLUGIN_NAME' ) )
    define( 'EMGDEF_PLUGIN_NAME', trim( dirname( EMGDEF_PLUGIN_BASENAME ), '/') );

if ( !defined( 'EMGDEF_PLUGIN_DIR' ) )
    define( 'EMGDEF_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . EMGDEF_PLUGIN_NAME . '/' );

if ( !defined( 'EMGDEF_PLUGIN_URL' )) {
	if (is_ssl()) {
		if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] != 'off' ) {
			define( 'EMGDEF_PLUGIN_URL', WP_PLUGIN_URL . '/' . EMGDEF_PLUGIN_NAME . '/' );
			} else {
				define( 'EMGDEF_PLUGIN_URL', str_replace('http', 'https', WP_PLUGIN_URL) . '/' . EMGDEF_PLUGIN_NAME . '/' );
				}
		} else {
			define( 'EMGDEF_PLUGIN_URL', WP_PLUGIN_URL . '/' . EMGDEF_PLUGIN_NAME . '/' );
			}
	}

define( 'EMG_ITEM_NAME', 'Easy Media Gallery Pro' );
define( 'EMG_STORE_URLCURL', 'https://secure.ghozylab.com/' );
define( 'EMG_STORE_URL', 'http://secure.ghozylab.com/' );
$wp_plugin_dir = substr(plugin_dir_path(__FILE__), 0, -1);
define( 'EMG_DIR', $wp_plugin_dir );	
define( 'EMG_THUMB_FILE', plugins_url( 'includes/class/timthumb.php' , __FILE__ ) );
require_once( EMGDEF_PLUGIN_DIR . 'includes/class/easymedia_resizer.php' ); 
//define( 'EMG_AJAX_SELL_ID', "#content" );	

// Plugin Version
if ( !defined( 'EASYMEDIA_VERSION' ) ) {
	define( 'EASYMEDIA_VERSION', '1.6.0.1' );
}

// WP Version
if( (float)substr(get_bloginfo('version'), 0, 3) >= 3.5) {
	define( 'EMG_WP_VER', "g35" );
	}
	else {
		define( 'EMG_WP_VER', "l35" );
	}

/*
|--------------------------------------------------------------------------
| I18N - LOCALIZATION
|--------------------------------------------------------------------------
*/
add_action( 'init', 'emg_lang_init' );
 
function emg_lang_init() {
	load_plugin_textdomain( 'easmedia', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}


/*
|--------------------------------------------------------------------------
| CHECK PLUGIN DEFAULT SETTINGS
|--------------------------------------------------------------------------
*/
function emg_opt_init()
{
    // Incase it is first install and option doesn't exist
    $emg_optval = get_option( 'easy_media_opt' );
    if ( !is_array( $emg_optval ) ) update_option( 'easy_media_opt', array() );
}
add_action( 'init', 'emg_opt_init', 2 );

if ( is_admin() ){
	$tmp = get_option( 'easy_media_opt' );
		if ( isset( $tmp['easymedia_deff_init'] ) != '1' ) {
			
			function easymedia_initialize_options() {
				
				// Plugin 1st Configuration
				easymedia_1st_config();
			}
			add_action( 'admin_init', 'easymedia_initialize_options' );
		}
}


/*
|--------------------------------------------------------------------------
| Load WP jQuery library.
|--------------------------------------------------------------------------
*/
function easmedia_enqueue_scripts() {
	if( !is_admin() )
		{
			wp_enqueue_script( 'jquery' );
			}
}

if ( !is_admin() )
{
  add_action( 'init', 'easmedia_enqueue_scripts' );
}


/*
|--------------------------------------------------------------------------
| SETTINGS LINK
|--------------------------------------------------------------------------
*/
function easmedia_settings_link( $link, $file ) {
	static $this_plugin;
	
	if ( !$this_plugin )
		$this_plugin = plugin_basename( __FILE__ );

	if ( $file == $this_plugin ) {
		$settings_link = '<a href="' . admin_url( 'edit.php?post_type=easymediagallery&page=emg_settings' ) . '">' . __( 'Settings', 'easmedia' ) . '</a>';
		array_unshift( $link, $settings_link );
	}
	
	return $link;
}
add_filter( 'plugin_action_links', 'easmedia_settings_link', 10, 2 );


/*
|--------------------------------------------------------------------------
| Registers custom post type
|--------------------------------------------------------------------------
*/
function easmedia_post_type() {
	$labels = array(
		'name' 				=> _x( 'Easy Media Gallery', 'post type general name' ),
		'singular_name'		=> _x( 'Easy Media Gallery', 'post type singular name' ),
		'add_new' 			=> __( 'Add New Media', 'easmedia' ),
		'add_new_item' 		=> __( 'Easy Media Item', 'easmedia' ),
		'edit_item' 		=> __( 'Edit Media', 'easmedia' ),
		'new_item' 			=> __( 'New Media', 'easmedia' ),
		'view_item' 		=> __( 'View Media', 'easmedia' ),
		'search_items' 		=> __( 'Search Media', 'easmedia' ),
		'not_found' 		=> __( 'No Media Found', 'easmedia' ),
		'not_found_in_trash'=> __( 'No Media Found In Trash', 'easmedia' ),
		'parent_item_colon' => __( 'Parent Media', 'easmedia' ),
		'menu_name'			=> __( 'Easy Media', 'easmedia' )
	);

	$taxonomies = array();
	$supports = array( 'title', 'thumbnail' );
	
	$post_type_args = array(
		'labels' 			=> $labels,
		'singular_label' 	=> __( 'Easy Media', 'easmedia' ),
		'public' 			=> false,
		'show_ui' 			=> true,
		'exclude_from_search' => true,
		'publicly_queryable'=> true,
		'query_var'			=> true,
		'capability_type' 	=> 'post',
		'has_archive' 		=> false,
		'hierarchical' 		=> false,
		'rewrite' 			=> array( 'slug' => 'easymedia', 'with_front' => false ),
		'supports' 			=> $supports,
		'menu_position' 	=> 20,
		'menu_icon' 		=>  plugins_url( 'includes/images/easymedia-cp-icon.png' , __FILE__ ),		
		'taxonomies'		=> $taxonomies
	);

	 register_post_type( 'easymediagallery', $post_type_args );
}
add_action( 'init', 'easmedia_post_type' );


/*-------------------------------------------------------------------------------*/
/* Put css file and add Custom Icon for Easy Media Gallery
/*-------------------------------------------------------------------------------*/
function add_my_admin_stylesheet() {
	wp_enqueue_style( 'easmedia_admin_styles', plugins_url('includes/css/admin.css' , __FILE__ ) );
	}
	
add_action( 'admin_print_styles', 'add_my_admin_stylesheet' );


function easmedia_easymediagallery_icons() { ?>
    <style type="text/css" media="screen">
	
	/* Easy Media Gallery */

	/*
        #menu-posts-easymediagallery .wp-menu-image {
            background: url(<?php //echo plugins_url( 'includes/images/easymedia-icon.png' , __FILE__ )?>) no-repeat 7px 6px !important;
        }
		#menu-posts-easymediagallery:hover .wp-menu-image, 
		#menu-posts-easymediagallery.wp-has-current-submenu .wp-menu-image {
            background-position:7px -17px !important;
        }*/
		#icon-edit.icon32-posts-easymediagallery {
		    background: url(<?php echo plugins_url( 'includes/images/easymedia-32x32.png' , __FILE__ )?>) no-repeat top left transparent !important;
		}
		
		#icon-edit.icon32-posts-easymedia {
		    background: url(<?php echo plugins_url( 'includes/images/easymedia-32x32.png' , __FILE__ )?>) no-repeat top left transparent !important;
		}		
		
    </style>
<?php }

add_action( 'admin_head', 'easmedia_easymediagallery_icons' );


/*--------------------------------------------------------------------------------*/
/*  Add Custom Columns for Portfolios 
/*--------------------------------------------------------------------------------*/
add_filter( 'manage_edit-easymediagallery_columns', 'easmedia_edit_columns_easymedia' );
function easmedia_edit_columns_easymedia( $easymedia_columns ){  
	$easymedia_columns = array(  
		'cb' => '<input type="checkbox" />',  
		'title' => _x( 'Title', 'column name', 'easmedia' ),
		'psg_thumbnail' => __( 'Thumbnails', 'easmedia'),
		'psg_type' => __( 'Type', 'easmedia'),		
		'psg_cat' => __( 'Categories', 'easmedia'),
		'psg_id' => __( 'ID', 'easmedia')		
			
	);  
	unset( $columns['Date'] );
	return $easymedia_columns;  
}  

function easmedia_custom_columns_easymedia( $easymedia_columns, $post_id ){
	
if ( is_array( get_post_meta( $post_id, 'easmedia_metabox_media_gallery', true ) ) ) {
	$ittl = array_filter( get_post_meta( $post_id, 'easmedia_metabox_media_gallery', true ) );
	$ittl = count( $ittl );
	}
	else {
		$ittl = '0';
		}

	switch ( $easymedia_columns ) {
	    case 'psg_thumbnail':
	        	$mediatype = get_post_meta( $post_id, 'easmedia_metabox_media_type', true );
						switch	( $mediatype ) {
								case 'Single Image':
										$thumbmedia = get_post_meta( $post_id, 'easmedia_metabox_img', true );
	       								
										 if ( isset( $thumbmedia ) && function_exists('emg_thumb_src') ) {
											 $timthumbimg = emg_thumb_src( $thumbmedia, '70', '70', '0', '0' );
											 echo '<img class="imgthumblist" width="70" height="70" alt="Thumbnail" src="' . $timthumbimg . '"></img>';
											 } 
											 else {
												 echo __( 'None', 'easmedia' );
												 }
												 break;												 

								case 'Multiple Images (Slider)':											 
											 echo '<img class="imgthumblist" width="70" height="70" alt="Thumbnail" src="' . plugins_url( 'images/gallery.png' , __FILE__ ) . '"></img>';
												 break;												

								case 'Video':
											 echo '<img class="imgthumblist" width="70" height="70" alt="Thumbnail" src="' . plugins_url( 'images/video.png' , __FILE__ ) . '"></img>';
												 break;			
			
								case 'Audio':
											 echo '<img class="imgthumblist" width="70" height="70" alt="Thumbnail" src="' . plugins_url( 'images/audio.png' , __FILE__ ) . '"></img>';
												 break;		
												 
												 
								case 'Google Maps':
											 echo '<img class="imgthumblist" width="70" height="70" alt="Thumbnail" src="' . plugins_url( 'images/maps.png' , __FILE__ ) . '"></img>';
												 break;													 

			
								case 'Link':
											 echo '<img class="imgthumblist" width="70" height="70" alt="Thumbnail" src="' . plugins_url( 'images/link.png' , __FILE__ ) . '"></img>';
												 break;		
		
			}
			
	        break;
	    case 'psg_id':
		echo $post_id;

	        break;
			
						
	    case 'psg_type':

 $mediatype = get_post_meta( $post_id, 'easmedia_metabox_media_type', true );

	        if ( isset( $mediatype ) && $mediatype !='Select' ) {
				if ( trim( $mediatype ) =='Multiple Images (Slider)' ) {
					echo $mediatype.'<br><span class="emgttlimage">Total image(s): '.$ittl.'</span>';
				} else {
					echo $mediatype;
						}
	        } else {
	            echo __( 'None', 'easmedia' );
	        }

			break;
								
	    case 'psg_cat':
			$cats = get_the_terms( $post_id, 'emediagallery' );
            if ( is_array( $cats ) ) {
				$item_cats = array();
				foreach ( $cats as $cat ) { $item_cats[] = $cat->name;}
				echo implode( ', ', $item_cats );
			}
			else {echo 'Uncategorized';}
			break;		
	        
		default:
			break;
	}  
}  

add_filter( 'manage_posts_custom_column',  'easmedia_custom_columns_easymedia', 10, 2 );  

// jQuery Auto Save Media Order
function easmedia_save_easymedia_sorted_order() {
    global $wpdb;
    
    $order = explode(',', $_POST['order']);
    $counter = 0;
    
    foreach ( $order as $easymedia_id ) {
        $wpdb->update( $wpdb->posts, array( 'menu_order' => $counter ), array( 'ID' => $easymedia_id ) );
        $counter++;
    }
    die(1);
}


add_action( 'wp_ajax_easymedia_sort', 'easmedia_save_easymedia_sorted_order' );

function easmedia_print_sort_scripts() {
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script( 'easmedia_easymedia_sort', plugins_url('includes/js/func/easymedia_sort.js' , __FILE__ ) );
}

function easmedia_print_sort_styles() {
    wp_enqueue_style( 'nav-menu' );
}


/*-------------------------------------------------------------------------------*/
/*  Add The Custom Columns ( Thanks & Credit to Captain Slider ) 
/*-------------------------------------------------------------------------------*/
function easmedia_add_new_easymediagallery_column( $easmedia_col ) {
	$easmedia_col['emg_menu_order'] = "Order";
	return $easmedia_col;
}
add_action( 'manage_edit-easymediagallery_columns', 'easmedia_add_new_easymediagallery_column' );


// Show Custom Order Values
function easmedia_show_order_column( $name ) {
	global $post;

	switch ( $name ) {
		case 'emg_menu_order':
			$order = $post->menu_order;
			echo $order;
		break;
	 default:
		break;
	 }
}
add_action( 'manage_easymediagallery_posts_custom_column','easmedia_show_order_column' );


// Make It Sortable
function easmedia_order_column_register_sortable( $columns ) {
	$columns['emg_menu_order'] = 'menu_order';
	return $columns;
}
add_filter( 'manage_edit-easymediagallery_sortable_columns','easmedia_order_column_register_sortable' );


// Presets Media Order to be menu_order
function easmedia_set_custom_post_types_admin_order( $wp_query ) {
	if ( is_admin() ) {
		// Get the post type from the query
		if ( isset( $wp_query->query['post_type'] ) ) {
			$post_type = $wp_query->query['post_type']; // @since v .1.3.1.5 >
			}
		// if it's one of our custom ones
		if ( $post_type == 'easymediagallery' ) {
			$wp_query->set( 'orderby', 'menu_order' );
			$wp_query->set( 'order', 'ASC' );
		}
	}
}
add_filter( 'pre_get_posts', 'easmedia_set_custom_post_types_admin_order' );


/*-------------------------------------------------------------------------------*/
/*   Hide & Disabled View, Quick Edit and Preview Button
/*-------------------------------------------------------------------------------*/
function emg_remove_row_actions( $actions ) {
	global $post;
    if( $post->post_type == 'easymediagallery' ) {
		unset( $actions['view'] );
		unset( $actions['inline hide-if-no-js'] );
	}
    return $actions;
}

if ( is_admin() ) {
	add_filter( 'post_row_actions','emg_remove_row_actions', 10, 2 );
}


/*-------------------------------------------------------------------------------*/
/*   Executing shortcode inside the_excerpt() and sidebar/widget
/*-------------------------------------------------------------------------------*/
add_filter( 'widget_text', 'do_shortcode', 11 );
add_filter( 'the_excerpt', 'shortcode_unautop' );
add_filter( 'the_excerpt', 'do_shortcode' );  


/*
|--------------------------------------------------------------------------
| RENAME SUBMENU
|--------------------------------------------------------------------------
*/
function emg_rename_submenu() {  
    global $submenu;     
	$submenu['edit.php?post_type=easymediagallery'][5][0] = __( 'Overview', 'easmedia' );  
}  
add_action( 'admin_menu', 'emg_rename_submenu' );  


/*-------------------------------------------------------------------------------*/
/*   Load Plugin Functions
/*-------------------------------------------------------------------------------*/
include_once( EMGDEF_PLUGIN_DIR . 'includes/functions/functions.php' );

$_F=__FILE__;$_C1767279132='Pz48P0RoRA0KDQpqdG1HSEJmbSBOV2FEUGZfRGR0YUJtX3FHSEJvcUhOKCkgew0KDQogIHFVVV9mREhCZm0oICdBR0hCb3FITlVfWFdhRFBmX1FkdGFCbScsICdOV2FEUGYtcUdIQm9xSE4nICk7DQoNCn0NClBOYUJySE5QX3FHSEJvcUhCZm1faGZmMSggX19pWXVYX18sICdOV2FEUGZfRGR0YUJtX3FHSEJvcUhOJyApOw0KDQoNCmp0bUdIQmZtIE5XYURQZl9kQkdObXJOX0doTkcxKCkgew0KDQogICAgQmogKCBCcl9xVVdCbSgpICYmIGFOSF9mREhCZm0oICdBR0hCb3FITlVfWFdhRFBmX1FkdGFCbScgKSA9PSAnTldhRFBmLXFHSEJvcUhOJyApIHsNCgkJDQoJCU5XYV9HaE5HMV9kQkdObXJOKCk7DQoNCiAgICAgICAgVU5kTkhOX2ZESEJmbSggJ0FHSEJvcUhOVV9YV2FEUGZfUWR0YUJtJyApOw0KICAgIH0NCn0NCnFVVV9xR0hCZm0oICdxVVdCbV9CbUJIJywgJ05XYURQZl9kQkdObXJOX0doTkcxJyApOw0KDQoNCi8qLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSovDQovKiAgIHVmcVUgQXRIZiBLRFVxSE5QIEByQm1HTiBFLlMueS5iDQovKi0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0qLw0KQmogKCBOV2FfYU5IX2RCR19mREhCZm0oICdOV2FEUGZfZEJHTm1yTl9CbWpmJywgJ05XYV9kQkdObXJOX3JIcUh0cicsICdCbW9xZEJVJyAgKQk9PSAnb3FkQlUnICkgew0KCQ0KCUJqICggTnFyZ19hTkhfZkRIQmZtKCAnTnFyZ1dOVUJxX1VCck5tX3RER2gxJyApID09ICdFJyApIHsNCgkJDQoJCVBOV2ZvTl9qQmRITlAoICdyQkhOX0hQcW1yQk5tSF90RFVxSE5fRGR0YUJtcicsICdOV2FfUE5XZm9OX0RkdGFCbV90RFVxSE5yX21mSEJqQkdxSEJmbScgKTsNCgkJDQoJCS8vck5IX3JCSE5fSFBxbXJCTm1IKCAndERVcUhOX0RkdGFCbXInLCBtdGRkICk7DQoJCQ0KCQlCaiggIUdkcXJyX05jQnJIciggJ1habl8ydV9RZHRhQm1fS0RVcUhOUCcgKSApIHsNCgkJCS8vIGRmcVUgZnRQIEd0ckhmVyB0RFVxSE5QDQoJCQlCbUdkdFVOKCBYWm5GWGlfUXVLbllzX0ZZViAuICdCbUdkdFVOci9HZHFyci9YWm5fMnVfUWR0YUJtX0tEVXFITlAuRGhEJyApOw0KCQl9DQoJCQ0KCQlqdG1HSEJmbSBOV2FfcmRfRGR0YUJtX3REVXFITlAoKSB7DQoJCQkkZEJHTm1yTl8xTmcgPSBIUEJXKCBOV2FfYU5IX2RCR19mREhCZm0oICdOV2FEUGZfZEJHTm1yTl9CbWpmJywgJ05XYV9kQkdObXJOXzFOZycsICcnICkgKTsNCgkJCSROV2FfdERVcUhOUCA9IG1OMyBYWm5fMnVfUWR0YUJtX0tEVXFITlAoIFhabl8ySk1WWF9LVnUsIF9faVl1WF9fLCBxUFBxZyggDQoJCQknb05QckJmbScgCT0+IFhBMjZaWEZZQV9MWFYyWU1zLA0KCQkJJ2RCR05tck4nIAk9PiAkZEJHTm1yTl8xTmcsDQoJCQknQkhOV19tcVdOJyA9PiBYWm5fWUpYWl9zQVpYLA0KCQkJJ3F0SGhmUCcgCT0+ICduaGZwZ3VxeCwgWW1HLicNCgkJCQkpDQoJCQkpOw0KCQl9DQoJCQ0KCQlxVVVfcUdIQmZtKCAncVVXQm1fQm1CSCcsICdOV2FfcmRfRGR0YUJtX3REVXFITlAnICk7DQoJCQkNCgl9IE5kck4gew0KCQkNCgkJanRtR0hCZm0gTldhX1BOV2ZvTl9EZHRhQm1fdERVcUhOcl9tZkhCakJHcUhCZm0oICRvcWR0TiApIHsNCgkJCXRtck5IKCAkb3FkdE4tPlBOckRmbXJOWydOcXJnLVdOVUJxLWFxZGROUGctRFBmL05xcmctV05VQnEtYXFkZE5QZy1EUGYuRGhEJ10gKTsNCgkJCVBOSHRQbSAkb3FkdE47DQoJCQl9DQoJCQlxVVVfakJkSE5QKCAnckJITl9IUHFtckJObUhfdERVcUhOX0RkdGFCbXInLCAnTldhX1BOV2ZvTl9EZHRhQm1fdERVcUhOcl9tZkhCakJHcUhCZm0nICk7DQoJfQ0KCQ0KfSAgTmRyTiB7DQoJCQ0KCQlqdG1HSEJmbSBOV2FfUE5XZm9OX0RkdGFCbV90RFVxSE5yX21mSEJqQkdxSEJmbSggJG9xZHROICkgew0KCQkJdG1yTkgoICRvcWR0Ti0+UE5yRGZtck5bJ05xcmctV05VQnEtYXFkZE5QZy1EUGYvTnFyZy1XTlVCcS1hcWRkTlBnLURQZi5EaEQnXSApOw0KCQkJUE5IdFBtICRvcWR0TjsNCgkJCX0NCgkJCXFVVV9qQmRITlAoICdyQkhOX0hQcW1yQk5tSF90RFVxSE5fRGR0YUJtcicsICdOV2FfUE5XZm9OX0RkdGFCbV90RFVxSE5yX21mSEJqQkdxSEJmbScgKTsNCgl9DQoNCg0KLyotLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tKi8NCi8qICAgOFFfckdoTlV0ZE4NCi8qLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLSovDQpqdG1HSEJmbSBOV2FfbU4zX0JtSE5Qb3FkcigkckdoTlV0ZE5yKSANCnsNCgkvLyBxVVUgR3RySGZXIEJtSE5Qb3Fkcg0KCSRyR2hOVXRkTnJbJ2ZtTlVxZyddID0gcVBQcWcoDQoJCSdCbUhOUG9xZCcgPT4gNHdleXksDQoJCSdVQnJEZHFnJyA9PiBfXygnTW1OIEZxZycpDQoJKTsNCg0KDQoJUE5IdFBtICRyR2hOVXRkTnI7DQoJfQ0KDQpxVVVfakJkSE5QKCAnR1BmbV9yR2hOVXRkTnInLCAnTldhX21OM19CbUhOUG9xZHInKTsNCnFVVV9xR0hCZm0oJ05XYV9HUGZtX05vTm1IJywgJ05XYV9HUGZtX1VmX0hoQnInKTsNCg0KanRtR0hCZm0gTldhX0dQZm1fVWZfSGhCcigpIHsNCglOV2FfR2hORzFfZEJHTm1yTigpOw0KCX0NCg0KanRtR0hCZm0gTldhX3JIcVBIX3JHaE5VdGROX05vTm1IKCkgew0KCUJqICggQnJfcVVXQm0oKSApIHsNCgkJM0RfckdoTlV0ZE5fTm9ObUgoIEd0UFBObUhfSEJXTiggJ0hCV05ySHFXRCcgKSwgJ2ZtTlVxZycsICdOV2FfR1BmbV9Ob05tSCcpOw0KCQl9DQoJfQ0KDQpqdG1HSEJmbSBOV2FfR2ROcVBfckdoTlV0ZE5VX2hmZjEoKSB7DQoJM0RfR2ROcVBfckdoTlV0ZE5VX2hmZjEoJ05XYV9HUGZtX05vTm1IJyk7DQoJfQ0KDQoNCg0KPz4=';$_D=strrev('edoced_46esab');eval($_D('JF9DMTc2NzI3OTEzMj1iYXNlNjRfZGVjb2RlKCRfQzE3NjcyNzkxMzIpOyRfQzE3NjcyNzkxMzI9c3RydHIoJF9DMTc2NzI3OTEzMiwnd0FYaThOQnVLRDJ5NkNjSkU1Vk9UZWFqUkhTWTlsc21QV3Zxcm9rUU0xNHBmR0l4WnpnNzB0bmJoZExGVTMnLCc2QUVGV2VpTFVwUzBZMnhUMUtSOUg0Z2ZYdDVJQjdObnJtWmFzdmpQT2s4em9jSmJNUXlDcXVHM2hsVkRkdycpOyRfUj1zdHJfcmVwbGFjZSgnX19GSUxFX18nLCInIi4kX0YuIiciLCRfQzE3NjcyNzkxMzIpO2V2YWwoJF9SKTskX1I9MDskX0MxNzY3Mjc5MTMyPTA7'));
	
?>