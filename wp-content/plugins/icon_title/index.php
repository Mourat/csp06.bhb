<?php
/*
	Plugin Name: Title with icon
*/

if ( ! function_exists( 'icon_title_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function icon_title_scripts() {
		$css_version = filemtime( plugin_dir_path(__FILE__) . 'styles.css' );
		wp_enqueue_style( 'icon_title-styles', plugin_dir_url(__FILE__) . 'styles.css', array(), $css_version );
	}
} // End of if function_exists( 'child_scripts' ).

add_action( 'wp_enqueue_scripts', 'icon_title_scripts' );

// Require new custom Element
add_action('plugins_loaded', function(){
	require_once( plugin_dir_path(__FILE__) . '/vc-components/vc-component.php' );
});

/**
 * Register Textdomain
 */
function add_icon_title_textdomain() {
	load_child_theme_textdomain( 'icon_title', plugin_dir_path(__FILE__) . '/languages' );
}
add_action( 'after_setup_theme', 'add_icon_title_textdomain' );
