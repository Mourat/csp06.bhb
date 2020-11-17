<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">

	<div class="container-fluid container-footer">

		<div class="row">

			<div class="col-lg-2 col-md-6 col-sm-12 widget">
                <?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('foobar-1'); ?>
            </div><!--col end -->
			<div class="col-lg-3 col-md-6 col-sm-12 widget">
				<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('foobar-2'); ?>
            </div><!--col end -->
			<div class="col-lg-4 col-md-6 col-sm-12 widget">
				<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('foobar-3'); ?>
            </div><!--col end -->
			<div class="col-lg-3 col-md-6 col-sm-12 widget">
				<?php if ( function_exists('dynamic_sidebar') ) dynamic_sidebar('foobar-4'); ?>
            </div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

