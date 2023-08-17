<?php

require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.customizer.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.layout1.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.layout2.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.layout3.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.layout.tax.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.layout.user.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.layout.dashboard.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.optionsapi.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.framework.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/eltdf.functions.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/lib/icons-pack/icons-pack.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/admin/options/eltdf-options-setup.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/admin/meta-boxes/eltdf-meta-boxes-setup.php";
require_once LAURENT_ELATED_FRAMEWORK_ROOT_DIR . "/modules/eltdf-modules-loader.php";

if ( ! function_exists( 'laurent_elated_admin_scripts_init' ) ) {
	/**
	 * Function that registers all scripts that are necessary for our back-end
	 */
	function laurent_elated_admin_scripts_init() {
		
		//This part is required for field type address
		$enable_google_map_in_admin = apply_filters( 'laurent_elated_filter_google_maps_in_backend', false );
		if ( $enable_google_map_in_admin ) {
			//include google map api script
			$google_maps_api_key          = laurent_elated_options()->getOptionValue( 'google_maps_api_key' );
			$google_maps_extensions       = '';
			$google_maps_extensions_array = apply_filters( 'laurent_elated_filter_google_maps_extensions_array', array() );
			if ( ! empty( $google_maps_extensions_array ) ) {
				$google_maps_extensions .= '&libraries=';
				$google_maps_extensions .= implode( ',', $google_maps_extensions_array );
			}
			if ( ! empty( $google_maps_api_key ) ) {
				wp_enqueue_script( 'laurent-elated-google-map-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( $google_maps_api_key ) . $google_maps_extensions, array(), false, true );
				if ( ! empty( $google_maps_extensions_array ) && is_array( $google_maps_extensions_array ) ) {
					wp_enqueue_script( 'geocomplete', get_template_directory_uri() . '/framework/admin/assets/js/`jquery.geocomplete.min.js', array( 'jquery', 'laurent-elated-google-map-api' ), false, true );
				}
			}
		}

		wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/framework/admin/assets/js/bootstrap.min.js', array(), false, true );
		wp_enqueue_script( 'bootstrap-select', get_template_directory_uri() . '/framework/admin/assets/js/bootstrap-select.min.js', array(), false, true );
		wp_enqueue_script( 'select2', get_template_directory_uri() . '/framework/admin/assets/js/select2.min.js', array(), false, true );
		wp_enqueue_script( 'laurent-elated-ui-admin', get_template_directory_uri() . '/framework/admin/assets/js/eltdf-ui/eltdf-ui.js', array(), false, true );


		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/framework/admin/assets/css/font-awesome/css/font-awesome.min.css' );
		wp_enqueue_style( 'select2', get_template_directory_uri() . '/framework/admin/assets/css/select2.min.css' );

		/**
		 * @see LaurentElatedClassSkinAbstract::registerScripts - hooked with 10
		 * @see LaurentElatedClassSkinAbstract::registerStyles - hooked with 10
		 */
		do_action( 'laurent_elated_action_admin_scripts_init' );
	}

	add_action( 'admin_init', 'laurent_elated_admin_scripts_init' );
}

if ( ! function_exists( 'laurent_elated_enqueue_admin_styles' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function laurent_elated_enqueue_admin_styles() {
		wp_enqueue_style( 'wp-color-picker' );

		/**
		 * @see LaurentElatedClassSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'laurent_elated_action_enqueue_admin_styles' );
	}
}

if ( ! function_exists( 'laurent_elated_enqueue_admin_scripts' ) ) {
	/**
	 * Function that enqueues styles for options page
	 */
	function laurent_elated_enqueue_admin_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
		wp_enqueue_script( 'laurent-elated-admin-dependence', get_template_directory_uri() . '/framework/admin/assets/js/eltdf-ui/eltdf-dependence.js', array(), false, true );
		wp_enqueue_script( 'laurent-elated-admin-twitter-connect', get_template_directory_uri() . '/framework/admin/assets/js/eltdf-ui/eltdf-twitter-connect.js', array(), false, true );

		/**
		 * @see LaurentElatedClassSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'laurent_elated_action_enqueue_admin_scripts' );
	}
}

if ( ! function_exists( 'laurent_elated_enqueue_meta_box_styles' ) ) {
	/**
	 * Function that enqueues styles for meta boxes
	 */
	function laurent_elated_enqueue_meta_box_styles() {
		wp_enqueue_style( 'wp-color-picker' );

		/**
		 * @see LaurentElatedClassSkinAbstract::enqueueStyles - hooked with 10
		 */
		do_action( 'laurent_elated_action_enqueue_meta_box_styles' );
	}
}

if ( ! function_exists( 'laurent_elated_enqueue_meta_box_scripts' ) ) {
	/**
	 * Function that enqueues scripts for meta boxes
	 */
	function laurent_elated_enqueue_meta_box_scripts() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( 'jquery-ui-accordion' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
        wp_enqueue_script( 'laurent-elated-admin-dependence', get_template_directory_uri() . '/framework/admin/assets/js/eltdf-ui/eltdf-dependence.js', array(), false, true );
        wp_enqueue_script( 'laurent-elated-admin-repeater', get_template_directory_uri() . '/framework/admin/assets/js/eltdf-ui/eltdf-ui-repeater.js', array(), false, true );

		/**
		 * @see LaurentElatedClassSkinAbstract::enqueueScripts - hooked with 10
		 */
		do_action( 'laurent_elated_action_enqueue_meta_box_scripts' );
	}
}

if ( ! function_exists( 'laurent_elated_enqueue_nav_menu_script' ) ) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 *
	 * @param $hook string current page hook to check
	 */
	function laurent_elated_enqueue_nav_menu_script( $hook ) {
		if ( $hook == 'nav-menus.php' ) {
			wp_enqueue_script( 'laurent-elated-admin-nav-menu', get_template_directory_uri() . '/framework/admin/assets/js/eltdf-ui/eltdf-nav-menu.js' );
			wp_enqueue_style( 'laurent-elated-admin-nav-menu', get_template_directory_uri() . '/framework/admin/assets/css/eltdf-nav-menu.css' );
		}
	}

	add_action( 'admin_enqueue_scripts', 'laurent_elated_enqueue_nav_menu_script' );
}

if ( ! function_exists( 'laurent_elated_enqueue_widgets_admin_script' ) ) {
	/**
	 * Function that enqueues styles and scripts for admin widgets page.
	 *
	 * @param $hook string current page hook to check
	 */
	function laurent_elated_enqueue_widgets_admin_script( $hook ) {
		if ( $hook == 'widgets.php' ) {
			wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_script( 'laurent-elated-admin-dependence', get_template_directory_uri() . '/framework/admin/assets/js/eltdf-ui/eltdf-dependence.js', array(), false, true );
			wp_enqueue_script( 'laurent-elated-admin-widgets-dependence', get_template_directory_uri() . '/framework/admin/assets/js/eltdf-ui/eltdf-widget-dependence.js', array(), false, true );
		}
	}

	add_action( 'admin_enqueue_scripts', 'laurent_elated_enqueue_widgets_admin_script' );
}

if ( ! function_exists( 'laurent_elated_enqueue_taxonomy_script' ) ) {
	/**
	 * Function that enqueues styles and scripts necessary for menu administration page.
	 * It checks $hook variable
	 *
	 * @param $hook string current page hook to check
	 */
	function laurent_elated_enqueue_taxonomy_script( $hook ) {
		if ( $hook == 'edit-tags.php' || $hook == 'term.php' ) {
			wp_enqueue_script( 'select2' );
			wp_enqueue_style( 'select2', get_template_directory_uri() . '/framework/admin/assets/css/select2.min.css' );
			wp_enqueue_style( 'laurent-elated-admin-taxonomy', get_template_directory_uri() . '/framework/admin/assets/css/eltdf-taxonomy.css' );
		}
	}

	add_action( 'admin_enqueue_scripts', 'laurent_elated_enqueue_taxonomy_script' );
}


if ( ! function_exists( 'laurent_elated_dashboard_page' ) ) {
	/**
	 * Function that checks whether Dashboard assets needs to be loaded.
	 *
	 */
	function laurent_elated_dashboard_page() {
		return is_page_template('user-dashboard.php');
	}
}

if ( ! function_exists( 'laurent_elated_init_theme_options_array' ) ) {
	/**
	 * Function that merges $laurent_elated_global_options and default options array into one array.
	 *
	 * @see array_merge()
	 */
	function laurent_elated_init_theme_options_array() {
		global $laurent_elated_global_options, $laurent_elated_global_Framework;

		$db_options = get_option( 'eltdf_options_laurent' );

		//does eltdf_options_laurent exists in db?
		if ( is_array( $db_options ) ) {
			//merge with default options
			$laurent_elated_global_options = array_merge( $laurent_elated_global_Framework->eltdOptions->options, get_option( 'eltdf_options_laurent' ) );
		} else {
			//options don't exists in db, take default ones
			$laurent_elated_global_options = $laurent_elated_global_Framework->eltdOptions->options;
		}
	}

	add_action( 'laurent_elated_action_after_options_map', 'laurent_elated_init_theme_options_array', 0 );
}

if ( ! function_exists( 'laurent_elated_init_theme_options' ) ) {
	/**
	 * Function that sets $laurent_elated_global_options variable if it does'nt exists
	 */
	function laurent_elated_init_theme_options() {
		global $laurent_elated_global_options;
		global $laurent_elated_global_Framework;
		if ( isset( $laurent_elated_global_options['reset_to_defaults'] ) ) {
			if ( $laurent_elated_global_options['reset_to_defaults'] == 'yes' ) {
				delete_option( "eltdf_options_laurent" );
			}
		}

		if ( ! get_option( "eltdf_options_laurent" ) ) {
			add_option( "eltdf_options_laurent", $laurent_elated_global_Framework->eltdOptions->options );

			$laurent_elated_global_options = $laurent_elated_global_Framework->eltdOptions->options;
		}
	}
}

if ( ! function_exists( 'laurent_elated_register_theme_settings' ) ) {
	/**
	 * Function that registers setting that will be used to store theme options
	 */
	function laurent_elated_register_theme_settings() {
		register_setting( LAURENT_ELATED_OPTIONS_SLUG, 'eltdf_options' );
	}

	add_action( 'admin_init', 'laurent_elated_register_theme_settings' );
}

if ( ! function_exists( 'laurent_elated_get_admin_tab' ) ) {
	/**
	 * Helper function that returns current tab from url.
	 * @return null
	 */
	function laurent_elated_get_admin_tab() {
		return isset( $_GET['page'] ) ? laurent_elated_strafter( $_GET['page'], 'tab' ) : null;
	}
}

if ( ! function_exists( 'laurent_elated_strafter' ) ) {
	/**
	 * Function that returns string that comes after found string
	 *
	 * @param $string string where to search
	 * @param $substring string what to search for
	 *
	 * @return null|string string that comes after found string
	 */
	function laurent_elated_strafter( $string, $substring ) {
		$pos = strpos( $string, $substring );
		if ( $pos === false ) {
			return null;
		}

		return ( substr( $string, $pos + strlen( $substring ) ) );
	}
}

if ( ! function_exists( 'laurent_elated_save_options' ) ) {
	/**
	 * Function that saves theme options to db.
	 */
	function laurent_elated_save_options() {
		global $laurent_elated_global_options;

		if ( current_user_can( 'administrator' ) ) {
			$_REQUEST = stripslashes_deep( $_REQUEST );

			unset( $_REQUEST['action'] );

			check_ajax_referer( 'eltdf_ajax_save_nonce', 'eltdf_ajax_save_nonce' );

			$laurent_elated_global_options = array_merge( $laurent_elated_global_options, $_REQUEST );

			update_option( 'eltdf_options_laurent', $laurent_elated_global_options );

			do_action( 'laurent_elated_action_after_theme_option_save' );
			echo esc_html__( 'Saved', 'laurent' );

			die();
		}
	}

	add_action( 'wp_ajax_laurent_elated_save_options', 'laurent_elated_save_options' );
}

if ( ! function_exists( 'laurent_elated_meta_box_add' ) ) {
	/**
	 * Function that adds all defined meta boxes.
	 * It loops through array of created meta boxes and adds them
	 */
	function laurent_elated_meta_box_add() {
		global $laurent_elated_global_Framework;

		foreach ( $laurent_elated_global_Framework->eltdMetaBoxes->metaBoxes as $key => $box ) {
			$hidden = false;
			if ( ! empty( $box->hidden_property ) ) {
				foreach ( $box->hidden_values as $value ) {
					if ( laurent_elated_option_get_value( $box->hidden_property ) == $value ) {
						$hidden = true;
					}
				}
			}

			if ( is_string( $box->scope ) ) {
				$box->scope = array( $box->scope );
			}

			if ( is_array( $box->scope ) && count( $box->scope ) ) {
				foreach ( $box->scope as $screen ) {
                    laurent_elated_create_meta_box_handler( $box, $key, $screen );

					if ( $hidden ) {
						add_filter( 'postbox_classes_' . $screen . '_eltdf-meta-box-' . $key, 'laurent_elated_meta_box_add_hidden_class' );
					}
				}
			}
		}
		
		if ( laurent_elated_is_plugin_installed( 'gutenberg-editor' ) || laurent_elated_is_plugin_installed( 'gutenberg-plugin' ) ) {
			laurent_elated_enqueue_meta_box_styles();
			laurent_elated_enqueue_meta_box_scripts();
		} else {
			add_action( 'admin_enqueue_scripts', 'laurent_elated_enqueue_meta_box_styles' );
			add_action( 'admin_enqueue_scripts', 'laurent_elated_enqueue_meta_box_scripts' );
		}
	}
}

if ( ! function_exists( 'laurent_elated_meta_box_save' ) ) {
	/**
	 * Function that saves meta box to postmeta table
	 *
	 * @param $post_id int id of post that meta box is being saved
	 * @param $post WP_Post current post object
	 */
	function laurent_elated_meta_box_save( $post_id, $post ) {
		global $laurent_elated_global_Framework;

		$nonces_array = array();
		$meta_boxes   = laurent_elated_framework()->eltdMetaBoxes->getMetaBoxesByScope( $post->post_type );

		if ( is_array( $meta_boxes ) && count( $meta_boxes ) ) {
			foreach ( $meta_boxes as $meta_box ) {
				$nonces_array[] = 'laurent_elated_meta_box_' . $meta_box->name . '_save';
			}
		}

		if ( is_array( $nonces_array ) && count( $nonces_array ) ) {
			foreach ( $nonces_array as $nonce ) {
				if ( ! isset( $_POST[ $nonce ] ) || ! wp_verify_nonce( $_POST[ $nonce ], $nonce ) ) {
					return;
				}
			}
		}

		$postTypes = apply_filters( 'laurent_elated_filter_meta_box_post_types_save', array( 'post', 'page' ) );

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( ! isset( $_POST['_wpnonce'] ) ) {
			return;
		}

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		if ( ! in_array( $post->post_type, $postTypes ) ) {
			return;
		}

		foreach ( $laurent_elated_global_Framework->eltdMetaBoxes->options as $key => $box ) {

			if ( isset( $_POST[ $key ] ) && trim( $_POST[ $key ] !== '' ) ) {

				$value = $_POST[ $key ];

				update_post_meta( $post_id, $key, $value );
			} else {
				delete_post_meta( $post_id, $key );
			}
		}
	}

	add_action( 'save_post', 'laurent_elated_meta_box_save', 1, 2 );
}

if ( ! function_exists( 'laurent_elated_render_meta_box' ) ) {
	/**
	 * Function that renders meta box
	 *
	 * @param $post WP_Post post object
	 * @param $metabox array array of current meta box parameters
	 */
	function laurent_elated_render_meta_box( $post, $metabox ) { ?>
		<div class="eltdf-meta-box eltdf-page">
			<div class="eltdf-meta-box-holder">
				<?php $metabox['args']['box']->render(); ?>
				<?php wp_nonce_field( 'laurent_elated_meta_box_' . $metabox['args']['box']->name . '_save', 'laurent_elated_meta_box_' . $metabox['args']['box']->name . '_save' ); ?>
			</div>
		</div>
		<?php
	}
}

if ( ! function_exists( 'laurent_elated_meta_box_add_hidden_class' ) ) {
	/**
	 * Function that adds class that will initially hide meta box
	 *
	 * @param array $classes array of classes
	 *
	 * @return array modified array of classes
	 */
	function laurent_elated_meta_box_add_hidden_class( $classes = array() ) {
		if ( ! in_array( 'eltdf-meta-box-hidden', $classes ) ) {
			$classes[] = 'eltdf-meta-box-hidden';
		}

		return $classes;
	}
}

if ( ! function_exists( 'laurent_elated_remove_default_custom_fields' ) ) {
	/**
	 * Function that removes default WordPress custom fields interface
	 */
	function laurent_elated_remove_default_custom_fields() {
		foreach ( array( 'normal', 'advanced', 'side' ) as $context ) {
			foreach ( apply_filters( 'laurent_elated_filter_meta_box_post_types_remove', array( 'post', 'page' ) ) as $postType ) {
				remove_meta_box( 'postcustom', $postType, $context );
			}
		}
	}

	add_action( 'do_meta_boxes', 'laurent_elated_remove_default_custom_fields' );
}

if ( ! function_exists( 'laurent_elated_generate_icon_pack_options' ) ) {
	/**
	 * Generates options HTML for each icon in given icon pack
	 */
	function laurent_elated_generate_icon_pack_options() {
		check_ajax_referer( 'update-nav_menu', 'update_nav_menu_nonce' );
		
		$html               = '';
		$icon_pack          = isset( $_POST['icon_pack'] ) ? $_POST['icon_pack'] : '';
		$collections_object = laurent_elated_icon_collections()->getIconCollection( $icon_pack );

		if ( $collections_object ) {
			$icons = $collections_object->getIconsArray();
			if ( is_array( $icons ) && count( $icons ) ) {
				foreach ( $icons as $key => $value ) {
					$html .= '<option value="' . esc_attr( $value ) . '">' . esc_html( $key ) . '</option>';
				}
			}
		}

		echo wp_kses( $html, array( 'option' => array( 'value' => true ) ) );
	}

	add_action( 'wp_ajax_update_admin_nav_icon_options', 'laurent_elated_generate_icon_pack_options' );
}

if ( ! function_exists( 'laurent_elated_save_dismisable_notice' ) ) {
	/**
	 * Updates user meta with dismisable notice. Hooks to admin_init action
	 * in order to check this on every page request in admin
	 */
	function laurent_elated_save_dismisable_notice() {
		if ( is_admin() && ! empty( $_GET['eltdf_dismis_notice'] ) ) {
			$notice_id       = sanitize_key( $_GET['eltdf_dismis_notice'] );
			$current_user_id = get_current_user_id();

			update_user_meta( $current_user_id, 'dismis_' . $notice_id, 1 );
		}
	}

	add_action( 'admin_init', 'laurent_elated_save_dismisable_notice' );
}

if ( ! function_exists( 'laurent_elated_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 */
	function laurent_elated_ajax_status( $status, $message, $data = null ) {
		$response = array(
			'status'  => $status,
			'message' => $message,
			'data'    => $data
		);

		$output = json_encode( $response );

		exit( $output );
	}
}

if ( ! function_exists( 'laurent_elated_hook_twitter_request_ajax' ) ) {
	/**
	 * Wrapper function for obtaining twitter request token.
	 *
	 * @see LaurentTwitterApi::obtainRequestToken()
	 */
	function laurent_elated_hook_twitter_request_ajax() {
		check_ajax_referer( 'eltdf_twitter_connect_nonce', 'twitter_connect_nonce' );
		
		LaurentTwitterApi::getInstance()->obtainRequestToken();
	}
	
	add_action( 'wp_ajax_laurent_elated_twitter_obtain_request_token', 'laurent_elated_hook_twitter_request_ajax' );
}

if ( ! function_exists( 'laurent_elated_set_admin_google_api_class' ) ) {
	function laurent_elated_set_admin_google_api_class( $classes ) {
		$google_map_api = laurent_elated_options()->getOptionValue( 'google_maps_api_key' );

		if ( empty( $google_map_api ) ) {
			$classes .= ' eltdf-empty-google-api';
		}
		
		return $classes;
	}
	
	add_filter( 'admin_body_class', 'laurent_elated_set_admin_google_api_class' );
}

if ( ! function_exists( 'laurent_elated_comment' ) ) {
	/**
	 * Function which modify default wordpress comments
	 *
	 * @return comments html
	 */
	function laurent_elated_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		
		global $post;
		
		$comment_classes = array( 'eltdf-comment clearfix' );
		
		$is_author_comment = $post->post_author == $comment->user_id;
		if ( $is_author_comment ) {
			$comment_classes[] = 'eltdf-post-author-comment';
		}
		
		$is_specific_comment = $comment->comment_type == 'pingback' || $comment->comment_type == 'trackback';
		if ( $is_specific_comment ) {
			$comment_classes[] = 'eltdf-no-avatar';
			$comment_classes[] = 'eltdf-' . esc_attr( $comment->comment_type ) . '-comment';
		}
		?>
		<li>
		<div class="<?php echo esc_attr( implode( ' ', $comment_classes ) ); ?>">
			<?php if ( ! $is_specific_comment ) { ?>
				<div class="eltdf-comment-image"> <?php echo laurent_elated_kses_img( get_avatar( $comment, 112 ) ); ?> </div>
			<?php } ?>
			<div class="eltdf-comment-text">
				<div class="eltdf-comment-date"><?php comment_time( get_option( 'date_format' ) ); ?></div>
				<?php
				comment_reply_link( array_merge( $args, array(
					'reply_text' => '',
					'depth'      => $depth,
					'max_depth'  => $args['max_depth']
				) ) );
				edit_comment_link( '' );
				?>
				<div class="eltdf-comment-info">
					<h5 class="eltdf-comment-name vcard">
						<?php if ( $is_specific_comment ) {
							echo sprintf( '%s: ', esc_attr( ucwords( $comment->comment_type ) ) );
						} ?>
						<?php echo wp_kses_post( get_comment_author_link() ); ?>
					</h5>
				</div>
				<?php if ( ! $is_specific_comment ) { ?>
					<div class="eltdf-text-holder" id="comment-<?php echo comment_ID(); ?>">
						<?php comment_text(); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php //li tag will be closed by WordPress after looping through child elements ?>
		<?php
	}
}

/* Taxonomy custom fields functions - START */

if ( ! function_exists( 'laurent_elated_init_custom_taxonomy_fields' ) ) {
	function laurent_elated_init_custom_taxonomy_fields() {
		do_action( 'laurent_elated_action_custom_taxonomy_fields' );
	}
	
	add_action( 'after_setup_theme', 'laurent_elated_init_custom_taxonomy_fields' );
}

if ( ! function_exists( 'laurent_elated_taxonomy_fields_add' ) ) {
	function laurent_elated_taxonomy_fields_add() {
		global $laurent_elated_global_Framework;
		
		foreach ( $laurent_elated_global_Framework->eltdTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			add_action( $fields->scope . '_add_form_fields', 'laurent_elated_taxonomy_fields_display_add', 10, 2 );
		}
	}
	
	add_action( 'after_setup_theme', 'laurent_elated_taxonomy_fields_add', 11 );
}

if ( ! function_exists( 'laurent_elated_taxonomy_fields_edit' ) ) {
	function laurent_elated_taxonomy_fields_edit() {
		global $laurent_elated_global_Framework;
		
		foreach ( $laurent_elated_global_Framework->eltdTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			add_action( $fields->scope . '_edit_form_fields', 'laurent_elated_taxonomy_fields_display_edit', 10, 2 );
		}
	}
	
	add_action( 'after_setup_theme', 'laurent_elated_taxonomy_fields_edit', 11 );
}

if ( ! function_exists( 'laurent_elated_taxonomy_fields_display_add' ) ) {
	function laurent_elated_taxonomy_fields_display_add( $taxonomy ) {
		global $laurent_elated_global_Framework;
		
		foreach ( $laurent_elated_global_Framework->eltdTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			if ( $taxonomy == $fields->scope ) {
				$fields->render();
			}
		}
	}
}

if ( ! function_exists( 'laurent_elated_taxonomy_fields_display_edit' ) ) {
	function laurent_elated_taxonomy_fields_display_edit( $term, $taxonomy ) {
		global $laurent_elated_global_Framework;
		
		foreach ( $laurent_elated_global_Framework->eltdTaxonomyOptions->taxonomyOptions as $key => $fields ) {
			if ( $taxonomy == $fields->scope ) {
				$fields->render();
			}
		}
	}
}

if ( ! function_exists( 'laurent_elated_save_taxonomy_custom_fields' ) ) {
	function laurent_elated_save_taxonomy_custom_fields( $term_id ) {
		$fields = apply_filters( 'laurent_elated_filter_taxonomy_fields', array() );
		
		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				add_term_meta( $term_id, $value, $_POST[ $value ] );
			}
		}
	}
	
	add_action( 'created_term', 'laurent_elated_save_taxonomy_custom_fields', 10, 2 );
}

if ( ! function_exists( 'laurent_elated_update_taxonomy_custom_fields' ) ) {
	function laurent_elated_update_taxonomy_custom_fields( $term_id ) {
		$fields = apply_filters( 'laurent_elated_filter_taxonomy_fields', array() );
		
		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				update_term_meta( $term_id, $value, $_POST[ $value ] );
			} else {
				update_term_meta( $term_id, $value, '' );
			}
		}
	}
	
	add_action( 'edited_term', 'laurent_elated_update_taxonomy_custom_fields', 10, 2 );
}

