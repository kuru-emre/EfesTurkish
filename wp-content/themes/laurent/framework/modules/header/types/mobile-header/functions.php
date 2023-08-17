<?php

if ( ! function_exists( 'laurent_elated_include_mobile_header_menu' ) ) {
	function laurent_elated_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'laurent' );
		
		return $menus;
	}
	
	add_filter( 'laurent_elated_filter_register_headers_menu', 'laurent_elated_include_mobile_header_menu' );
}

if ( ! function_exists( 'laurent_elated_register_mobile_header_areas' ) ) {
	/**
	 * Registers widget areas for mobile header
	 */
	function laurent_elated_register_mobile_header_areas() {
		if ( laurent_elated_is_responsive_on() && laurent_elated_is_plugin_installed( 'core' ) ) {
			register_sidebar(
				array(
					'id'            => 'eltdf-right-from-mobile-logo',
					'name'          => esc_html__( 'Mobile Header Widget Area', 'laurent' ),
					'description'   => esc_html__( 'Widgets added here will appear on the right hand side on mobile header', 'laurent' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s eltdf-right-from-mobile-logo">',
					'after_widget'  => '</div>'
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'laurent_elated_register_mobile_header_areas' );
}

if ( ! function_exists( 'laurent_elated_mobile_header_class' ) ) {
	function laurent_elated_mobile_header_class( $classes ) {
		$classes[] = 'eltdf-default-mobile-header eltdf-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'laurent_elated_mobile_header_class' );
}

if ( ! function_exists( 'laurent_elated_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 *
	 * @param string $slug
	 * @param string $module
	 */
	function laurent_elated_get_mobile_header( $slug = '', $module = '' ) {
		if ( laurent_elated_is_responsive_on() ) {
			$page_id           = laurent_elated_get_page_id();
			$mobile_in_grid    = laurent_elated_get_meta_field_intersect( 'mobile_header_in_grid', $page_id ) == 'yes' ? true : false;
			$mobile_menu_title = laurent_elated_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' );
			
			$parameters = array(
				'mobile_header_in_grid'  => $mobile_in_grid,
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title,
				'mobile_icon_class'		 => laurent_elated_get_mobile_navigation_icon_class()
			);

            $module = apply_filters('laurent_elated_filter_mobile_menu_module', 'header/types/mobile-header');
            $slug = apply_filters('laurent_elated_filter_mobile_menu_slug', '');
            $parameters = apply_filters('laurent_elated_filter_mobile_menu_parameters', $parameters);

            laurent_elated_get_module_template_part( 'templates/mobile-header', $module, $slug, $parameters );
		}
	}
	
	add_action( 'laurent_elated_action_after_wrapper_inner', 'laurent_elated_get_mobile_header', 20 );
}

if ( ! function_exists( 'laurent_elated_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function laurent_elated_get_mobile_logo() {
		$show_logo_image = laurent_elated_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$page_id       = laurent_elated_get_page_id();
			$header_height = laurent_elated_set_default_mobile_menu_height_for_header_types();
			
			$mobile_logo_image = laurent_elated_get_meta_field_intersect( 'logo_image_mobile', $page_id );
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : laurent_elated_get_meta_field_intersect( 'logo_image', $page_id );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = laurent_elated_get_image_dimensions( $logo_image );
			
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			} else if ( ! empty( $header_height ) && empty( $logo_dimensions ) ) {
				$logo_styles = 'height: ' . intval( $header_height / 2 ) . 'px;'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_styles'     => $logo_styles,
                'slug'			  => ''
			);

            $is_svg_logo = laurent_elated_get_meta_field_intersect('logo_source', $page_id) == 'svg' ? true : false;

            if( $is_svg_logo ) {
                $parameters['slug'] = 'svg';
                $parameters['logo_svg_path'] = laurent_elated_get_meta_field_intersect('logo_svg', $page_id);
            }
			
			laurent_elated_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'laurent_elated_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function laurent_elated_get_mobile_nav() {
		laurent_elated_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}

if ( ! function_exists( 'laurent_elated_mobile_header_per_page_js_var' ) ) {
    function laurent_elated_mobile_header_per_page_js_var( $perPageVars ) {
        $perPageVars['eltdfMobileHeaderHeight'] = laurent_elated_set_default_mobile_menu_height_for_header_types();

        return $perPageVars;
    }

    add_filter( 'laurent_elated_filter_per_page_js_vars', 'laurent_elated_mobile_header_per_page_js_var' );
}

if ( ! function_exists( 'laurent_elated_get_mobile_navigation_icon_class' ) ) {
	/**
	 * Loads mobile navigation icon class
	 */
	function laurent_elated_get_mobile_navigation_icon_class() {
		$classes = array(
			'eltdf-mobile-menu-opener'
		);
		
		$classes[] = laurent_elated_get_icon_sources_class( 'mobile', 'eltdf-mobile-menu-opener' );

		return $classes;
	}
}


if ( ! function_exists( 'laurent_elated_mobile_header_style' ) ) {
	function laurent_elated_mobile_header_style($style) {

		$current_style = '';
		$page_id       = laurent_elated_get_page_id();
		$class_prefix  = laurent_elated_get_unique_page_class( $page_id );

		$mobile_side_padding    = laurent_elated_get_meta_field_intersect( 'mobile_header_without_grid_padding', $page_id );
		$sticky_container_styles = array();
		$sticky_container_classes = array(
			$class_prefix . ' .eltdf-mobile-header *:not(.eltdf-grid) > .eltdf-vertical-align-containers'
		);

		if ( $mobile_side_padding !== '' ) {
			$sticky_container_styles['padding-left']  = laurent_elated_filter_px( $mobile_side_padding ) . 'px';
			$sticky_container_styles['padding-right'] = laurent_elated_filter_px( $mobile_side_padding ) . 'px';

			$current_style .= laurent_elated_dynamic_css( $sticky_container_classes, $sticky_container_styles );
		}

		$current_style = $current_style . $style;

		return $current_style;
	}

	add_filter( 'laurent_elated_filter_add_page_custom_style', 'laurent_elated_mobile_header_style' );
}