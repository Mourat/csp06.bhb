<?php

class VcNewsGrid extends WPBakeryShortCode {

	function __construct() {
		add_action( 'init', array( $this, 'create_shortcode' ), 999 );
		add_shortcode( 'vc_news_grid', array( $this, 'render_shortcode' ) );
	}

	public function create_shortcode() {
		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) { return; }

		function my_cat() {
			$categories = get_categories( [
				'taxonomy'     => 'category',
				'type'         => 'post',
				'child_of'     => 0,
				'parent'       => '',
				'orderby'      => 'name',
				'order'        => 'ASC',
				'hide_empty'   => 1,
				'hierarchical' => 1,
				'exclude'      => '',
				'include'      => '',
				'number'       => 0,
				'pad_counts'   => false,
			] );
			$cat_array  = [];
			foreach ( $categories as $category ) :
				$cat_array[ $category->term_id ] = $category->name;
			endforeach;

			return $cat_array;
		}

		// Map blockquote with vc_map()
		vc_map( array(
			'name'        => __( 'News grid', 'news_grid' ),
			'base'        => 'vc_news_grid',
			'description' => __( '', 'news_grid' ),
			'category'    => __( 'BHB components', 'news_grid' ),
			'icon'        => plugin_dir_url( __FILE__ ) . '/icons/element-icon-news-grid.svg',
			'params'      => array(

				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Category', 'news_grid' ),
					'param_name' => 'category',
					'value'      => my_cat(),
				),

				array(
					"type"       => "vc_link",
					"class"      => "",
					"heading"    => __( "Button link", 'news_grid' ),
					"param_name" => "button_link",
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Extra class name', 'news_grid' ),
					'param_name'  => 'extra_class',
					'value'       => __( '', 'news_grid' ),
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'news_grid' ),
					'group'       => __( 'Extra', 'news_grid' ),
				),
			),
		) );

	}

	public function render_shortcode( $atts, $content, $tag ) {

		$atts = ( shortcode_atts( array(
			'category'    => '',
			'button_link' => '',
			'extra_class' => ''
		), $atts ) );

		$cf = function ( $fn ) {
			return $fn;
		};

		$posts = get_posts( array(
			'numberposts'      => 5,
			'category'         => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'include'          => array(),
			'exclude'          => array(),
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'post',
			'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
		) );

		$output = '';
		$output .= '<div class="news_grid">';
		foreach ( $posts as $post ) {
			$output .= '<div class="item" onclick="window.location.href=\'' . get_permalink( $post->ID ) . '\'">';
			if ( get_post_thumbnail_id( $post->ID ) ) {
				$output .= get_the_post_thumbnail( $post->ID, 'full', array( 'class' => 'featured' ) );
			} else {
				$output .= wp_get_attachment_image( get_field( 'default_image', 'theme_options' ), 'full', false, array( 'class' => 'featured' ) );
			}
			$output .= '<div class="content px-4 pt-4">';
			$output .= '<div class="title">' . $post->post_title . '</div>';
			$output .= '<div class="excerpt mt-3">' . short_content( $post->post_content, 10 ) . '</div>';
			$output .= '<div class="link mt-5"><a class="item-link" href="' . get_permalink( $post->ID ) . '">' . __( '> Read more', 'news_grid' ) . '</a></div>';
			$output .= '</div>';

			$output .= '</div>';
		}

//		echo '<pre>'.print_r($link_data['target']).'</pre>';
		$output .= '</div>';

		$link_data = vc_build_link( $atts['button_link'] );
		$output    .= '<div class="text-center my-4">';
		$output    .= '<a class="btn btn-yellow" role="button" href="' . $link_data['url'] . '" target="' . $link_data['target'] . '">' . $link_data['title'] . '</a>';
		$output    .= '</div>';

		return $output;

	}

}

new VcNewsGrid();
