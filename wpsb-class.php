<?php 
// get all options value for "Custom Share Buttons with Floating Sidebar"
	function get_wpsb_sidebar_options() {
		global $wpdb;
		$ctOptions = $wpdb->get_results("SELECT option_name, option_value FROM $wpdb->options WHERE option_name LIKE 'wpsb_%'");
								
		foreach ($ctOptions as $option) {
			$ctOptions[$option->option_name] =  $option->option_value;
		}
	
		return $ctOptions;	
	}
	
// Get plugin options

$pluginOptionsVal=get_wpsb_sidebar_options();
//check plugin in enable or not
if(isset($pluginOptionsVal['wpsb_active']) && $pluginOptionsVal['wpsb_active']==1){
add_action('wp_footer','get_wpsb_sidebar_content');
add_action( 'wp_enqueue_scripts', 'wpsb_sidebar_scripts' );
add_action('wp_footer','wpsb_sidebar_load_inline_js');
}

//register style and scrip files
function wpsb_sidebar_scripts() {
wp_enqueue_script( 'jquery' ); // wordpress jQuery
wp_register_style( 'wpsb_sidebar_style', plugins_url( 'css/wpsb.css',__FILE__ ) );
wp_enqueue_style( 'wpsb_sidebar_style' );
}

/*
-----------------------------------------------------------------------------------------------
                              "Add the jQuery code in head section using hooks"
-----------------------------------------------------------------------------------------------
*/

function wpsb_sidebar_load_inline_js()
{
   $pluginOptionsVal=get_wpsb_sidebar_options();
	$jscnt='<script>jQuery(document).ready(function()
  { ';
 
 
  if($pluginOptionsVal['wpsb_delayTimeBtn']!='0'):
   $jscnt.='jQuery("#delaydiv").hide();
	setTimeout(function(){
	 jQuery("#delaydiv").fadeIn();}, '.$pluginOptionsVal['wpsb_delayTimeBtn'].');';
  endif;  
  
  if($pluginOptionsVal['wpsb_tpublishBtn']!=''):
  $jscnt.='jQuery("div#tw a").hover(function(){
  jQuery("div#tw a").animate({width:"60px"});
  },function(){
    jQuery("div#tw a").stop( true, true ).animate({width:"45px"});
  });';
  endif;
  
  if($pluginOptionsVal['wpsb_fpublishBtn']!=''):
  $jscnt.='jQuery("div#fb a").hover(function(){
    jQuery("div#fb a").animate({width:"60px"});
  },function(){
    jQuery("div#fb a").stop( true, true ).animate({width:"45px"});
  });';
  endif;
  
  if($pluginOptionsVal['wpsb_mpublishBtn']!=''):
  $jscnt.='jQuery("div#ml a").hover(function(){
    jQuery("div#ml a").animate({width:"60px"});
  },function(){
    jQuery("div#ml a").stop( true, true ).animate({width:"45px"});
  });';
  endif;
  
  if($pluginOptionsVal['wpsb_gpublishBtn']!=''):
  $jscnt.='jQuery("div#gp a").hover(function(){
    jQuery("div#gp a").animate({width:"60px"});
  },function(){
    jQuery("div#gp a").stop( true, true ).animate({width:"45px"});
  });';
  endif;
  
  if($pluginOptionsVal['wpsb_lpublishBtn']!=''):
  $jscnt.='jQuery("div#li a").hover(function(){
    jQuery("div#li a").animate({width:"60px"});
  },function(){
    jQuery("div#li a").stop( true, true ).animate({width:"45px"});
  });';
  endif;
  
   if($pluginOptionsVal['wpsb_ppublishBtn']!=''):
  $jscnt.='jQuery("div#pin a").hover(function(){
    jQuery("div#pin a").animate({width:"60px"});
  },function(){
    jQuery("div#pin a").stop( true, true ).animate({width:"45px"});
  });';
  endif;

  $jscnt.='jQuery("div.show").hide();
  jQuery("div.show a").click(function(){
    jQuery("div#social-inner").show(500);
     jQuery("div.show").hide(500);
    jQuery("div.hide").show(500);
  });
  
  jQuery("div.hide a").click(function(){
     jQuery("div.show").show(500);
      jQuery("div.hide").hide(500);
     jQuery("div#social-inner").hide(500);
  });';
  
$jscnt.='});</script>';

$jscnt.='<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
</script><script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script><script type="text/javascript" src="https://apis.google.com/js/platform.js"></script>';
	
	echo $jscnt;
}	

/*
-----------------------------------------------------------------------------------------------
                              "WP Social Buttons" HTML
-----------------------------------------------------------------------------------------------
*/

/*
-----------------------------------------------------------------------------------------------
                              "WP Social Buttons" HTML
-----------------------------------------------------------------------------------------------
*/

function get_wpsb_sidebar_content() {
	global $post;
$pluginOptionsVal=get_wpsb_sidebar_options();

// Top Margin
if($pluginOptionsVal['wpsb_top_margin']!=''){
	$margin=$pluginOptionsVal['wpsb_top_margin'];
}else
{
	$margin='25%';
	}

//Sidebar Position
if($pluginOptionsVal['wpsb_position']=='right'){
	$style=' style="top:'.$margin.';right:-5px;"';
	$idName=' id="wpsb-right"';
	$showImg='hide.png';
	$hideImg='show.png';
	
}else
{
	$idName=' id="wpsb-left"';
	$style=' style="top:'.$margin.';left:0;"';
    $showImg='show.png';
	$hideImg='hide.png';
	}
?>
<div id="delaydiv">
<div class='social-widget' <?php echo $idName;?> title="Share This With Your Friends" <?php echo $style;?> >

<div class="show"><a href="javascript:" alt="Email" id="show"><img src="<?php echo plugins_url('wp-social-buttons/images/'.$showImg);?>" title="Show Buttons"></a></div>

<div id="social-inner">
	<div class="sbutton">
		<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=170994699765546&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<div class="fb-like" data-href="http://wordpress.org" data-layout="box_count" data-action="like" data-show-faces="true" data-share="false"></div>
	</div>
	<div class="sbutton">
		<div id="tw"><a href="https://twitter.com/share" class="twitter-share-button"  data-count="vertical" data-url="http://wordpress.org">Tweet</a>
</div>
	</div>
	<div class="sbutton">
		<div id="gp"><!-- Place this tag in your head or just before your close body tag. -->


<!-- Place this tag where you want the +1 button to render. -->
<div class="g-plusone" data-size="tall" data-href="http://wordpress.org"></div></div>
	</div>
	<div class="sbutton">
		<div id="li"><script src="//platform.linkedin.com/in.js" type="text/javascript">
  lang: en_US
</script>
<script type="IN/Share" data-url="http://wordpress.org" data-counter="top"></script></div>
	</div>
	<div class="sbutton">
		<div id="pin"><a href="//www.pinterest.com/pin/create/button/?url=http://wordpress.org&media=http://farm8.staticflickr.com/7027/6851755809_df5b2051c9_z.jpg&description=Next stop: Pinterest" data-pin-do="buttonPin" data-pin-config="above" data-pin-color="red" data-pin-height="20"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_red_20.png" /></a>
<!-- Please call pinit.js only once per page -->

	</div></div>

</div>

<div class="hide"><a href="javascript:" alt="Email" id="hide"><img src="<?php echo plugins_url('wp-social-buttons/images/'.$hideImg);?>" title="Hide Buttons"></a></div>

</div>
</div>
<?php
}
