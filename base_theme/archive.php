<?php
/**
 * @package WordPress
 * @subpackage YOUR_THEME
 */

get_header(); ?>

	<?php 
	if (have_posts()) : ?>

		<?php 
		$post = $posts[0];
		
		if (is_category()): ?>
			<h1>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h1>
		<?php
		elseif( is_tag() ): ?>
			<h1>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h1>
		<?php
		elseif (is_day()): ?>
			<h1>Archive for <?php the_time('F jS, Y'); ?></h1>
		<?php
		elseif (is_month()): ?>
			<h1>Archive for <?php the_time('F, Y'); ?></h1>
		<?php
		elseif (is_year()): ?>
			<h1>Archive for <?php the_time('Y'); ?></h1>
		<?php
		elseif (is_author()): ?>
			<h1>Author Archive</h1>
		<?php
		elseif (isset($_GET['paged']) && !empty($_GET['paged'])): ?>
			<h1>Blog Archives</h1>
		<?php
		endif; ?>

		<?php 
		while (have_posts()) : the_post(); ?>
			
			<div <?php post_class() ?>>
			
				<h3 id="post-<?php the_ID(); ?>"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				
				<small><?php the_time('l, F jS, Y') ?></small>

				<?php the_content() ?>

				<p class="postmetadata"><?php the_tags('Tags: ', ', ', '<br />'); ?> Posted in <?php the_category(', ') ?> | <?php edit_post_link('Edit', '', ' | '); ?>  <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>

			</div> <!-- post -->

		<?php 
		endwhile; ?>

		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	
	<?php 
	else :

		if ( is_category() ) { // If this is a category archive
			printf("<h2 class='center'>Sorry, but there aren't any posts in the %s category yet.</h2>", single_cat_title('',false));
		} else if ( is_date() ) { // If this is a date archive
			echo("<h2>Sorry, but there aren't any posts with this date.</h2>");
		} else if ( is_author() ) { // If this is a category archive
			$userdata = get_userdatabylogin(get_query_var('author_name'));
			printf("<h2 class='center'>Sorry, but there aren't any posts by %s yet.</h2>", $userdata->display_name);
		} else {
			echo("<h2 class='center'>No posts found.</h2>");
		}
		get_search_form();

	endif; ?>

<?php 
get_sidebar(); ?>

<?php 
get_footer(); ?>