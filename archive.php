<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */

get_header(); ?>

		<section id="primary" class="content-area">
			<div id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>
				
				<?php emphaino_content_nav( 'nav-above' ); ?>

				<?php if ( 'dynamic_grid_excerpts' == get_theme_mod( 'posts_layout', emphaino_default_settings('posts_layout') ) ) echo '<div id="dynamic-grid" class="clearfix">'; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php if ( 'dynamic_grid_excerpts' == get_theme_mod( 'posts_layout', emphaino_default_settings('posts_layout') ) ) echo '</div> <!-- #dynamic-grid -->'; ?>

				<?php emphaino_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

			</div><!-- #content .site-content -->
		</section><!-- #primary .content-area -->

<?php if( get_theme_mod( 'sidebar_in_posts_index' ) == 'on' ) get_sidebar(); ?>
<?php get_footer(); ?>