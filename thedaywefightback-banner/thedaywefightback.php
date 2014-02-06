<?php
/*
Plugin Name: The Day We Fight Back Banner
Plugin Script: thedaywefightback.php
Plugin URI: https://thedaywefightback.org/
Description: This plugin adds the The Day We Fight Back (https://thedaywefightback.org) banner into your theme.
Version: 1.0
License: GPL
Author: Taskforce.is
Author URI: https://thedaywefightback.org

=== RELEASE NOTES ===
2013-10-18 - v1.0 - Initial release
*/

/* 
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
Online: http://www.gnu.org/licenses/gpl.txt
*/


function tdwfb_register_settings() {
	add_option( 'tdwfb_greeting', '');
	add_option( 'tdwfb_debug_mode', '0');
	add_option( 'tdwfb_over_date', '0');
	add_option( 'tdwfb_force_intl', '0');
	add_option( 'tdwfb_call_only', '0');
    
	register_setting( 'default', 'tdwfb_greeting' );     
	register_setting( 'default', 'tdwfb_debug_mode' ); 
	register_setting( 'default', 'tdwfb_over_date' ); 
	register_setting( 'default', 'tdwfb_force_intl' ); 
    register_setting( 'default', 'tdwfb_call_only' );
} 
add_action( 'admin_init', 'tdwfb_register_settings' );
 
function tdwfb_register_options_page() {
	add_options_page('The Day We Fight Back - Banner Settings', 'TDWFB Settings', 'manage_options', 'tdwfb-options', 'tdwfb_options_page');
}
add_action('admin_menu', 'tdwfb_register_options_page');

function tdwfb_options_page() {
    $option_greeting = get_option('tdwfb_greeting');
    $option_debug = get_option('tdwfb_debug_mode');
    $option_over_date = get_option('tdwfb_over_date');
    $option_force_intl = get_option('tdwfb_force_intl');
    $option_call_only = get_option('tdwfb_call_only');
?>
<div class="wrap">
    <?php screen_icon(); ?>
    <h2>The Day We Fight Back - Banner Settings</h2>
    <form method="post" action="options.php"> 
        <?php settings_fields( 'default' ); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row"><label for="tdwfb_greeting">Greeting</label></th>
                <td>
                    <input type="text" id="tdwfb_greeting" name="tdwfb_greeting" value="<?php echo $option_greeting; ?>" />
                    Leaving this blank will default the banner to 'Dear Internet'.
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="tdwfb_force_intl">Force International</label></th>
                <td>
                    <select id="tdwfb_force_intl" name="tdwfb_force_intl">
                        <option value="1"<?php if($option_force_intl == 1) echo ' selected'; ?>>Enabled</option>
                        <option value="0"<?php if($option_force_intl == 0) echo ' selected'; ?>>Disabled</option>
                    </select>
                    If enabled, the banner will be displayed regardless of location.
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="tdwfb_debug_mode">Debug Mode</label></th>
                <td>
                    <select id="tdwfb_debug_mode" name="tdwfb_debug_mode">
                        <option value="1"<?php if($option_debug == 1) echo ' selected'; ?>>Enabled</option>
                        <option value="0"<?php if($option_debug == 0) echo ' selected'; ?>>Disabled</option>
                    </select>
                    If enabled, the banner shows even if the date is not yet 02/11/2014
               </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="tdwfb_over_date">Overrride Date</label></th>
                <td>
                    <select id="tdwfb_over_date" name="tdwfb_over_date">
                        <option value="1"<?php if($option_over_date == 1) echo ' selected'; ?>>Yes</option>
                        <option value="0"<?php if($option_over_date == 0) echo ' selected'; ?>>No</option>
                    </select>
                    If enabled, the banner shows even if the date is not yet 02/11/2014.
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label for="tdwfb_call_only">Call Only</label></th>
                <td>
                    <select id="tdwfb_call_only" name="tdwfb_call_only">
                        <option value="1"<?php if($option_call_only == 1) echo ' selected'; ?>>Yes</option>
                        <option value="0"<?php if($option_call_only == 0) echo ' selected'; ?>>No</option>
                    </select>
                    If enabled, the banner only displays a form for calling congress.
                </td>
            </tr>
        </table>
        <?php submit_button(); ?>
    </form>
</div>
<?php
}

    function add_thedaywefightback_banner() {
        echo "<!--[if !(lte IE 8)]><!-->
<script type=\"text/javascript\"> 
  // @license magnet:?xt=urn:btih:0b31508aeb0634b347b8270c7bee4d411b5d4109&dn=agpl-3.0.txt GPL-v3-or-Later
  var tdwfb_config = {
    " . ((get_option('tdwfb_greeting') != NULL)?"greeting: '" . esc_js ( get_option('tdwfb_greeting') ) . "',":'') . "
    " . ((get_option('tdwfb_over_date') == '1')?'disableDate: true,':'') . "
    " . ((get_option('tdwfb_call_only') == '1')?'callOnly: true,':'') . "
    " . ((get_option('tdwfb_debug_mode') == '1')?'debug: true,':'') . "
    " . ((get_option('tdwfb_force_intl') == '1')?"overrideLocation: 'international'":"") . "
  };
  (function(){
    var e = document.createElement('script'); e.type='text/javascript'; e.async = true;
    e.src = document.location.protocol + '//d1agz031tafz8n.cloudfront.net/thedaywefightback.js/widget.min.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(e, s);
  })();
  // @license-end
</script>
<!--<![endif]-->";
    }
    
    add_action('wp_footer', 'add_thedaywefightback_banner', 1);

?>