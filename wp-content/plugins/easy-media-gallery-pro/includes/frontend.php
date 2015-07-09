<?php

/*
|--------------------------------------------------------------------------
| CONTROL, REGISTER & ENQUEUE FRONT END SCRIPTS / STYLES
|--------------------------------------------------------------------------
*/
function easymedia_frontend_stylesheet() {
	        wp_enqueue_style( 'easymedia_styles', EMGDEF_PLUGIN_URL .'css/frontend.css' );		
			wp_enqueue_style( 'easymedia_paganimate', EMGDEF_PLUGIN_URL .'includes/css/animate.css' );	
			
			$filtr = strtolower(( easy_get_option( 'easymedia_filterstyle' ) ) );
			$filtr = explode("-", $filtr);
			$curfiltr = $filtr[0]."-filter.css";
			
			wp_enqueue_style( 'easymedia_filter_style', EMGDEF_PLUGIN_URL .'css/styles/filter/'.$curfiltr.'' );
						
	switch ( emg_slug_to_name( easy_get_option( 'easymedia_lightbox_style' ) ) ) {
		
		case 'emglb':

		$boxstyle = EMGDEF_PLUGIN_URL . 'css/styles/mediabox';
		echo "<link rel=\"alternate stylesheet\" title=\"Dark\" type=\"text/css\" media=\"screen,projection\" href=\"$boxstyle/Dark.css\" />\n";
		echo "<link rel=\"alternate stylesheet\" title=\"Light\" type=\"text/css\" media=\"screen,projection\" href=\"$boxstyle/Light.css\" />\n";
		echo "<link rel=\"alternate stylesheet\" title=\"Transparent\" type=\"text/css\" media=\"screen,projection\" href=\"$boxstyle/Transparent.css\" />\n";
		wp_enqueue_style( 'easymedia_mediaelementplayer_skin', EMGDEF_PLUGIN_URL .'includes/addons/mediaelement/mediaelementplayer-skin-yellow.css' );	
		
		break;
		
		case 'cb':
		wp_enqueue_style( 'easymedia_colorbox', EMGDEF_PLUGIN_URL .'css/styles/colorbox/colorbox.css' );	
		
		break;
		
		case 'lb2':
		wp_enqueue_style( 'easymedia_lightbox', EMGDEF_PLUGIN_URL .'css/styles/lightbox/css/lightbox.css' );	
		
		break;	
		
		case 'fb2':
		wp_enqueue_style( 'easymedia_fancybox', EMGDEF_PLUGIN_URL .'css/styles/fancybox/jquery.fancybox.css' );	
		wp_enqueue_style( 'easymedia_fancybox_helpers_buttons', EMGDEF_PLUGIN_URL .'css/styles/fancybox/helpers/jquery.fancybox-buttons.css' );	
		wp_enqueue_style( 'easymedia_fancybox_helpers_thumbs', EMGDEF_PLUGIN_URL .'css/styles/fancybox/helpers/jquery.fancybox-thumbs.css' );	
		break;		
		
		
		case 'fbfree':
		wp_enqueue_style( 'easymedia_fancybox', EMGDEF_PLUGIN_URL .'css/styles/fancyboxfree/jquery.fancybox-1.3.4.css' );		
		break;			
		
		case 'pp':
		wp_enqueue_style( 'easymedia_prettyphoto', EMGDEF_PLUGIN_URL .'css/styles/prettyphoto/css/prettyPhoto.css' );	
		break;		
		
		case 'ps':
		wp_enqueue_style( 'easymedia_photoswipe', EMGDEF_PLUGIN_URL .'css/styles/photoswipe/photoswipe.css' );
		
		break;
		
		case 'pbox':
		wp_enqueue_style( 'easymedia_photobox', EMGDEF_PLUGIN_URL .'css/styles/photobox/photobox.css' );
		
		break;						
				
		case 'wptb':
		wp_enqueue_style('thickbox.css', includes_url('/js/thickbox/thickbox.css'), null, '1.0');
		
		break;					
				
				
		default:
		break;	
	}	
	
	switch ( emg_slug_to_name( easy_get_option( 'easymedia_hovstyle' ) ) ) {
					
		case 'hoverone':
		
		break;	
		
		case 'emgview-two':
		wp_enqueue_style( 'easymedia_style_two', EMGDEF_PLUGIN_URL .'css/styles/hover/style_02.css' );
		
		break;	
		
		case 'emgview-three':
		wp_enqueue_style( 'easymedia_style_three', EMGDEF_PLUGIN_URL .'css/styles/hover/style_03.css' );
		
		break;	
		
		case 'emgview-four':
		wp_enqueue_style( 'easymedia_style_three', EMGDEF_PLUGIN_URL .'css/styles/hover/style_04.css' );
		
		break;					
				
					
				
		default:
		break;	
	}			
							
}
add_action( 'wp_print_styles', 'easymedia_frontend_stylesheet' );


