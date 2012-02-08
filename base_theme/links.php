<?php
/**
 * @package WordPress
 * @subpackage YOUR_THEME
 *
 * Template Name: Links
 *
 */

get_header(); ?>

<h2>Links:</h2>

<ul>
	<?php wp_list_bookmarks(); ?>
</ul>

<?php 
get_footer(); ?>
