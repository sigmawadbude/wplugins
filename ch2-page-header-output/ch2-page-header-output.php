<?php

/*
Plugin Name: Page Header Output
Plugin URI: 
Description: Companion to recipe 'Adding output content to page headers using plugin actions'
Version: 1.0.0
Author: SigMA Wadbude <sigma.wadbude@gmail.com>
Author URI: 
License: GPLv2
*/

/* 
Copyright (C) 2018 SigMA Wadbude <sigma.wadbude@gmail.com>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
*/

add_action( 'wp_head', 'ch2pho_page_header_output' );

function ch2pho_page_header_output(){ ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview');
    </script>
<?php }

add_filter( 'the_content', 'ch2lfa_link_filter_analytics' );

function ch2lfa_link_filter_analytics ( $the_content ) {
	$new_content = str_replace( 'href', 'onClick="recordOutboundLink(this);return false;" href', $the_content );

	return $new_content;
}

add_action( 'wp_footer', 'ch2lfa_footer_analytics_code' );

function ch2lfa_footer_analytics_code() { ?>
    
<script type="text/javascript">
  function recordOutboundLink( link ) {
	ga('send', 'event', 'Outbound Links', 'Click',
		link.href, {
			'transport': 'beacon',
			'hitCallback': function() { 
				document.location = link.href; 
			}
		} );
	}
</script>

<?php }


add_filter( 'wp_nav_menu_objects', 'ch2nmf_new_nav_menu_items', 10, 2 );

function ch2nmf_new_nav_menu_items( $sorted_menu_items, $args ) {

	// Check if used is logged in, continue if not logged
	if ( is_user_logged_in() == FALSE ) {
		// Loop through all menu items received
		// Place each item's key in $key variable
		foreach ( $sorted_menu_items as $key => $sorted_menu_item ) {
			// Check if menu item title matches search string
			if ( 'Private Area' == $sorted_menu_item->title ) {
				// Remove item from menu array if found using
				// item key
				unset( $sorted_menu_items[ $key ] );
			}
		}
	}

	return $sorted_menu_items;
}