if ( ! function_exists( 'laurent_elated_tax_add_script' ) ) {
	function laurent_elated_tax_add_script() {
		wp_enqueue_media();
		wp_enqueue_script( 'laurent-elated-admin-tax-js', LAURENT_ELATED_FRAMEWORK_ROOT . '/admin/assets/js/eltdf-ui/eltdf-tax-custom-fields.js' );
	}
	
	add_action( 'admin_enqueue_scripts', 'laurent_elated_tax_add_script' );
}

/** Taxonomy Delete Image **/
if ( ! function_exists( 'laurent_elated_tax_del_image' ) ) {
	function laurent_elated_tax_del_image() {
		check_ajax_referer( 'eltdf_tax_del_image_nonce', 'tax_del_image_nonce' );
		
		/** If we don't have a term_id, bail out **/
		if ( ! isset( $_GET['term_id'] ) ) {
			esc_html_e( 'Not Set or Empty', 'laurent' );
			exit;
		}
		
		$field_name = $_GET['field_name'];
		$term_id    = $_GET['term_id'];
		$imageID    = get_term_meta( $term_id, $field_name, true );  // Get our attachment ID
		
		if ( is_numeric( $imageID ) ) {                              // Verify that the attachment ID is indeed a number
			wp_delete_attachment( $imageID );                       // Delete our image
			delete_term_meta( $term_id, $field_name );// Delete our image meta
			exit;
		}
		
		esc_html_e( 'Contact Administrator', 'laurent' ); // If we've reached this point, something went wrong - enable debugging
		exit;
	}
	
	add_action( 'wp_ajax_laurent_elated_tax_del_image', 'laurent_elated_tax_del_image' );
}

