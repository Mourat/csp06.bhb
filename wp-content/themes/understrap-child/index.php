<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header(); ?>

<div class="container">
	<div class="row">
		<?= get_field( 'blog_content', get_option( 'page_for_posts' ) ) ?>
    </div>
</div>

<div class="container-fluid">
<?php
if ( have_posts() ) {
    echo '<div class="posts-grid">';
    // Start the Loop.
    while ( have_posts() ) {
        the_post();

        /*
         * Include the Post-Format-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
         */
        get_template_part( 'loop-templates/content', get_post_format() );
    }
    echo '</div>';
} else {
    get_template_part( 'loop-templates/content', 'none' );
}
?>
</div>

<div class="container">
    <div class="row justify-content-center">
        <!-- The pagination component -->
	    <?php understrap_pagination(); ?>
    </div>
</div>

<?php
get_footer();
