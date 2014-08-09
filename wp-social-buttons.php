<?php
/*
Plugin Name: WP Social Buttons
Plugin URI: http://www.mrwebsolution.in/
Description: "wp-social-buttons" is the very simple plugin for add to social buttons on your site!.
Author: Raghunath
Author URI: http://raghunathgurjar.wordpress.com
Version: 1.0
*/

/*  Copyright 2014  Raghunath Gurjar  (email : raghunath.0087@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

//Admin "WP Social Buttons" Menu Item
add_action('admin_menu','wpsb_sidebar_menu');

function wpsb_sidebar_menu(){

	add_options_page('WP Social Buttons','WP Social Buttons','manage_options','wpsb-settings','wpsb_sidebar_admin_option_page');

}

//Define Action for register "WP Social Buttons" Options
add_action('admin_init','wpsb_sidebar_init');


//Register "WP Social Buttons" options
function wpsb_sidebar_init(){
	register_setting('wpsb_sidebar_options','wpsb_active');
	register_setting('wpsb_sidebar_options','wpsb_position');
	register_setting('wpsb_sidebar_options','wpsb_top_margin');
	register_setting('wpsb_sidebar_options','wpsb_delayTimeBtn');
	register_setting('wpsb_sidebar_options','wpsb_page_hide_home');
	register_setting('wpsb_sidebar_options','wpsb_page_hide_post');
	register_setting('wpsb_sidebar_options','wpsb_page_hide_page');
	register_setting('wpsb_sidebar_options','wpsb_fpublishBtn');	
	register_setting('wpsb_sidebar_options','wpsb_tpublishBtn');	
	register_setting('wpsb_sidebar_options','wpsb_gpublishBtn');	
	register_setting('wpsb_sidebar_options','wpsb_ppublishBtn');	
	register_setting('wpsb_sidebar_options','wpsb_lpublishBtn');	
} 


// Add settings link to plugin list page in admin
        function wpsb_add_settings_link( $links ) {
            $settings_link = '<a href="options-general.php?page=wpsb-settings">' . __( 'Settings', 'wpsb' ) . '</a>';
            array_unshift( $links, $settings_link );
            return $links;
        }

        $plugin = plugin_basename( __FILE__ );
        add_filter( "plugin_action_links_$plugin", 'wpsb_add_settings_link' );

/* 

*Display the Options form for Custom Tweets 

*/