/* Taxonomy custom fields functions - END */

/* User custom fields functions - START */

if ( ! function_exists( 'laurent_elated_user_add_script' ) ) {
	function laurent_elated_user_add_script() {
		wp_enqueue_script( 'laurent-elated-admin-user-js', LAURENT_ELATED_FRAMEWORK_ROOT . '/admin/assets/js/eltdf-ui/eltdf-user-custom-fields.js' );
	}

	add_action( 'admin_enqueue_scripts', 'laurent_elated_user_add_script' );
}


if ( ! function_exists( 'laurent_elated_init_custom_user_fields' ) ) {
	function laurent_elated_init_custom_user_fields() {
		do_action( 'laurent_elated_action_custom_user_fields' );
	}
	
	add_action( 'after_setup_theme', 'laurent_elated_init_custom_user_fields' );
}

if ( ! function_exists( 'laurent_elated_user_fields_edit' ) ) {
	function laurent_elated_user_fields_edit($user) {
		global $laurent_elated_global_Framework;

		foreach ( $laurent_elated_global_Framework->eltdUserOptions->userOptions as $key => $fields ) {

			$display_fields = false;
			foreach ($user->roles as $role) {
				if (in_array($role, $fields->scope)){
					$display_fields = true;
					break;
				}
			}
			if ( $display_fields ) {
				$fields->render();
			}
		}
	}
	
	add_action('show_user_profile', 'laurent_elated_user_fields_edit');
	add_action('edit_user_profile', 'laurent_elated_user_fields_edit');
}