function easymedia_frontend_script() {
	
	
	switch ( emg_slug_to_name( easy_get_option( 'easymedia_lightbox_style' ) ) ) {
		
		case 'emglb':
		if ( easy_get_option( 'easymedia_plugin_core' ) != 'none' ) {wp_enqueue_script( 'mootools-core' ); }
		wp_enqueue_script( 'easymedia-core' );
		wp_enqueue_script( 'easymedia-mediaelementjs' );
		
		break;
		
		case 'cb':
		wp_enqueue_script( 'easymedia-colorbox' );
		
		break;
		
		case 'lb2':
		wp_enqueue_script( 'easymedia-lightbox' );
		
		break;		
		
		case 'fb2':
		wp_enqueue_script( 'easymedia-fancybox' );
		wp_enqueue_script( 'easymedia-fancybox-buttons' );		
		wp_enqueue_script( 'easymedia-fancybox-media' );		
		wp_enqueue_script( 'easymedia-fancybox-thumbs' );	
		wp_enqueue_script( 'easymedia-mousewheel' );
					
		break;	
		
		case 'fbfree':
		wp_enqueue_script( 'easymedia-fancyboxfree-easing' );
		wp_enqueue_script( 'easymedia-fancyboxfree-mousewheel' );		
		wp_enqueue_script( 'easymedia-fancyboxfree-fancybox' );
					
		break;			
		
		case 'pp':
		wp_enqueue_script( 'easymedia-prettyphoto' );
		
		break;	
		
		case 'ps':
		wp_enqueue_script( 'easymedia-klass' );
		wp_enqueue_script( 'easymedia-photoswipe' );
			
		break;
		
		case 'pbox':		
		wp_enqueue_script( 'easymedia-photobox' );
			
		break;					
						
		case 'wptb':		
		wp_enqueue_script('thickbox', null,  array('jquery'), true);
			
		break;					
						
		default:
		break;
		
	}

	// Load all required script and style
	//wp_enqueue_script( 'fittext' );		
	wp_enqueue_script( 'easymedia-isotope' );
	wp_enqueue_script( 'easymedia-frontend' );
	wp_enqueue_script( 'easymedia-jpages' );
	//wp_enqueue_script( 'easymedia-lazyload' );
	wp_enqueue_script( 'easymedia-lazy' );
	wp_enqueue_script( 'easymedia-imageloader' );
		
	if ( EMG_IS_AJAX == '1' ) { wp_enqueue_script( 'easymedia-ajaxfrontend' ); }
		
	( easy_get_option( 'easymedia_disen_autopl' ) == '1' ) ? $audautoplay = 'true' : $audautoplay = 'false';
	( easy_get_option( 'easymedia_disen_audio_loop' ) == '1' ) ? $audioloop = 'true' : $audioloop = 'false';
	( easy_get_option( 'easymedia_disen_autoplv' ) == '1' ) ? $autoplaya = '&autoplay=1' : $autoplaya = '';
	( easy_get_option( 'easymedia_disen_autoplv' ) == '1' ) ? $autoplayb = '?autoplay=1' : $autoplayb = '';
	( easy_get_option( 'easymedia_disen_autoplv' ) == '1' ) ? $autoplayc = '1' : $autoplayc = '0';
	( easy_get_option( 'easymedia_disen_rclick' ) == '1' ) ? $disenrclck = 'true' : $disenrclck = 'false';
	( easy_get_option( 'easymedia_cls_pos' ) == 'Bottom' ) ? $cbpos = '0' : $cbpos = '1';
	( easy_get_option( 'easymedia_sos_pos' ) == 'Bottom' ) ? $sspos = '0' : $sspos = '1';	
	( easy_get_option( 'easymedia_disen_autoplv' ) == '1' ) ? $autoplayd = 'true' : $autoplayd = 'false';	
	( easy_get_option( 'easymedia_disen_showcntr' ) == '1' ) ? $disencntr = 'true' : $disencntr = 'false';	
	//( easy_get_option( 'easymedia_disen_lazyload' ) == '1' ) ? $islazy = '1' : $islazy = '0';	
		
	$eparams = array(
		'nblaswf' => plugins_url( '/swf/NonverBlaster.swf' , __FILE__ ),
  		'audiovol' => easy_get_option( 'easymedia_audio_vol' ),
  		'audioautoplay' => $audautoplay,
  		'audioloop' => $audioloop,
  		'vidautopa' => $autoplaya,
  		'vidautopb' => $autoplayb,  
  		'vidautopc' => $autoplayc, 
  		'vidautopd' => $autoplayd,	
		'drclick' => $disenrclck,	
		'swcntr' => $disencntr,
		'pageffect' => easy_get_option( 'easymedia_pag_effect' ),	
		'ajaxconid' => easy_get_option( 'easymedia_ajax_con_id' ),
		'defstyle' => easy_get_option( 'easymedia_box_style' ),	
		'isslide' => easy_get_option( 'easymedia_disen_galsshow' ),	
		'probrintv' => easy_get_option( 'easymedia_slide_intv' ),								
  		'mediaswf' => plugins_url( '/addons/mediaelement/flashmediaelement.swf' , __FILE__ ), 
  		'ajaxpth' => admin_url('admin-ajax.php'),  // @since 1.5.1.7
  		'ovrlayop' => easy_get_option( 'easymedia_overlay_opcty' ) / 100,   
		'closepos' => $cbpos,	
		'lightboxstyle' => emg_slug_to_name( easy_get_option( 'easymedia_lightbox_style' ) ),
		'sospos' => $sspos,	
		//'islazy' => $islazy
		);

	wp_localize_script( 'easymedia-core', 'EasyM', $eparams );
	wp_localize_script( 'easymedia-frontend', 'EasyFront', $eparams );			
		
}
add_action( 'wp_enqueue_scripts', 'easymedia_frontend_script' );

