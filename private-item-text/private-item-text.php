<?php

/*
Plugin Name: private-item-text
Plugin URI: 
Description: 
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

// Declare enclosing shortcode 'private' with associated function
add_shortcode( 'private', 'ch2pit_private_shortcode' );

// Function that is called when the 'private' shortcode is found
function ch2pit_private_shortcode( $atts, $content = null ) {
    if ( is_user_logged_in() )
        return '<div class="private">' . $content . '</div>';
    else {
        $output = '<div class="register">';
		$output .= 'You need to become a member to access ';
		$output .= 'this content.</div>';
		return $output;	
	}
}

// Associate function to queue stylesheet to be output in page header
add_action( 'wp_enqueue_scripts', 'ch2pit_queue_stylesheet' );

// Function to load style in stylesheet queue
function ch2pit_queue_stylesheet() {
	wp_enqueue_style( 'privateshortcodestyle', plugins_url( 'stylesheet.css', __FILE__ ) );
}