if ( ! function_exists( 'laurent_elated_save_user_fields' ) ) {
	function laurent_elated_save_user_fields($user_id) {
		$fields = apply_filters( 'laurent_elated_filter_user_fields', array() );

		foreach ( $fields as $value ) {
			if ( isset( $_POST[ $value ] ) && '' !== $_POST[ $value ] ) {
				update_user_meta( $user_id, $value, $_POST[ $value ] );
			}
		}
	}
		
	add_action( 'personal_options_update', 'laurent_elated_save_user_fields');
	add_action( 'edit_user_profile_update', 'laurent_elated_save_user_fields');
}
/* User custom fields functions - END */

/** User Delete Image **/
if ( ! function_exists( 'laurent_elated_user_del_image' ) ) {
	function laurent_elated_user_del_image() {
		check_ajax_referer( 'eltdf_user_del_image_nonce', 'user_del_image_nonce' );
		
		/** If we don't have a term_id, bail out **/
		if ( ! isset( $_GET['user_id'] ) ) {
			esc_html_e( 'Not Set or Empty', 'laurent' );
			exit;
		}

		$field_name = $_GET['field_name'];
		$user_id    = $_GET['user_id'];
		$imageID    = get_user_meta( $user_id, $field_name, true );;  // Get our attachment ID

		if ( is_numeric( $imageID ) ) {               // Verify that the attachment ID is indeed a number
			delete_user_meta( $user_id, $field_name );// Delete our image meta
			exit;
		}

		esc_html_e( 'Contact Administrator', 'laurent' ); // If we've reached this point, something went wrong - enable debugging
		exit;
	}

	add_action( 'wp_ajax_laurent_elated_user_del_image', 'laurent_elated_user_del_image' );
}
?>