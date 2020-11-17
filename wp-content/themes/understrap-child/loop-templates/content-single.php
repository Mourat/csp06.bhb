<?php
/**
 * Single post partial template
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

    <header class="entry-header">



        <div class="entry-meta">

	        <span class="date"><?= get_the_date( get_option('date_format'), $post->ID ) ?></span>

        </div><!-- .entry-meta -->

	    <div class="row justify-content-md-center">
            <div class="col-md-7">
	            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
            </div>
        </div>

    </header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>

    <div class="entry-content">

		<?php the_content(); ?>

		<?php
		wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			)
		);
		?>

    </div><!-- .entry-content -->

</article><!-- #post-## -->
