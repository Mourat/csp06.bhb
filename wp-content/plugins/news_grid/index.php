<?php
/*
	Plugin Name: 5 Last News Grid
*/

if ( ! function_exists( 'child_scripts' ) ) {
	/**
	 * Load theme's JavaScript and CSS sources.
	 */
	function news_grid_scripts() {
		$css_version = filemtime( plugin_dir_path(__FILE__) . 'styles.css' );
		wp_enqueue_style( 'news_grid-styles', plugin_dir_url(__FILE__) . 'styles.css', array(), $css_version );
	}
} // End of if function_exists( 'child_scripts' ).

add_action( 'wp_enqueue_scripts', 'news_grid_scripts' );

// Require new custom Element
add_action('plugins_loaded', function(){
	require_once( plugin_dir_path(__FILE__) . '/vc-components/vc-component.php' );
});

/**
 * Register Textdomain
 */
function add_news_grid_textdomain() {
	load_child_theme_textdomain( 'news_grid', plugin_dir_path(__FILE__) . '/languages' );
}
add_action( 'after_setup_theme', 'add_news_grid_textdomain' );


if ( ! function_exists( 'short_content' ) ) {
	/**
	 * Show n words from variable
	 */
	function short_content( $content, $number_words ) {
		return apply_filters( 'the_content', wp_trim_words( preg_replace( '~\[[^\]]+\]~', '', strip_tags( $content ) ), $number_words ) );
	}

}
