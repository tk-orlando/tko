<?php

/*-------------------------------------------------------------------------------*/
/*   Dynamic CSS @since 1.5.1.7
/*-------------------------------------------------------------------------------*/
function emg_dynamic_css_generator() {
	
$frmcol = easy_get_option( 'easymedia_frm_col' );
$shdcol = easy_get_option( 'easymedia_shdw_col' );
$mrgnbox = easy_get_option( 'easymedia_margin_box' );
$imgborder = easy_get_option( 'easymedia_frm_border' );
$curstyle = strtolower( easy_get_option( 'easymedia_cur_style' ) );
$cuscss = easy_get_option( 'easymedia_custom_css' );
$imgbbrdrradius = easy_get_option( 'easymedia_brdr_rds' );
$disenbor = easy_get_option( 'easymedia_disen_bor' );
$disenshadow = easy_get_option( 'easymedia_disen_sdw' );
$brdrbtm = $mrgnbox * 2;
$marginhlf = $mrgnbox / 2;
$theoptstl = easy_get_option( 'easymedia_frm_size' );
$globalwidth = stripslashes( $theoptstl[ 'width' ] );
$pattover = easy_get_option( 'easymedia_style_pattern' );
$overcol = easy_get_option( 'easymedia_overlay_col' );
$probarcol = easy_get_option( 'easymedia_pbar_col' );
$probarintv = easy_get_option( 'easymedia_slide_intv' );
$probarcolrgb = easymedia_hex2rgb( easy_get_option( 'easymedia_pbar_col' ) );
$fltrcol = easymedia_hex2rgb( easy_get_option( 'easymedia_filter_col' ) );
$ttlcol = easy_get_option( 'easymedia_ttl_col' );
$thumbhov = ucfirst( easy_get_option( 'easymedia_hover_style' ) ) . '.png';
$thumbhov = plugins_url( 'css/images/' . $thumbhov . '', dirname(__FILE__) );
$thumbhovcol = easymedia_hex2rgb( easy_get_option( 'easymedia_thumb_col' ) );
$thumbhovcolopcty = easy_get_option( 'easymedia_hover_opcty' ) / 100;
$thumbiconcol = easy_get_option( 'easymedia_icon_col' );
$disenico = easy_get_option( 'easymedia_disen_ticon' );
$borderrgba = easymedia_hex2rgb( easy_get_option( 'easymedia_frm_col' ) );
$borderrgbaopcty = easy_get_option( 'easymedia_thumb_border_opcty' ) / 100;
$thumbttlpos = easy_get_option( 'easymedia_ttl_pos' );


ob_start();
   
// IMAGES
echo '.view {margin-bottom:'.$mrgnbox.'px; margin-right:'.$marginhlf.'px; margin-left:'.$marginhlf.'px;}';
echo '.da-thumbs article.da-animate p, p.da-animatenh, .emgtitle, .bx-caption span {color:'.$ttlcol.' !important;}';
if ( easy_get_option( 'easymedia_disen_icocol' ) == '1' ) {
echo 'span.link_post, span.zoom, span.zooma {background-color:'.$thumbiconcol.';}';
}

if ( easy_get_option( 'easymedia_disen_hovstyle' ) == '1' ) {
echo '.da-thumbs article.da-animate {cursor: '.$curstyle.';}';
}
else {
echo '.da-thumbs img {cursor: '.$curstyle.';}';
}

( $imgbbrdrradius != '' ) ? $addborradius = '#slider1_container, #slider2_container, .view,.view img,.da-thumbs,.da-thumbs article.da-animate {border-radius:'.$imgbbrdrradius.'px;}' : $addborradius = '';
echo $addborradius;

( $disenbor == 1 ) ? $addborder = '.emgfotorama, .view, #slider1_container, #slider2_container {border: '.$imgborder.'px solid rgba('.$borderrgba.','.$borderrgbaopcty.');}' : $addborder = '';
echo $addborder; 

( $disenico == 1 ) ? $showicon = '' : $showicon = '.forspan, .forspana {display: none !important;}' ;
echo $showicon; 

( $disenshadow == 1 ) ? $addshadow = '.emgfotorama, .bx-viewport, #slider1_container, #slider2_container, .view {-webkit-box-shadow: 1px 1px 3px '.$shdcol.';
   -moz-box-shadow: 1px 1px 3px '.$shdcol.';
   box-shadow: 1px 1px 3px '.$shdcol.';}' : $addshadow = '.bx-viewport, #slider1_container, #slider2_container, .view { box-shadow: none !important; -moz-box-shadow: none !important; -webkit-box-shadow: none !important;}';