function wpsb_sidebar_admin_option_page(){ ?>

	<div style="width: 80%; padding: 10px; margin: 10px;"> 

	<h1>WP Social Buttons Settings</h1>
	
	

<!-- Start Options Form -->

	<form action="options.php" method="post" id="wpsb-sidebar-admin-form">
		<table class="cssfw">
			<tr><th>&nbsp;</th>
				<td>&nbsp;</td>
				<td rowspan="24" valign="top" style="padding-left: 20px;border-left:1px solid #ccc;">
					<h2>Plugin Author:</h2>
	<div style="font-size: 14px; display:none;">
	<img src="<?php echo  plugins_url( 'images/raghu.jpg' , __FILE__ );?>" width="100" height="100"><br><a href="http://raghunathgurjar.wordpress.com" target="_blank">Raghunath Gurjar</a><br><br><a href="mailto:raghunath.0087@gmail.com" target="_blank">Contact Me!</a><br><br>Author Blog <a href="http://raghunathgurjar.wordpress.com" target="_blank">http://raghunathgurjar.wordpress.com</a>
	<br><br><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=WN785E5V492L4" target="_blank" style="font-size: 17px; font-weight: bold;">Donate for this plugin</a><br><br>
	My Other Plugins:<br>
	<ol>
		<li><a href="https://wordpress.org/plugins/simple-testimonial-rutator/" target="_blank">Simple Testimonial Rutator(Responsive)</a></li>
		<li><a href="https://wordpress.org/plugins/custom-share-buttons-with-floating-sidebar/" target="_blank">Custom Share Buttons With Floating Sidebar</a></li>
		<li><a href="https://wordpress.org/plugins/wp-easy-recipe/" target="_blank">WP Easy Recipe</a></li>
		</ol>
	</div></td>
			</tr>
			<tr><th>Enable: </th><td><input type="checkbox" id="wpsb_active" name="wpsb_active" value='1' <?php if(get_option('wpsb_active')!=''){ echo ' checked="checked"'; }?>/></td></tr>
			<tr>
				<th nowrap><?php echo 'Siderbar Position:';?></th>
				<td>
				<select id="wpsb_position" name="wpsb_position" >
				<option value="left" <?php if(get_option('wpsb_position')=='left'){echo 'selected="selected"';}?>>Left</option>
				<option value="right" <?php if(get_option('wpsb_position')=='right'){echo 'selected="selected"';}?>>Right</option>
				</select>
				</td>
			</tr>
			<tr><th nowrap valign="top"><?php echo 'Delay Time: '; ?></th><td><input type="text" name="wpsb_delayTimeBtn" id="wpsb_delayTimeBtn" value="<?php echo get_option('wpsb_delayTimeBtn')?get_option('wpsb_delayTimeBtn'):2000;?>"  size="15"><br><i>Publish share buttons after given time(millisecond)</i></td></tr>
			<tr>
				<th><?php echo 'Top Margin:';?></th>
				<td>
				<input type="text" id="wpsb_top_margin" name="wpsb_top_margin" value="<?php echo get_option('wpsb_top_margin'); ?>" placeholder="10% OR 10px" size="15"/>
				</td>
			</tr>
			<tr><td colspan="2" border="1"><h2 style="width: 80%; border-bottom: 1px solid #666; padding-top: 10px; padding-bottom: 10px;"><strong>Social Share Button Publish Options</strong></h2></td></tr>
			<tr>
				<th valign="top"><?php echo 'Publish Buttons:';?></th>
				<td valign="top"><input type="checkbox" id="publish1" value="yes" name="wpsb_fpublishBtn" <?php if(get_option('wpsb_fpublishBtn')=='yes'){echo 'checked="checked"';}?>/> <b>Facebook Button</b><br>
				<input type="checkbox" id="publish2" name="wpsb_tpublishBtn" value="yes" <?php if(get_option('wpsb_tpublishBtn')=='yes'){echo 'checked="checked"';}?>/> <b>Twitter Button</b><br>
				<input type="checkbox" id="publish3" name="wpsb_gpublishBtn" value="yes" <?php if(get_option('wpsb_gpublishBtn')=='yes'){echo 'checked="checked"';}?>/> <b>Google Button</b><br>
				<input type="checkbox" id="publish4" name="wpsb_lpublishBtn" value="yes" <?php if(get_option('wpsb_lpublishBtn')=='yes'){echo 'checked="checked"';}?>/> <b>Linkdin Button</b><br>
				<input type="checkbox" id="publish6" name="wpsb_ppublishBtn" value="yes" <?php if(get_option('wpsb_ppublishBtn')=='yes'){echo 'checked="checked"';}?>/> <b>Pinterest Button</b>
				</td>
			</tr>
				<tr><td colspan="2">&nbsp;</td></tr>		
			<tr>
				<th>&nbsp;</th>
				<td><?php echo get_submit_button('Save Settings','button-primary','submit','','');?></td>
			</tr>	
			<tr><td colspan="2">&nbsp;</td></tr>		
		</table>
    <?php settings_fields('wpsb_sidebar_options'); ?>
	
	</form>

<!-- End Options Form -->
	</div>

<?php
}

require dirname(__FILE__).'/wpsb-class.php';
	
/* 

*Delete the options during disable the plugins 

*/

if( function_exists('register_uninstall_hook') )

	register_uninstall_hook(__FILE__,'wpsb_sidebar_uninstall');   

//Delete all Custom Tweets options after delete the plugin from admin
function wpsb_sidebar_uninstall(){
	delete_option('wpsb_active');
	delete_option('wpsb_position');
	delete_option('wpsb_top_margin');
	delete_option('wpsb_page_hide_home');
	delete_option('wpsb_page_hide_post');
	delete_option('wpsb_page_hide_page');
	delete_option('csbwfs_fpublishBtn');
	delete_option('csbwfs_tpublishBtn');
	delete_option('csbwfs_gpublishBtn');	
	delete_option('csbwfs_ppublishBtn');	
	delete_option('csbwfs_lpublishBtn');

} 
?>
