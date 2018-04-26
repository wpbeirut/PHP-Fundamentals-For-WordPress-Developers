<?php
/******************************************************************
	* Template Name : Wpbeirut Page Template
	* The template for displaying demo pages
	* From Wordpress Beirut Community With Love...
******************************************************************/
// get the header of wordpress to include all header methods including css, js etc.
get_header();
// check if have posts , in case yes enter the wordpress loop
if( have_posts() ) {
	// wordpress default loop check if have posts to display the post.
	while( have_posts() ) {
		// render the post
		the_post();
		
		//method 1 for adding html - by closing php tags
		// also to render certain common fields in wordpress
		?>
	
		<article id="<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
		</article>
	
	<?php	
		
		// method 2 for adding html - by echoing out the markup
		// this method use concatination with echo.
		echo '<article id="' . the_ID() . '"' . post_class() . '>';
			the_content();
		echo '</article>';
	}
	
}
else {
	// what happens if there are no posts
}
// get the sidebar
get_sidebar();
// get the footer
get_footer();

/* Note to make a template work for you, you need to name the page same as the 	header
Template Name : Wpbeirut Page Template, this line of the code is the magic in detecting the page for you
in case you didn't respect the naming convension, wordpress won't detect your page. */
