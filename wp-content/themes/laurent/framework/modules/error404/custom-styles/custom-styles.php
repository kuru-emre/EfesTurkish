<?php

if ( ! function_exists( 'laurent_elated_404_header_general_styles' ) ) {
	/**
	 * Generates general custom styles for 404 header area
	 */
	function laurent_elated_404_header_general_styles() {
		$background_color        = laurent_elated_options()->getOptionValue( '404_menu_area_background_color_header' );
		$background_transparency = laurent_elated_options()->getOptionValue( '404_menu_area_background_transparency_header' );
		
		$header_styles = array();
		$menu_selector = array(
			'.error404 .eltdf-page-header .eltdf-menu-area'
		);
		
		if ( ! empty( $background_color ) ) {
			$header_styles['background-color']        = $background_color;
			$header_styles['background-transparency'] = 1;
			
			if ( $background_transparency !== '' ) {
				$header_styles['background-transparency'] = $background_transparency;
			}
			
			echo laurent_elated_dynamic_css( $menu_selector, array( 'background-color' => laurent_elated_rgba_color( $header_styles['background-color'], $header_styles['background-transparency'] ) . ' !important' ) );
		}
		
		if ( empty( $background_color ) && $background_transparency !== '' ) {
			$header_styles['background-color']        = '#fff';
			$header_styles['background-transparency'] = $background_transparency;
			
			echo laurent_elated_dynamic_css( $menu_selector, array( 'background-color' => laurent_elated_rgba_color( $header_styles['background-color'], $header_styles['background-transparency'] ) . ' !important' ) );
		}
		
		$border_color = laurent_elated_options()->getOptionValue( '404_menu_area_border_color_header' );
		
		$menu_styles = array();
		
		if ( ! empty( $border_color ) ) {
			$menu_styles['border-color'] = $border_color;
		}
		
		echo laurent_elated_dynamic_css( $menu_selector, $menu_styles );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_404_header_general_styles' );
}

if ( ! function_exists( 'laurent_elated_404_page_general_styles' ) ) {
	/**
	 * Generates general custom styles for 404 page
	 */
	function laurent_elated_404_page_general_styles() {
		$background_color         = laurent_elated_options()->getOptionValue( '404_page_background_color' );
		$background_image         = laurent_elated_options()->getOptionValue( '404_page_background_image' );
		$pattern_background_image = laurent_elated_options()->getOptionValue( '404_page_background_pattern_image' );
		
		$item_styles = array();
		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}
		
		if ( ! empty( $background_image ) ) {
			$item_styles['background-image']    = 'url(' . $background_image . ')';
			$item_styles['background-position'] = 'center 0';
			$item_styles['background-size']     = 'cover';
			$item_styles['background-repeat']   = 'no-repeat';
		}
		
		if ( ! empty( $pattern_background_image ) ) {
			$item_styles['background-image']    = 'url(' . $pattern_background_image . ')';
			$item_styles['background-position'] = '0 0';
			$item_styles['background-repeat']   = 'repeat';
		}
		
		$item_selector = array(
			'.error404 .eltdf-content'
		);
		
		echo laurent_elated_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_404_page_general_styles' );
}

if ( ! function_exists( 'laurent_elated_404_title_styles' ) ) {
	/**
	 * Generates styles for 404 page title
	 */
	function laurent_elated_404_title_styles() {
		$item_styles = laurent_elated_get_typography_styles( '404_title' );
		
		$item_selector = array(
			'.error404 .eltdf-page-not-found .eltdf-404-title'
		);
		
		echo laurent_elated_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_404_title_styles' );
}

if ( ! function_exists( 'laurent_elated_404_title_styles_responsive' ) ) {
    function laurent_elated_404_title_styles_responsive() {
        $selector = array(
            '.error404 .eltdf-page-not-found .eltdf-404-title'
        );

        $styles = laurent_elated_get_responsive_typography_styles( '404_title_responsive' );

        if ( ! empty( $styles ) ) {
            echo laurent_elated_dynamic_css( $selector, $styles );
        }
    }

    add_action( 'laurent_elated_action_style_dynamic_responsive_680', 'laurent_elated_404_title_styles_responsive' );
}

if ( ! function_exists( 'laurent_elated_404_subtitle_styles' ) ) {
	/**
	 * Generates styles for 404 page subtitle
	 */
	function laurent_elated_404_subtitle_styles() {
		$item_styles = laurent_elated_get_typography_styles( '404_subtitle' );
		
		$item_selector = array(
			'.error404 .eltdf-page-not-found .eltdf-404-subtitle'
		);
		
		echo laurent_elated_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_404_subtitle_styles' );
}

if ( ! function_exists( 'laurent_elated_404_subtitle_styles_responsive' ) ) {
    function laurent_elated_404_subtitle_styles_responsive() {
        $selector = array(
            '.error404 .eltdf-page-not-found .eltdf-404-subtitle'
        );

        $styles = laurent_elated_get_responsive_typography_styles( '404_subtitle_responsive' );

        if ( ! empty( $styles ) ) {
            echo laurent_elated_dynamic_css( $selector, $styles );
        }
    }

    add_action( 'laurent_elated_action_style_dynamic_responsive_680', 'laurent_elated_404_subtitle_styles_responsive' );
}

if ( ! function_exists( 'laurent_elated_404_text_styles' ) ) {
	/**
	 * Generates styles for 404 page text
	 */
	function laurent_elated_404_text_styles() {
		$item_styles = laurent_elated_get_typography_styles( '404_text' );
		
		$item_selector = array(
			'.error404 .eltdf-page-not-found .eltdf-404-text'
		);
		
		echo laurent_elated_dynamic_css( $item_selector, $item_styles );
	}
	
	add_action( 'laurent_elated_action_style_dynamic', 'laurent_elated_404_text_styles' );
}

if ( ! function_exists( 'laurent_elated_404_text_styles_responsive' ) ) {
    function laurent_elated_404_text_styles_responsive() {
        $selector = array(
            '.error404 .eltdf-page-not-found .eltdf-404-text'
        );

        $styles = laurent_elated_get_responsive_typography_styles( '404_text_responsive' );

        if ( ! empty( $styles ) ) {
            echo laurent_elated_dynamic_css( $selector, $styles );
        }
    }

    add_action( 'laurent_elated_action_style_dynamic_responsive_680', 'laurent_elated_404_text_styles_responsive' );
}