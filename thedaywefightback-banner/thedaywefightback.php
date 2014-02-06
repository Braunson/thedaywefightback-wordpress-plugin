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

    function add_thedaywefightback_banner() {
        //$widget_link = plugins_url( 'thedaywefightback.min.js' , __FILE__ );
        $widget_link = '//d1agz031tafz8n.cloudfront.net/thedaywefightback.js/widget.min.js';
        echo "<!--[if !(lte IE 8)]><!-->
<script type=\"text/javascript\"> 
  // @license magnet:?xt=urn:btih:0b31508aeb0634b347b8270c7bee4d411b5d4109&dn=agpl-3.0.txt GPL-v3-or-Later
  (function(){
    var e = document.createElement('script'); e.type='text/javascript'; e.async = true;
    e.src = document.location.protocol + '" . $widget_link . "';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(e, s);
  })();
  // @license-end
</script>
<!--<![endif]-->";
    }
    
    add_action('wp_footer', 'add_thedaywefightback_banner', 1);

?>