echo $addshadow; 

// MEDIA BOX Patterns
if ( $pattover != '' || $pattover != 'no_pattern' ) {	
echo '#mbOverlay, .emg_overlay, .fbx-modal, #cboxOverlay, #lightboxOverlay, .fancybox-overlay, .fancybox-overlay-fixed, #fancybox-overlay, .pp_overlay, #TB_overlay {background: url('.EMGDEF_PLUGIN_URL.'css/images/patterns/'.$pattover.') !important; background-repeat: repeat;}';
}

// MEDIA BOX Color Overlay
if ( $overcol != '' ) {	
echo '#mbOverlay, .emg_overlay, .fbx-modal, #cboxOverlay, #lightboxOverlay, .fancybox-overlay, .fancybox-overlay-fixed, #fancybox-overlay, .pp_overlay, #TB_overlay {background-color:'.$overcol.' !important;}';
}

// MEDIA BOX Progressbar
if ( $probarcol != '' ) {	
echo '.fullwidth #expand {background:'.$probarcol.' !important; box-shadow:0px 0px 6px 1px rgba('.$probarcolrgb.',0.2);-moz-animation:fullexpand '.$probarintv.'s ease-out;-webkit-animation:fullexpand '.$probarintv.'s ease-out;}';
}

// Thumbnails Title Background color
echo '.bx-caption, .emgtitle, p.emgfittext { background: rgba('.easymedia_hex2rgb( easy_get_option( 'easymedia_ttl_back_col' ) ).',0.5) !important;}';

// MEDIA BOX Title Position
if ( $thumbttlpos == 'Top' ) {	
echo '.bx-caption, .emgtitle, p.da-animatenh, .da-thumbs article.da-animate p{margin-top: 0px !important; top:0px;}';
}
else if ( $thumbttlpos == 'Bottom' ) {	
echo '.bx-caption, .emgtitle, p.da-animatenh, .da-thumbs article.da-animate p{margin-bottom: 0px !important; bottom:0px;}';
}

// MEDIA BOX close button Position
if ( easy_get_option( 'easymedia_cls_pos' ) == 'Top' ) {	
echo '.lb-closeContainer{
	top: 10px;
}';
} else {
echo '.lb-closeContainer{
	bottom: 10px;
}';
}

// MEDIA FILTER
echo '#emgoptions .portfolio-tabs a:hover, #emgoptions a.selected {color: rgb('.$fltrcol.') !important;}';
echo '#emgoptions a.selected {border-top: 3px solid rgb('.$fltrcol.') !important;}';
echo '#filters { list-style-type: none !important;}';

// IE <8 Handle

		preg_match( '/MSIE (.*?);/', $_SERVER['HTTP_USER_AGENT'], $matches );
		if ( isset($matches) ) {
			if ( count( $matches )>1 && $disenbor == 1 ){
				$version = explode(".", $matches[1]);
				
				switch(true){
					case ( $version[0] <= '8' ):
						echo '.view {border: 1px solid '.$shdcol.';}';
						echo '.iehand {border: '.$imgborder.'px solid '.$frmcol.';}';
						echo '.emgmask, .da-thumbs article{position: absolute; background-image:url('.$thumbhov.'); background-repeat:repeat; width: 100%; height: 100%;}';
						break; 
			  
					case ( $version[0] > '8' ):
					( $disenbor == 1 ) ? $addborder = '.view {border: '.$imgborder.'px solid rgba('.$borderrgba.','.$borderrgbaopcty.');}' : $addborder = '';
						echo $addborder; 			  
						echo '.emgmask, .emgview, .da-thumbs article{position: absolute; background: rgba('.$thumbhovcol.','.$thumbhovcolopcty.'); background-repeat:repeat; width: 100%; height: 100%;}';			  
			  
						break; 			  
			  
			  
			  		default:
					break;
					}
				}
		
				else if ( count( $matches )>1 && $disenbor != '1' ) {
					echo '.emgmask, .emgview, .da-thumbs article{position: absolute; background-image:url('.$thumbhov.'); background-repeat:repeat; width: 100%; height: 100%;}';
					}
		  
				else {
					echo '.emgmask, .emgview, .da-thumbs article{position: absolute; background: rgba('.$thumbhovcol.','.$thumbhovcolopcty.'); background-repeat:repeat; width: 100%; height: 100%;}';
					} 
			}

