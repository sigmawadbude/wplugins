<?php

/*
Plugin Name: Object-Oriented Private Item Text
Plugin URI: 
Description: 
Version: 1.0.0
Author: SigMA Wadbude <sigma.wadbude@gmail.com>
Author URI: 
License: GPLv2
*/

class OO_Private_Item_Text{
    function __construct() {
        add_shortcode( 'private', array( $this, 'ch2pit_private_shortcode' ) );
        add_action( 'init', array( $this, 'ch2pit_queue_stylesheet' ) );
    }
    
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

    function ch2pit_queue_stylesheet() {
        wp_enqueue_style( 'privateshortcodestyle', plugins_url( 'stylesheet.css', __FILE__ ) );
    }
}

$my_oo_private_item_text = new OO_Private_Item_Text();