function easymedia_frontend_prop()
{   		
ob_start(); ?>

<!-- Easy Media Gallery PRO START (version <?php echo EASYMEDIA_VERSION; ?>)-->

<style>
<?php emg_dynamic_css_generator(); ?>
</style>   

 <!--[if lt IE 9]>
<script src="<?php echo plugins_url( 'js/func/html5.js' , __FILE__ );  ?>" type="text/javascript"></script>
<![endif]-->   

 <!--[if lt IE 9]>
<script src="<?php echo plugins_url( 'js/func/html5shiv.js' , __FILE__ );  ?>" type="text/javascript"></script>
<![endif]-->  

<?php
if ( emg_slug_to_name( easy_get_option( 'easymedia_lightbox_style' ) ) == 'pbox' ) { ?>
<!--[if lt IE 9]><link rel="stylesheet" href="<?php echo EMGDEF_PLUGIN_URL . 'css/styles//photobox/photobox.ie.css';  ?>"><![endif]-->
<?php
}
?>

<!-- Easy Media Gallery PRO END  -->  
    
	<?php echo ob_get_clean();		
}
add_action( 'wp_head', 'easymedia_frontend_prop' );


/*
|--------------------------------------------------------------------------
| Easymedia Put Script if has Shortcode Function
|--------------------------------------------------------------------------
*/
function emg_old_has_shortcode($shortcode = '') {
	$post_to_check = get_post(get_the_ID());
	$found = false;
	
	if (!$shortcode) {
		return $found;
		}  

    if ( stripos($post_to_check->post_content, '[' . $shortcode) !== false ) {
		$found = true;
		}  
		
    return $found;  
}  

