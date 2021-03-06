<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package Emphaino
 * @since Emphaino 1.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<?php if( get_theme_mod('non_responsive') != 'on' ): ?>
<meta name="viewport" content="width=device-width" />
<?php endif; ?>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php do_action( 'before' ); ?>


	<header id="masthead" class="site-header" role="banner">
		<div id="top-bar">
			<nav role="navigation" class="site-navigation main-navigation">
				<div class="home-page-link"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="icon-home" title ="<?php _e('Home', 'emphaino'); ?>"><span>Home</span></a></div>
				
				<?php if( $emphaino_menu = wp_nav_menu( array( 'theme_location' => 'primary', 'fallback_cb' => '', 'echo' => false ) ) ): ?>

					<h1 class="assistive-text icon-menu"><span><?php _e( 'Menu', 'emphaino' ); ?></span></h1>
					<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'emphaino' ); ?>"><?php _e( 'Skip to content', 'emphaino' ); ?></a></div>
					<?php echo $emphaino_menu; ?>

				<?php endif; ?>

				
			</nav> <!-- .site-navigation .main-navigation -->

			<?php get_search_form(); ?>

		</div>	

		<div class="header-main">
			<?php if( $emphaino_logo_image = get_theme_mod('logo_image') ) : ?>
			<div id="logo-image">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo $emphaino_logo_image; ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" /></a>
			</div>
			<?php endif; ?>
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div>
		</div>

	</header><!-- #masthead .site-header -->
				<?php 
					$language = pinedrop_get_language($wp_query);
					$post_type = '';
					if ($wp_query->is_single()) {
						$post_type = $wp_query->get_queried_object()->post_type;
					}
				?>
				<?php if ($language != 'none' && $post_type == 'summary'): ?>
					<h1 class="entry-title">
						<a href="http://139.59.180.173/summary/<?php echo strtolower(str_replace(' ', '-', $language)); ?>"><?php echo $language; ?></a>
					</h1>
				<?php endif; ?>
				<header class="page-header" data-active-language="<?php print $language; ?>">
					<?php echo do_shortcode( '[searchandfilter submit_label="Show" class="language-content-filter" all_items_labels="All languages,All" fields="language,post_types" types="select,radio" post_types="ava,avv,per,pic,res"]'); ?>
				</header>
						
	<div id="main" class="site-main">
