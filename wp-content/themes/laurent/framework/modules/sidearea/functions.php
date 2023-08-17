<?php

if ( ! function_exists( 'laurent_elated_register_side_area_sidebar' ) ) {
	/**
	 * Register side area sidebar
	 */
	function laurent_elated_register_side_area_sidebar() {
		register_sidebar(
			array(
				'id'            => 'sidearea',
				'name'          => esc_html__( 'Side Area', 'laurent' ),
				'description'   => esc_html__( 'Side Area', 'laurent' ),
				'before_widget' => '<div id="%1$s" class="widget eltdf-sidearea %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<div class="eltdf-widget-title-holder"><h5 class="eltdf-widget-title">',
				'after_title'   => '</h5></div>'
			)
		);
	}
	
	add_action( 'widgets_init', 'laurent_elated_register_side_area_sidebar' );
}

if ( ! function_exists( 'laurent_elated_side_menu_body_class' ) ) {
	/**
	 * Function that adds body classes for different side menu styles
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function laurent_elated_side_menu_body_class( $classes ) {
		
		if ( is_active_widget( false, false, 'eltdf_side_area_opener' ) ) {
			
			if ( laurent_elated_options()->getOptionValue( 'side_area_type' ) ) {
				$classes[] = 'eltdf-' . laurent_elated_options()->getOptionValue( 'side_area_type' );
			}
		}
		
		return $classes;
	}
	
	add_filter( 'body_class', 'laurent_elated_side_menu_body_class' );
}

if ( ! function_exists( 'laurent_elated_get_side_area' ) ) {
	/**
	 * Loads side area HTML
	 */
	function laurent_elated_get_side_area() {
		
		if ( is_active_widget( false, false, 'eltdf_side_area_opener' ) ) {
			$parameters = array(
				'close_icon_classes' => laurent_elated_get_side_area_close_icon_class()
			);
			
			laurent_elated_get_module_template_part( 'templates/sidearea', 'sidearea', '', $parameters );
		}
	}
	
	add_action( 'laurent_elated_action_before_closing_body_tag', 'laurent_elated_get_side_area', 10 );
}

if ( ! function_exists( 'laurent_elated_get_side_area_close_class' ) ) {
	/**
	 * Loads side area close icon class
	 */
	function laurent_elated_get_side_area_close_icon_class() {
		$classes = array(
			'eltdf-close-side-menu'
		);
		
		$classes[] = laurent_elated_get_icon_sources_class( 'side_area', 'eltdf-close-side-menu' );
		
		return $classes;
	}
}