function easymedia_def_lightbox_sanitize(){ 
	global $post;
	if( function_exists('has_shortcode') )
	{
		if( has_shortcode( $post->post_content, 'easy-media') || has_shortcode( $post->post_content, 'easymedia-gallery') || has_shortcode( $post->post_content, 'easy-mediagallery') ) {
			add_action( 'wp_head', 'easymedia_def_lightbox_script' );
			add_action( 'wp_print_styles', 'easymedia_def_lightbox_styles' );
			
			}
		}
		else
		{
			if( emg_old_has_shortcode('easy-media') ||emg_old_has_shortcode('easymedia-gallery') || emg_old_has_shortcode('easy-mediagallery') ) {
				add_action( 'wp_head', 'easymedia_def_lightbox_script' );
				add_action( 'wp_print_styles', 'easymedia_def_lightbox_styles' );
				}
		}

// For Slider
	if( function_exists('has_shortcode') )
	{
		if( has_shortcode( $post->post_content, 'easymedia-slider-one') ||  has_shortcode( $post->post_content, 'easymedia-slider-two')) {
			add_action( 'wp_head', 'easymedia_slider_script' );
			add_action( 'wp_print_styles', 'easymedia_slider_style' );
			
			
			}
		}
		else
		{
			if( emg_old_has_shortcode('easymedia-slider-one') || emg_old_has_shortcode('easymedia-slider-two')) {
				add_action( 'wp_head', 'easymedia_slider_script' );
				add_action( 'wp_print_styles', 'easymedia_slider_style' );
				}
		}
		
// For Bxslider
	if( function_exists('has_shortcode') )
	{
		if( has_shortcode( $post->post_content, 'easymedia-carousel')) {
			add_action( 'wp_head', 'easymedia_bxslider_script' );
			add_action( 'wp_print_styles', 'easymedia_bxslider_style' );
			
			
			}
		}
		else
		{
			if( emg_old_has_shortcode('easymedia-carousel')) {
				add_action( 'wp_head', 'easymedia_bxslider_script' );
				add_action( 'wp_print_styles', 'easymedia_bxslider_style' );
				}
		}						

// For Fotorama
	if( function_exists('has_shortcode') )
	{
		if( has_shortcode( $post->post_content, 'easymedia-fotorama')) {
				add_action( 'wp_head', 'easymedia_fotorama_script' );
				add_action( 'wp_print_styles', 'easymedia_fotorama_style' );			
			}
		}
		else
		{
			if( emg_old_has_shortcode('easymedia-fotorama')) {
				add_action( 'wp_head', 'easymedia_fotorama_script' );
				add_action( 'wp_print_styles', 'easymedia_fotorama_style' );
				}
		}	
				
}

add_action( 'wp_enqueue_scripts', 'easymedia_def_lightbox_sanitize');

function easymedia_def_lightbox_script() {
	
		if ( easy_get_option( 'easymedia_plugin_core' ) != 'none' ) {wp_enqueue_script( 'mootools-core' ); }
		wp_enqueue_script( 'easymedia-core' );
		wp_enqueue_script( 'easymedia-mediaelementjs' );
}

function easymedia_def_lightbox_styles() {
	
		$boxstyle = EMGDEF_PLUGIN_URL . 'css/styles/mediabox';
		echo "<link rel=\"alternate stylesheet\" title=\"Dark\" type=\"text/css\" media=\"screen,projection\" href=\"$boxstyle/Dark.css\" />\n";
		echo "<link rel=\"alternate stylesheet\" title=\"Light\" type=\"text/css\" media=\"screen,projection\" href=\"$boxstyle/Light.css\" />\n";
		echo "<link rel=\"alternate stylesheet\" title=\"Transparent\" type=\"text/css\" media=\"screen,projection\" href=\"$boxstyle/Transparent.css\" />\n";
		wp_enqueue_style( 'easymedia_mediaelementplayer_skin', EMGDEF_PLUGIN_URL .'includes/addons/mediaelement/mediaelementplayer-skin-yellow.css' );		
}

function easymedia_slider_script() {
	
		wp_enqueue_script( 'easymedia-jssor-core' );
		wp_enqueue_script( 'easymedia-jssor-utils' );
		wp_enqueue_script( 'easymedia-jssor-slider' );
}

function easymedia_slider_style() {
	
		wp_enqueue_style( 'easymedia_jssor_style', EMGDEF_PLUGIN_URL .'css/styles/jssor/jssor-styles.css' );
}

function easymedia_bxslider_script() {
	
		wp_enqueue_script( 'easymedia-bxslider' );
		wp_enqueue_script( 'easymedia-bxslider-easing' );
}

function easymedia_bxslider_style() {
	
		wp_enqueue_style( 'easymedia_bxslider_style', EMGDEF_PLUGIN_URL .'css/styles/bxslider/jquery.bxslider.css' );
}

function easymedia_fotorama_script() {
	
		wp_enqueue_script( 'easymedia-fotorama' );
}

function easymedia_fotorama_style() {
	
		wp_enqueue_style( 'easymedia_fotorama_style', EMGDEF_PLUGIN_URL .'css/styles/fotorama/fotorama.css' );
}

?>