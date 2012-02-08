<?php
/**
 * @package WordPress
 * @subpackage YOUR_THEME
 */

add_theme_support('automatic-feed-links');

/*

	Load up the scripts

*/

function wpbuild_scripts(){
	
	if(is_admin()){ return; }
	
	wp_deregister_script('jquery');
	
	wp_register_script('jquery', 'http://code.jquery.com/jquery-1.7.1.min.js', false, '1.7.1');
	wp_enqueue_script('jquery');
	
	// wp_register_script('nivo-slider', get_bloginfo('template_url') . '/inc/js/jquery.nivo.slider.pack.js', false, '1.0', true);
	// wp_enqueue_script('nivo-slider');
	
	wp_register_script('main', get_bloginfo('template_url') . '/inc/js/main.js', false, '1.0', true);
	wp_enqueue_script('main');
	
}

add_action('init', 'wpbuild_scripts');

{FUNCTIONS}