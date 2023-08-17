<?php
namespace LaurentElatedNamespace\Modules\Header\Types;

use LaurentElatedNamespace\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Bottom layout and option
 *
 * Class HeaderBottom
 */
class HeaderBottom extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $mobileHeaderHeight;
    protected $menuAreaHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-bottom';
		
		if ( ! is_admin() ) {
			$this->menuAreaHeight     = laurent_elated_set_default_menu_height_for_header_types();
			$this->mobileHeaderHeight = laurent_elated_set_default_mobile_menu_height_for_header_types();
			
			add_action( 'wp', array( $this, 'setHeaderHeightProps' ) );
			
			add_filter( 'laurent_elated_filter_js_global_variables', array( $this, 'getGlobalJSVariables' ) );
			add_filter( 'laurent_elated_filter_per_page_js_vars', array( $this, 'getPerPageJSVariables' ) );
		}
	}
	
	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
    public function loadTemplate( $parameters = array() ) {
        $page_id                                = laurent_elated_get_page_id();
        $menu_area_position                     = laurent_elated_get_meta_field_intersect( 'set_menu_area_position', $page_id );
        $parameters['menu_area_position']       = ! empty( $menu_area_position ) ? $menu_area_position : 'right';
        $parameters['menu_area_position_class'] = ! empty( $menu_area_position ) ? 'eltdf-menu-' . $menu_area_position : 'eltdf-menu-left';

        $parameters = apply_filters( 'laurent_elated_filter_header_bottom_parameters', $parameters );

        laurent_elated_get_module_template_part( 'templates/' . $this->slug, $this->moduleName . '/types/' . $this->slug, '', $parameters );
    }
	
	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
		$this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
	}
	
	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$transparencyHeight = 0;
		
		return $transparencyHeight;
	}
	
	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {
		$transparencyHeight = 0;
		
		return $transparencyHeight;
	}
	
	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->menuAreaHeight;
		
		return $headerHeight;
	}
	
	/**
	 * Returns total height of mobile header
	 *
	 * @return int|string
	 */
	public function calculateMobileHeaderHeight() {
		$mobileHeaderHeight = $this->mobileHeaderHeight;
		
		return $mobileHeaderHeight;
	}
	
	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables( $globalVariables ) {
		$globalVariables['eltdfLogoAreaHeight']     = 0;
		$globalVariables['eltdfMenuAreaHeight']     = $this->headerHeight;
		$globalVariables['eltdfMobileHeaderHeight'] = $this->mobileHeaderHeight;
		
		return $globalVariables;
	}
	
	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables( $perPageVars ) {

        $perPageVars['eltdfHeaderTransparencyHeight'] = $this->headerHeight - ( laurent_elated_get_top_bar_height() + $this->heightOfCompleteTransparency );
        $perPageVars['eltdfHeaderVerticalWidth'] = 0;
		
		return $perPageVars;
	}
}