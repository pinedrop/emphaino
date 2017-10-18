<?php
/**
 * @package Emphaino
 * @since Emphaino 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php $language = pinedrop_get_language($wp_query); ?>
	<?php $post_type = get_post_type(); ?>


	<header class="entry-header">
		<h4 class="entry-language"><?php print pinedrop_post_language_link(); ?></h4>
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
                <?php if (in_array($post_type, array('ava', 'avv'))): ?>
                        <?php if ($post_type == 'ava'): ?>
                                <?php if ($shortcode = pinedrop_wpmedia_shortcode('audio', 'wpcf-audiofiles')) echo do_shortcode($shortcode); ?>
                        <?php else: ?>
                                <?php if ($shortcode = pinedrop_videojs_shortcode()) echo do_shortcode($shortcode); ?>
                        <?php endif; ?>

			<?php $trid = pinedrop_get_trid(array_pop(explode('/', get_post_meta(get_the_ID(), 'wpcf-transcript', true)))); ?>
                        <?php if ($trid): ?>
				<?php $q = get_query_var('q'); ?>
				<?php $options = $q ? array('term' => $q) : array(); ?>
                                <?php $ui = transcripts_ui_ui($trid, $options); ?>
                                <?php print(transcripts_ui_render_controls($ui)); ?>
                                <div id="av-tabs">
                                        <ul>
                                                <li><a href="#tabs-about">About</a></li>
                                                <li><a href="#tabs-transcript">Transcript</a></li>
                                        </ul>
                                        <div id="tabs-about">
                                                <?php the_content(); ?>
                                        </div>
                                        <div id="tabs-transcript">
                                                <?php print(transcripts_ui_render($ui)); ?>
                                        </div>
                                </div>
                        <?php else: ?>
                                <?php the_content(); ?>
                        <?php endif; ?>
		<?php else: ?>
                	<?php if( has_post_thumbnail() && 'on' == get_theme_mod( 'full_posts_feat_img', emphaino_default_settings('full_posts_feat_img') ) ): ?>
                		<div class="featured-image">
                        		<?php the_post_thumbnail('full-width'); ?>
                		</div>
                	<?php endif; // featured image ?>
			<?php the_content(); ?>
		<?php endif; ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links icon-docs">' . __( 'Pages:', 'emphaino' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<span class="post-type"><?php print pinedrop_post_type(); ?></span>
		<?php emphaino_posted_on(); ?>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'emphaino' ) );
			if ( $categories_list && emphaino_categorized_blog() ) :
		?>
		<span class="cat-links icon-folder">
			<?php printf( __( 'Posted in %1$s', 'emphaino' ), $categories_list ); ?>
		</span>
		<?php endif; // End if categories ?>

		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'emphaino' ) );
			if ( $tags_list ) :
		?>
		<span class="tags-links icon-tag">
			<?php printf( __( 'Tagged %1$s', 'emphaino' ), $tags_list ); ?>
		</span>
		<?php endif; // End if $tags_list ?>

		<span class="permalink icon-link"><a href="<?php echo get_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php _e('Post Permalink', 'emphaino'); ?></a></span>

		<?php edit_post_link( __( 'Edit', 'emphaino' ), '<span class="edit-link icon-pencil">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
