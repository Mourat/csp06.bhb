<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function understrap_remove_scripts() {
	wp_dequeue_style( 'understrap-styles' );
	wp_deregister_style( 'understrap-styles' );

	wp_dequeue_script( 'understrap-scripts' );
	wp_deregister_script( 'understrap-scripts' );

	// Removes the parent themes stylesheet and scripts from inc/enqueue.php
}

add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {

	// Get the theme data
	$the_theme = wp_get_theme();
	wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css', array(), $the_theme->get( 'Version' ) );
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Enqueue child theme styles and scripts
 */
add_action( 'wp_enqueue_scripts', 'child_scripts' );
if ( ! function_exists( 'child_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function child_scripts() {
		// Get the theme data.
		$the_theme     = wp_get_theme();
		$theme_version = $the_theme->get( 'Version' );

		wp_enqueue_script( 'jquery' );

		$css_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/style.css' );
		wp_enqueue_style( 'child-styles', get_stylesheet_directory_uri() . '/style.css', array(), $css_version );

		$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/scripts.js' );
		wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/scripts.js', array(), $js_version );

		if ( is_home() ) {
			$js_version = $theme_version . '.' . filemtime( get_stylesheet_directory() . '/blog.grid.js' );
			wp_enqueue_script( 'blog_grid-script', get_stylesheet_directory_uri() . '/blog.grid.js', array(), $js_version );
		}
	}
}

/**
 * Register Textdomain
 */
function add_child_theme_textdomain() {
	load_child_theme_textdomain( 'understrap-child', get_stylesheet_directory() . '/languages' );
}

add_action( 'after_setup_theme', 'add_child_theme_textdomain' );

/**
 * Remove admin bar if option checked
 */
add_action( 'after_setup_theme', 'remove_admin_bar' );
function remove_admin_bar() {
	show_admin_bar( get_field( 'show_admin_bar', 'theme_options' ) );
}

/**
 * Replace menu item title by logo if option checked
 */
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects', 10, 2 );
function my_wp_nav_menu_objects( $items ) {
	foreach ( $items as &$item ) {
		$show_logo = get_field( 'show_logo', $item );
		$logo      = get_field( 'logo', 'theme_options' );

		if ( $show_logo ) {
			$item->title = '<img class="site-logo" src="' . wp_get_attachment_image_url( $logo ) . '" alt="" />';
		}
	}

	return $items;
}

/**
 * ACF OPTIONS PAGE
 */
require 'inc/acf.php';

/**
 * Nav menu walker with removed html filtering
 */
require 'inc/class-wp-bootstrap-navwalker.php';

/**
 * Register 4 footer widget zones
 */
add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 1' ),
		'id'            => "foobar-1",
		'description'   => '',
		'class'         => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
	) );
} );

add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 2' ),
		'id'            => "foobar-2",
		'description'   => '',
		'class'         => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
	) );
} );

add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 3' ),
		'id'            => "foobar-3",
		'description'   => '',
		'class'         => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
	) );
} );

add_action( 'widgets_init', function () {
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar 4' ),
		'id'            => "foobar-4",
		'description'   => '',
		'class'         => '',
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => "</h2>\n",
	) );
} );


/**
 * Register widget showing contacts from theme options
 */
wp_register_sidebar_widget(
	'contacts_widget',
	__( 'Contacts', 'understrap-child' ),
	function () {
		$output = '';
		$output .= '<div class="address">' . __( 'Address', 'understrap-child' ) . ': ' . get_field( 'address', 'theme_options' ) . '</div>';
		$output .= '<div class="phone">' . __( 'Phone', 'understrap-child' ) . ': ' . get_field( 'phone', 'theme_options' ) . '</div>';
		$output .= '<div class="email">' . __( 'Email', 'understrap-child' ) . ': ' . get_field( 'email', 'theme_options' ) . '</div>';

		echo $output;
	},
	array(
		'description' => __( 'Show contacts from Theme Options', 'understrap-child' )
	)
);

/**
 * Custom navigation for Post
 */
if ( ! function_exists( 'child_post_nav' ) ) {
	/**
	 * Display navigation to next/previous post when applicable.
	 */
	function child_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
        <nav class="container navigation post-navigation">
            <h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'understrap' ); ?></h2>
            <div class="row nav-links justify-content-between">
				<?php
				if ( get_previous_post_link() ) {
					previous_post_link( '<span class="nav-previous">%link</span>', __( 'Previous', 'understrap-child' ) );
				}
				if ( get_next_post_link() ) {
					next_post_link( '<span class="nav-next">%link</span>', __( 'Next', 'understrap-child' ) );
				}
				?>
            </div><!-- .nav-links -->
        </nav><!-- .navigation -->
		<?php
	}
}

if ( ! function_exists( 'short_content' ) ) {
	/**
	 * Show n words from variable
	 */
	function short_content( $content, $number_words ) {
		return apply_filters( 'the_content', wp_trim_words( preg_replace( '~\[[^\]]+\]~', '', strip_tags( $content ) ), $number_words ) );
	}

}
