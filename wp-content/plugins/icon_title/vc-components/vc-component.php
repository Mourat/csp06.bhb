<?php

class VcIconTitle extends WPBakeryShortCode {

	function __construct() {
		add_action( 'init', array( $this, 'create_shortcode' ), 999 );
		add_shortcode( 'vc_icon_title', array( $this, 'render_shortcode' ) );
	}

	public function create_shortcode() {
		// Stop all if VC is not enabled
		if ( ! defined( 'WPB_VC_VERSION' ) ) {
			return;
		}

		// Map blockquote with vc_map()
		vc_map( array(
			'name'        => __( 'Title with icon', 'icon_title' ),
			'base'        => 'vc_icon_title',
			'description' => __( '', 'icon_title' ),
			'category'    => __( 'BHB components', 'icon_title' ),
			'icon'        => 'icon-wpb-ui-custom_heading',
			'params'      => array(
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Heading type', 'icon_title' ),
					'param_name' => 'heading_type',
					'value'      => array(
						'H1' => 'h1',
						'H2' => 'h2',
						'H3' => 'h3',
						'H4' => 'h4',
						'H5' => 'h5',
						'H6' => 'h6',
					),
				),

				array(
					'type'       => 'textfield',
					'heading'    => __( 'Title', 'icon_title' ),
					'param_name' => 'title',
					'value'      => __( '', 'icon_title' ),
				),

				array(
					'type'       => 'attach_image',
					'heading'    => __( 'Icon', 'icon_title' ),
					'param_name' => 'icon',
					'value'      => __( '', 'icon_title' ),
				),

				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Horizontal align', 'icon_title' ),
					'param_name' => 'align',
					'value'      => array(
						__( 'Center', 'icon_title' ) => 'center',
						__( 'Left', 'icon_title' )   => 'left',
						__( 'Right', 'icon_title' )  => 'right'
					),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Space', 'icon_title' ),
					'param_name'  => 'space',
					'value'       => __( '', 'icon_title' ),
					'description' => __( 'Space between icon and title (without px), usually 10px', 'icon_title' ),
				),

				array(
					'type'        => 'textfield',
					'heading'     => __( 'Extra class name', 'icon_title' ),
					'param_name'  => 'extra_class',
					'value'       => __( '', 'icon_title' ),
					'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'icon_title' ),
					'group'       => __( 'Extra', 'icon_title' ),
				),
			),
		) );
	}

	public function render_shortcode( $atts, $content, $tag ) {
		$atts   = ( shortcode_atts( array(
			'heading_type' => '',
			'title'        => '',
			'icon'         => '',
			'align'        => '',
			'space'        => '',
			'extra_class'  => '',
		), $atts ) );
		$output = '';
		$output .= '<div class="icon-title ' . $atts['align'] . ' ' . $atts['extra_class'] . '">';
		$output .= '<div class="wrap">';
		$output .= wp_get_attachment_image( $atts['icon'], 'full', false, array( 'class' => 'icon' ) );
		$output .= '<div class="space" style="height: ' . $atts['space'] . 'px"></div>';
		$output .= '<' . $atts['heading_type'] . '>' . $atts['title'] . '</' . $atts['heading_type'] . '>';
		$output .= '</div>';
		$output .= '</div>';

		return $output;
	}
}

new VcIconTitle();
