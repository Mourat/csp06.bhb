<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class( 'item' ); ?> id="post-<?php the_ID(); ?>">
    <div class="content">
		<?php
		if ( get_post_thumbnail_id( $post->ID ) ) {
			echo get_the_post_thumbnail( $post->ID, 'large' );
		} else {
			echo wp_get_attachment_image( get_field( 'blog_default_image', 'theme_options' ), 'large' );
		}
		?>

        <header class="entry-header">
            <div class="entry-meta">
				<?= '<span class="date">' . get_the_date( get_option( 'date_format' ), get_the_ID() ) . '</span>' ?>
            </div><!-- .entry-meta -->
            <div class="row">
                <div class="col-md-8">
					<?php the_title(
						sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
						'</a></h2>'
					); ?>
                </div>
            </div>
        </header><!-- .entry-header -->


        <div class="entry-content">
			<?= short_content($post->post_content, rand( 5, 45 )) ?>

			<?php
			wp_link_pages(
				array(
					'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
					'after'  => '</div>',
				)
			);
			?>

        </div><!-- .entry-content -->

        <footer class="entry-footer">

            <a class="item-link"
               href="<?= get_permalink( $post->ID ) ?>"><?= __( 'Read more', 'understrap-child' ) ?></a>

        </footer><!-- .entry-footer -->

    </div>

</article><!-- #post-## -->
