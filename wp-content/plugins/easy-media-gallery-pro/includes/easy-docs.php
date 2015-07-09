<?php

/*
	Version 1.0.0
	@since 1.5.1.7
	@author GhozyLab, Inc
	http://ghozylab.com/
*/

function emg_documentations() {

ob_start();
	
?>


    <div class="wrap">
        <div id="icon-edit" class="icon32 icon32-posts-easymedia"><br /></div>
        <h2><?php _e('Documentation & Help', 'easmedia'); ?></h2>
        <p><?php _e('This plugin comes with instructional training videos that walk you through every aspect of setting up your new media gallery. We recommend following these videos to setup your media gallery. This user manual is only intended to be a reference guide.', 'easmedia'); ?></p>

<!--Video Tutorials-->    
		<div class="metabox-holder">
			<div class="postbox" style="padding-right: 20px !important;">
				<h3><?php _e( 'Video Tutorials', 'easmedia' ); ?></h3>
        <div style="padding-left:10px !important;">
        <ul class="docvideolists">
        <li><a href="http://www.youtube.com/watch?v=TQ1MMxhsyD8" target="_blank" >How to Create Grid Gallery</a></li> 
		<li><a href="http://www.youtube.com/watch?v=OEoNB2LpnSE" target="_blank" >How to Create Filterable Media</a></li>  
        <li><a href="http://www.youtube.com/watch?v=-N0JNcToHOI" target="_blank" >How to Create Grid Gallery with Pagination</a></li>
        <li><a href="http://www.youtube.com/watch?v=BpqlkdLHdGU" target="_blank" >How to Set Gallery Default Filter</a></li>       
        <li><a href="http://www.youtube.com/watch?v=dXFBNY5t6E8" target="_blank" >How to Create Single Image Media</a></li>        
        <li><a href="http://www.youtube.com/watch?v=htxwZw_aPF0" target="_blank" >How to Create Video Media Types</a></li>
        <li><a href="http://www.youtube.com/watch?v=uAGWUcs5ofE" target="_blank" >How to Fetch Youtube or Vimeo Thumbnail</a></li>          
        <li><a href="http://www.youtube.com/watch?v=Bsn-CB5Hpbw" target="_blank" >How to Create Audio (mp3) Media Types</a></li>          
        <li><a href="http://www.youtube.com/watch?v=Oee2cpKT-kE" target="_blank" >How to Create Audio Soundcloud</a></li>
        <li><a href="http://www.youtube.com/watch?v=SYH8Yl2SQd4" target="_blank" >How to Create Audio Reverbnation</a></li>    
        <li><a href="http://www.youtube.com/watch?v=PEgfleRf6hg" target="_blank" >How to Create Google Maps</a></li>   
 		<li><a href="http://www.youtube.com/watch?v=BWmWAPb_z90" target="_blank" >How to Change Image Title, Subtitle &amp; Description</a></li>
		<li><a href="http://www.youtube.com/watch?v=skCMKvVLD5o" target="_blank" >How to Set Order of Image</a></li>             
        <li><a href="http://www.youtube.com/watch?v=9cuYyBMKx2k" target="_blank" >How to Insert Image into Media Description</a></li>            
        <li><a href="http://www.youtube.com/watch?v=Z2qwXz7GIRw" target="_blank" >How to Publish Easy Media Gallery</a></li>                  
        <li><a href="http://www.youtube.com/watch?v=2T73wvt_wOA" target="_blank" >How to Change Media Border Size and Color</a></li>
        <li><a href="http://www.youtube.com/watch?v=56f_C7OXiAE" target="_blank" >How to Change Media Columns</a></li>                
        </ul>
    </div>
    </div> 
  </div>
    
    <!--Troubleshooting-->    
 		<div class="metabox-holder">
			<div class="postbox" style="padding-right: 20px !important;">
				<h3><?php _e( 'Troubleshooting', 'easmedia' ); ?></h3>
        <div style="padding-left:10px !important;">
        <ul class="docscliststrb">
        <li><strong>Images not showing up on backend</strong><p>Sometimes you may face problem that your images are not displaying in the site, like <a target="_blank" class="thickbox" href="<?php echo plugins_url( 'images/thumbnail-error.png' , dirname(__FILE__) ) ?>">this example</a>. By default, the plugin is use Timthumb script to resize the images but some hosts do not allow the use of Timthumb for security reasons. Here's how to solve this problem:</p>
      <p>Go to Plugin Control Panel from Easy Media > Settings > Miscellaneous and turn OFF <b>Use TimThumb</b> option.</p>  
      <p></p>
      <p>If it still does not work please try solutions below :</p>
      <ul style="list-style: square; position:relative; margin-left:15px; margin-bottom:25px">
      <li>Make sure that you use image from wordpress media library, not from external site. Now try to re-upload your image to the media library, this issue usually occurs when you do import data from localhost (temporarily site) to the main site. If this still does not work please try the second option.</li>
    <li>If you move your WordPress website to a new domain name, you will find that internal links to pages and references to images are not updated. Instead, these links and references will point to your old domain name. <b>Velvet Blues Update URLs</b> plugin fixes that problem by helping you change old urls and links in your website. You can download <a href="https://wordpress.org/plugins/velvet-blues-update-urls/" target="_blank">here</a>.</li></ul>
    
        </li>     
        </ul>
        
        <ul class="docscliststrb">
        <li><strong>Images not showing up on frontend</strong><p>Sometimes you may face problem that your images only show a spinning icon and never finish loading, the issue is clearly that there are javascript conflict with your theme and/or some other plugins or there is the possibility of the use an outdated version of jQuery ( below version 1.8.3 ). Let's find out what causes of this issue:</p>
      <ul style="list-style: square; position:relative; margin-left:15px; margin-bottom:25px">
      <li>Please try to deactivating all plugins except Easy Media Gallery to see if this resolves the problem. If this works, re-activate the plugins one by one until you find the problematic plugin(s). If this still does not work please try the second options. </li>
    <li>Please switch to default Wordpress theme such as <b>Twenty Twelve</b> or <b>Twenty Eleven</b> for a bit and try again.</li></ul>
        </li>
<p>If you already know the causes or if you can't find a solution to your problem and need further assistance please contact our Technical Support team.</p> 
        </ul>
        
        <ul class="docscliststrb">
        <li><strong>When trying to activate the license key the icon arrows just keep spinning and it never finish.</strong><p>This issue usually occurs because there are javascript conflict with another plugins or your theme. Please follow the following steps to solve this issue:</p>
      <ul style="list-style: square; position:relative; margin-left:15px; margin-bottom:25px">
      <li>Disable all your other plugins except Easy Media Gallery for a while.</li>
    <li>Switch to the default WordPress theme such as <b>Twenty Twelve</b> or <b>Twenty Eleven</b> for a while.</li>
     <li>Go to Easy Media > License Manager and try again to activate the license. If works you can re-enable all other plugins and switch the theme back.</li>
      <li>DONE</li>
    </ul>
        </li>
        </ul>
        
        <ul class="docscliststrb">
        <li><strong>No activation left for this license key. Please contact us if you want to add more sites.</strong><p>This issue usually occurs because you already activate the license for other sites or in temporary site. Please follow the following steps to solve this issue:</p>
      <ul style="list-style: square; position:relative; margin-left:15px; margin-bottom:25px">
      <li>Login to your old/previous/temporary sites. If the site is no longer exist so <b>YOU MUST</b> re-build that site.</li>
    <li>Install and activate Easy Media Gallery plugin</li>
     <li>Go to Easy Media > License Manager and activate the license, when activated you can deactivate the license. This step will reset the license usage from our license server.</li>
      <li>Login to your new site, go to Easy Media > License Manager and activate the license.</li>
      <li>DONE</li>
    </ul>
        </li>
        </ul>
        
       <ul class="docscliststrb">
        <li><strong>Can not insert the shortcode, when click on "Easy Media Gallery" button is nothing happens</strong><p>Recently one of our users reported a very odd issue above with their install. FYI, this problem is not caused by Easy Media Gallery because you will face the same issue with or without Easy Media Plugin installed. But we will try to share how to fix it.</p>
      <ul style="list-style: square; position:relative; margin-left:15px; margin-bottom:25px">
      <li>Please login via FTP, open your wp-config.php file and add the following line at the very top after the php opening tag.<p class="emgcodea">define('CONCATENATE_SCRIPTS', false);</p> </li>
      </ul>
        </li>
<p>This trick fixed the issue for our user who reported this issue.</p> 
        </ul>
        
        
        
    </div>
    </div>    
  </div>


<!-- Contact Form -->
		<div class="metabox-holder">
			<div class="postbox" style="padding-right: 20px !important;">
				<h3><?php _e('Contact Us', 'easmedia'); ?></h3>
        <div style="padding-left:10px !important;">
        <p>Use the following form to contact our support teams directly. Make sure to fill correct <b>License Key</b> and <b>Reply-To</b> email address.<br />If you do not get an email reply within 2 days please use this <a href="http://ghozylab.com/plugins/submit-support-request/" target="_blank">link</a></p><br />
        <ul class="">
        <li>
<?php

if ( is_admin() ) {
	ob_start();
    emg_html_form_code();
	$cpform = ob_get_clean();
	echo $cpform;
	} else {
		echo '<p>Admin Only!</p>';
		}

?>
        
        </li>                
        </ul>
        <br />
    </div>
    </div> 
  </div>  
<!-- END Contact Form -->


<!--Shortcode Parameters (Attributes)-->    
		<div class="metabox-holder">
			<div class="postbox" style="padding-right: 20px !important;">
				<h3><?php _e( 'Shortcode Parameters (Attributes)', 'easmedia' ); ?></h3>
        <div style="padding-left:10px !important;">
        <p>You can use the following shortcode attributes in your current shortcode to fit your needs. Actually, this option can be made easily via shortcode manager.</p>
                <ul class="docsclists">
                <li><strong>Order</strong></li>
                <p><strong>order="asc or desc"</strong> is the way to ordering your gallery list. The default order is <strong>desc</strong> ( <i>from newest to oldest</i> ), you can reverse it by adding <strong>asc</strong> order parameter. Usage:</p>   
<p class="emgcodea">[easymedia-gallery med="113" <strong>order="asc"</strong>]</p> 

                <li><strong>Filter</strong></li>
                <p><strong>Filter</strong> parameter is use to show / hide your gallery categories / filter. Set the value to 1 if you want to show the filter or set to 0 if you want to hide.<br />This attribute can only be applied to Gallery ( <i>easymedia-gallery</i> ) or Filterable Media ( <i>easy-mediagallery</i> ) shortcode type. Usage:</p> 
<p class="emgcodea">[easymedia-gallery med="109,111,113" <strong>filter="1"</strong>]</p>  

                <li><strong>Size</strong></li>
                <p><strong>size="width,height"</strong> parameter can be used to set your gallery thumbnails size so that you can set the different size for each gallery. If this parameter is not included in your shortcode then the thumbnails size will use the global settings ( <i>see on Easy Media > Settings > General</i> ). Usage:</p>   
<p class="emgcodea">[easymedia-gallery med="113" <strong>size="270,210"</strong>]</p> 

                <li><strong>Pag</strong></li>
                <p><strong>Pag="number"</strong> or pagination is very useful when you are displaying images in a large amount. Set the <i>number</i> with number of items to be displayed per page. Usage:</p>   
<p class="emgcodea">[easymedia-gallery med="113" <strong>pag="10"</strong>]</p> 

                <li><strong>Def</strong></li>
                <p><strong>Def="Media ID"</strong> Specifies which gallery or category to be used as default on first load. For example, you have 3 galleries with each name Flowers (<i>ID = 113</i>), Fruits (<i>ID = 125</i>) and Animals (<i>ID = 177</i>), if you set the value with 113 so only Fruits gallery that will be displayed when the page is loaded for the first time. Usage:</p>   
<p class="emgcodea">[easymedia-gallery med="113, 125, 177" <strong>def="125"</strong>]</p> 

                <li><strong>Cmode</strong></li>
                <p><strong>cmode="type"</strong> is the parameter to align the cropping region to different edges of the image. The following example will crop your image thumbnail in center ( <i>this is the default</i> ).</p>   
<p class="emgcodea">[easymedia-gallery med="113" <strong>cmode="c"</strong>]</p> 
<p>As with everything the parameters are straightforward to understand. They are:</p> 
<ul>
	<li><strong>c</strong> : position in the center ( <i>this is the default</i> )</li>
	<li><strong>t</strong> : align top</li>
	<li><strong>tr</strong> : align top right</li>
	<li><strong>tl</strong> : align top left</li>
	<li><strong>b</strong> : align bottom</li>
	<li><strong>br</strong> : align bottom right</li>
	<li><strong>bl</strong> : align bottom left</li>
	<li><strong>l</strong> : align left</li>
	<li><strong>r</strong> : align right</li>
</ul>

                <li style="margin-top: 30px;"><strong>Zcs</strong></li>
                <p><strong>zcs="type"</strong> is the parameter that allows you to crop and zoom your gallery thumbnail on the fly. Usage:</p>   
<p class="emgcodea">[easymedia-gallery med="113" <strong>zcs="1"</strong>]</p> 
<p>Available options for this parameter:</p> 
<ul>
	<li><strong>0</strong> : Resize to Fit specified dimensions ( <i>no cropping</i> )</li>
	<li><strong>1</strong> : Crop and resize to best fit the dimensions ( <i>this is the default</i> )</li>
	<li><strong>2</strong> : Resize proportionally to fit entire image into specified dimensions</li>
	<li><strong>3</strong> : Resize proportionally adjusting size of scaled image</li>

</ul>
        </ul>


    </div>
    </div> 
     </div> 
  
  
 </div>  
	<?php 
	
	
		
/* END DOCS */

$docnhelp = ob_get_clean();
echo $docnhelp;


}


?>