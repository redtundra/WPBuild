<?php
/**
 * @package WordPress
 * @subpackage YOUR_THEME
 */
?>

<!doctype html>

<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

	<head profile="http://gmpg.org/xfn/11">
	
		<meta charset="utf-8">
		
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		
		{CSS}
						
		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
		
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		
		<?php wp_head(); ?>
	
	</head>
	
	<body <?php body_class(); ?>>
	
		<div id="header">
		
			<?php
			if(is_home() || is_front_page()): ?>
				<h1 id="logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></h1>
			<?php
			else: ?>
				<div id="logo"><a href="<?php echo get_option('home'); ?>/"><?php bloginfo('name'); ?></a></div>
			<?php
			endif; ?>

			{WP_NAV_MENU}
		
		</div> <!-- header -->
		
		<div id="content">