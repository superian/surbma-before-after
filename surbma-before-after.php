<?php

/*
Plugin Name: CPS | Before / After Images
Plugin URI: https://surbma.com/wordpress-plugins/
Description: Simply add a before / after image to any WordPress website.

Version 2.2

Author: Ian, after version 2.1 by CherryPick Studios (https://www.cherrypickstudios.com/)

License: GPLv2

Text Domain: surbma-before-after
Domain Path: /languages/
*/

// Prevent direct access to the plugin
if ( !defined( 'ABSPATH' ) ) exit( 'Good try! :)' );

// Localization
function nai_before_after_init() {
	load_plugin_textdomain( 'nai-before-after', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'nai_before_after_init' );

function nai_before_after_scripts( ) {
	wp_enqueue_script( 'nai-before-after-event-move', plugins_url( '', __FILE__ ) . '/js/jquery.event.move.js', array('jquery'), '2.0.0', true );
	wp_enqueue_script( 'nai-before-after-twentytwenty', plugins_url( '', __FILE__ ) . '/js/jquery.twentytwenty.js', array('jquery'), '1.0.0', true );

	wp_enqueue_style( 'nai-before-after-twentytwenty-style', plugins_url( '', __FILE__ ) . '/css/twentytwenty.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'nai_before_after_scripts' );

function nai_before_after_footer_scripts() {
?>
<script>jQuery(function(){jQuery(".twentytwenty-container").twentytwenty();});</script>
<?php
}
add_action( 'wp_footer', 'nai_before_after_footer_scripts', 999 );

function before_after_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'before_src' => '',
		'before_alt' => '',
		'after_src' => '',
		'after_alt' => '',
		'width' => '',
		'height' => '',
		'left_description' => '',
		'right_description' => '',
	), $atts ) );
	return '<div class="twentytwenty-container"><img src="'.$before_src.'" alt="'.$before_alt.'" width="'.$width.'" height="'.$height.'" /><img src="'.$after_src.'" alt="'.$after_alt.'" width="'.$width.'" height="'.$height.'" left="'.$left__description.'" right="'.$right__description.'"/></div>';
}
add_shortcode( 'nai-before-after', 'before_after_shortcode' );
