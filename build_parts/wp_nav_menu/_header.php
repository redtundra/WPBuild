<?php

/*
	
	theme_location corresponds to the value
	you set in functions.php in register_nav_menus()

*/

wp_nav_menu(array(
	'theme_location' => 'main',
	'container' => 'div', 
	'container_id' => '', 
	'menu_class' => '', 
	'menu_id' => '')
);

?>