// Gallery Nav
if ( easy_get_option( 'easymedia_disen_galnav' ) == '1' ) {

echo '#mbPrevLink {
    	background: url("'.EMGDEF_PLUGIN_URL.'css/images/prev.png") no-repeat scroll 0% 0% transparent !important;
    	width: 40px !important;
    	height: 80px !important;
		position: absolute !important;
		left: 15px !important;
		z-index:100000;
		opacity: 0.7;
		outline: none !important;
		margin-top:-100px !important;
}

#mbNextLink {
    	background: url("'.EMGDEF_PLUGIN_URL.'css/images/next.png") no-repeat scroll 0% 0% transparent !important;
    	width: 40px !important;
    	height: 80px !important;
		position: absolute !important;
		right: 15px !important;
		z-index:100000;	
		opacity: 0.7;
		outline: none !important;
		margin-top:-100px !important;
}';

} else {
	echo '#cboxPrevious, #cboxNext, .fbx-prev, .fbx-next {display: none !important;}';
	
}

// Gallery Counter
if ( easy_get_option( 'easymedia_disen_showcntr' ) != '1' ) {
	
	echo 'span.fbx-count, #cboxCurrent, .lb-number {display: none !important;}
	#cboxSlideshow {left: 15px !important;}';

}

// Share Button Style
if ( easy_get_option( 'easymedia_sos_pos' ) == 'Top' ) {

echo '#mbsosmed ul #sosmedfb span {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -53px 0px transparent;}

#mbsosmed ul #sosmedfb span:hover {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -53px -25px transparent;}

#mbsosmed ul #sosmedtw span {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -27px 0px transparent;}

#mbsosmed ul #sosmedtw span:hover {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -27px -25px transparent;}

#mbsosmed ul #sosmedpn span {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -1px 0px transparent;		
	opacity: 0.7;}

#mbsosmed ul #sosmedpn span:hover {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -1px -25px transparent;}
	
#mbsosmed ul #sosmedgp span {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -79px -0px transparent;	
	opacity: 0.7;	
}

#mbsosmed ul #sosmedgp span:hover {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -79px -25px transparent;		
}

#mbsosmed ul #sosmedeml span {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -105px 0px transparent;	
	opacity: 0.7;	
}

#mbsosmed ul #sosmedeml span:hover {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -105px -25px transparent;		
}

#mbsosmed ul #sosmeddl span {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -131px 0px transparent;	
	opacity: 0.7;	
}

#mbsosmed ul #sosmeddl span:hover {
	background: url('.EMGDEF_PLUGIN_URL.'css/images/sprite_sosmed.png) no-repeat -131px -25px transparent;		
}';
}

// Magnify Icon
if ( easy_get_option( 'easymedia_mag_icon' ) != '' && $disenico == 1 ) {	
echo '	
span.zoom{
background-image:url('.EMGDEF_PLUGIN_URL.'css/images/magnify/'.easy_get_option( 'easymedia_mag_icon' ).'.png); background-repeat:no-repeat; background-position:center;
}';	
}

// Badge Color
echo 'span.emg-badges{background:url('.EMGDEF_PLUGIN_URL.'css/images/badges/'.easy_get_option( 'easymedia_badge_col' ).'.png); background-repeat:no-repeat; background-position:center;
}';	

// Badge Position
if ( easy_get_option( 'easymedia_badge_pos' ) == 'Top Left' ) {	
echo 'span.emg-badges{left:1px; top:1px;}';
}
else if ( easy_get_option( 'easymedia_badge_pos' ) == 'Top Right' ) {	
echo 'span.emg-badges{right:1px; top:1px;}';
}
else if ( easy_get_option( 'easymedia_badge_pos' ) == 'Bottom Right' ) {	
echo 'span.emg-badges{right:1px; bottom:1px;}';
}
else if ( easy_get_option( 'easymedia_badge_pos' ) == 'Bottom Left' ) {	
echo 'span.emg-badges{left:1px; bottom:1px;}';
} 
else if ( easy_get_option( 'easymedia_badge_pos' ) == 'Bottom Center' ) {	
echo 'span.emg-badges{right:0; left:0; bottom: 1px; margin: auto;}';
}
else if ( easy_get_option( 'easymedia_badge_pos' ) == 'Top Center' ) {	
echo 'span.emg-badges{right:0; left:0; top:1px; margin: auto;}';
}
else if ( easy_get_option( 'easymedia_badge_pos' ) == 'Center' ) {	
echo 'span.emg-badges{top: 0;right: 0;bottom: 0;left: 0;margin: auto;}';
}
else {
echo 'span.emg-badges{right:1px; top:1px;}';	
}

// CUSTOM CSS
if ( $cuscss != '' ) {
echo $cuscss ; 
echo "\n"; 
}

$content = ob_get_clean();
echo emg_css_compress( $content );

}



?>