<?php

/**
 * 
 * This function holds all the setup info for your
 * custom post type(s).
 * 
 * We're putting it into one function so that you can
 * setup multiple post types without having to call
 * a bunch of add_actions()
 * 
 */
function create_post_types(){
	
	/**
	 * 
	 * register_post_type() creates each custom post
	 * type.
	 * 
	 * To create another post type, just copy and paste
	 * the register_post_type() function call and change
	 * out all the values.
	 * 
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 * 
	 */
	
	register_post_type( 'wpb_{PLURAL_LOWERCASE}',
		array(
			'labels' => array(
				'name' => '{PLURAL}',
				'singular_name' => '{SINGULAR}',
				'add_new' => 'Add New {SINGULAR}',
				'add_new_item' => 'Add New {SINGULAR}',
				'edit_item' => 'Edit {SINGULAR}',
				'new_item' => 'New {SINGULAR}'
			),
			'public' => true,
			'rewrite' => array(
				'slug' => '{PLURAL_LOWERCASE}'
			),
			'supports' => array(
				'title',
				'editor',
				'excerpt',
				'page-attributes',
				'revisions',
				'thumbnail'
			)
		)
	);

}

/**
 * 
 * Call the create_post_types() function
 * when the site is loaded
 * 
 */
add_action('init', 'create_post_types');