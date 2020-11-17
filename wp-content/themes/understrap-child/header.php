<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

    <!-- ******************* The Navbar Area ******************* -->
    <div id="wrapper-navbar">

        <a class="skip-link sr-only sr-only-focusable"
           href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>

        <nav id="main-nav" class="navbar navbar-expand-md navbar-dark fixed-top mt-5" aria-labelledby="main-nav-label">

            <div class="container-fluid bg-dark border-top border-bottom py-1">
                <h2 id="main-nav-label" class="sr-only">
					<?php esc_html_e( 'Main Navigation', 'understrap' ); ?>
                </h2>

				<?php if ( 'container' === $container ) : ?>
                <div class="container">
					<?php endif; ?>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                            aria-controls="navbarNavDropdown" aria-expanded="false"
                            aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- The WordPress Menu goes here -->
					<?php
					wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'navbarNavDropdown',
							'menu_class'      => 'navbar-nav w-100 d-flex align-items-stretch justify-content-between',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'depth'           => 2,
							'walker'          => new Understrap_WP_Bootstrap_Navwalker2(),
						)
					);
					?>
					<?php if ( 'container' === $container ) : ?>
                </div><!-- .container -->
			<?php endif; ?>
            </div>

        </nav><!-- .site-navigation -->

    </div><!-- #wrapper-navbar end -->

    <div class="banner-wrap">
        <div class="container">
			<?php
			if ( is_home() && get_field( 'post_banner', get_option( 'page_for_posts' ) ) ) {
				echo wp_get_attachment_image( get_field( 'post_banner', get_option( 'page_for_posts' ) ), 'full', false, array( 'class' => 'banner' ) );
			} else if ( is_home() || ! get_field( 'post_banner', $post->ID ) ) {
				echo wp_get_attachment_image( get_field( 'page_banner', 'theme_options' ), 'full', false, array( 'class' => 'banner' ) );
			} else {
				echo wp_get_attachment_image( get_field( 'post_banner', $post->ID ), 'full', false, array( 'class' => 'banner' ) );
			}

			if ( is_home() && get_field( 'custom_content', get_option( 'page_for_posts' ) ) ) {
				echo get_field( 'banner_content', get_option( 'page_for_posts' ) );
			} else if ( is_home() || is_single() ) {
				echo '<h1 class="page_title default">' . get_the_title( get_option( 'page_for_posts' ) ) . '</h1>';
			} else if ( get_field( 'custom_content', $post->ID ) ) {
				echo get_field( 'banner_content', $post->ID );
			} else {
				echo '<h1 class="page_title default">' . $post->post_title . '</h1>';
			}
			?>
        </div>
    </div>
