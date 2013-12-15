<?php

/*
Options Framework Theme - http://wptheming.com/options-framework-theme/
License: GPLv2
Copyright: Devin Price, http://wptheming.com/
*/

/* If the user can't edit theme options, no use running this plugin */

add_action( 'init', 'avedontheme_rolescheck' );

function avedontheme_rolescheck () {
	if ( current_user_can( 'edit_theme_options' ) ) {
		// If the user can edit theme options, let the fun begin!
		add_action( 'admin_menu', 'avedontheme_add_page');
		add_action( 'admin_init', 'avedontheme_init' );
		add_action( 'wp_before_admin_bar_render', 'avedontheme_adminbar' );
	}
}

/* Loads the file for option sanitization */

add_action( 'init', 'avedontheme_load_sanitization' );

function avedontheme_load_sanitization() {
	require_once dirname( __FILE__ ) . '/options-sanitize.php';
}

/*
 * Creates the settings in the database by looping through the array
 * we supplied in options.php.  This is a neat way to do it since
 * we won't have to save settings for headers, descriptions, or arguments.
 *
 * Read more about the Settings API in the WordPress codex:
 * http://codex.wordpress.org/Settings_API
 *
 */

function avedontheme_init() {

	// Include the required files
	require_once dirname( __FILE__ ) . '/options-interface.php';
	require_once dirname( __FILE__ ) . '/options-media-uploader.php';

	// Optionally Loads the options file from the theme
	$location = apply_filters( 'options_framework_location', array( 'options.php' ) );
	$optionsfile = locate_template( $location );

	// Load settings
	$avedontheme_settings = get_option('avedontheme' );

	// Updates the unique option id in the database if it has changed
	if ( function_exists( 'avedontheme_option_name' ) ) {
		avedontheme_option_name();
	}
	elseif ( has_action( 'avedontheme_option_name' ) ) {
		do_action( 'avedontheme_option_name' );
	}
	// If the developer hasn't explicitly set an option id, we'll use a default
	else {
		$default_themename = get_option( 'stylesheet' );
		$default_themename = preg_replace("/\W/", "_", strtolower($default_themename) );
		$default_themename = 'avedontheme_' . $default_themename;
		if ( isset( $avedontheme_settings['id'] ) ) {
			if ( $avedontheme_settings['id'] == $default_themename ) {
				// All good, using default theme id
			} else {
				$avedontheme_settings['id'] = $default_themename;
				update_option( 'avedontheme', $avedontheme_settings );
			}
		}
		else {
			$avedontheme_settings['id'] = $default_themename;
			update_option( 'avedontheme', $avedontheme_settings );
		}
	}

	// If the option has no saved data, load the defaults
	if ( ! get_option( $avedontheme_settings['id'] ) ) {
		avedontheme_setdefaults();
	}

	// Registers the settings fields and callback
	register_setting( 'avedontheme', $avedontheme_settings['id'], 'avedontheme_validate' );
	// Change the capability required to save the 'avedontheme' options group.
	add_filter( 'option_page_capability_avedontheme', 'avedontheme_page_capability' );
}

/**
 * Ensures that a user with the 'edit_theme_options' capability can actually set the options
 * See: http://core.trac.wordpress.org/ticket/14365
 *
 * @param string $capability The capability used for the page, which is manage_options by default.
 * @return string The capability to actually use.
 */

function avedontheme_page_capability( $capability ) {
	return 'edit_theme_options';
}

/*
 * Adds default options to the database if they aren't already present.
 * May update this later to load only on plugin activation, or theme
 * activation since most people won't be editing the options.php
 * on a regular basis.
 *
 * http://codex.wordpress.org/Function_Reference/add_option
 *
 */

function avedontheme_setdefaults() {

	$avedontheme_settings = get_option( 'avedontheme' );

	// Gets the unique option id
	$option_name = $avedontheme_settings['id'];

	/*
	 * Each theme will hopefully have a unique id, and all of its options saved
	 * as a separate option set.  We need to track all of these option sets so
	 * it can be easily deleted if someone wishes to remove the plugin and
	 * its associated data.  No need to clutter the database.
	 *
	 */

	if ( isset( $avedontheme_settings['knownoptions'] ) ) {
		$knownoptions =  $avedontheme_settings['knownoptions'];
		if ( !in_array( $option_name, $knownoptions ) ) {
			array_push( $knownoptions, $option_name );
			$avedontheme_settings['knownoptions'] = $knownoptions;
			update_option( 'avedontheme', $avedontheme_settings );
		}
	} else {
		$newoptionname = array( $option_name );
		$avedontheme_settings['knownoptions'] = $newoptionname;
		update_option( 'avedontheme', $avedontheme_settings );
	}

	// Gets the default options data from the array in options.php
	$options =& _avedontheme_options();

	// If the options haven't been added to the database yet, they are added now
	$values = of_get_default_values();

	if ( isset( $values ) ) {
		add_option( $option_name, $values ); // Add option with default settings
	}
}

/* Define menu options (still limited to appearance section)
 *
 * Examples usage:
 *
 * add_filter( 'avedontheme_menu', function($menu) {
 *     $menu['page_title'] = 'Hello Options';
 *	   $menu['menu_title'] = 'Hello Options';
 *     return $menu;
 * });
 */

function avedontheme_menu_settings() {

	$menu = array(
		'page_title' => __( 'Avedon Theme', 'avedontheme'),
		'menu_title' => __('Theme Options', 'avedontheme'),
		'capability' => 'edit_theme_options',
		'menu_slug' => 'options-framework',
		'callback' => 'avedontheme_page'
	);

	return apply_filters( 'avedontheme_menu', $menu );
}

/* Add a subpage called "Theme Options" to the appearance menu. */

function avedontheme_add_page() {

	$menu = avedontheme_menu_settings();
	$of_page = add_theme_page( $menu['page_title'], $menu['menu_title'], $menu['capability'], $menu['menu_slug'], $menu['callback'] );

	// Load the required CSS and javscript
	add_action( 'admin_enqueue_scripts', 'avedontheme_load_scripts' );
	add_action( 'admin_print_styles-' . $of_page, 'avedontheme_load_styles' );
}

/* Loads the CSS */

function avedontheme_load_styles() {
	wp_enqueue_style( 'avedontheme', OPTIONS_FRAMEWORK_DIRECTORY.'css/avedontheme.css' );
	if ( !wp_style_is( 'wp-color-picker','registered' ) ) {
		wp_register_style( 'wp-color-picker', OPTIONS_FRAMEWORK_DIRECTORY.'css/color-picker.min.css' );
	}
	wp_enqueue_style( 'wp-color-picker' );
}

/* Loads the javascript */

function avedontheme_load_scripts( $hook ) {

	$menu = avedontheme_menu_settings();

	if ( 'appearance_page_' . $menu['menu_slug'] != $hook )
        return;

	// Enqueue colorpicker scripts for versions below 3.5 for compatibility
	if ( !wp_script_is( 'wp-color-picker', 'registered' ) ) {
		wp_register_script( 'iris', OPTIONS_FRAMEWORK_DIRECTORY . 'js/iris.min.js', array( 'jquery-ui-draggable', 'jquery-ui-slider', 'jquery-touch-punch' ), false, 1 );
		wp_register_script( 'wp-color-picker', OPTIONS_FRAMEWORK_DIRECTORY . 'js/color-picker.min.js', array( 'jquery', 'iris' ) );
		$colorpicker_l10n = array(
			'clear' => __( 'Clear','avedon_theme_options' ),
			'defaultString' => __( 'Default', 'avedon_theme_options' ),
			'pick' => __( 'Select Color', 'avedon_theme_options' )
		);
		wp_localize_script( 'wp-color-picker', 'wpColorPickerL10n', $colorpicker_l10n );
	}

	// Enqueue custom option panel JS
	wp_enqueue_script( 'options-custom', OPTIONS_FRAMEWORK_DIRECTORY . 'js/options-custom.js', array( 'jquery','wp-color-picker' ) );

	// Inline scripts from options-interface.php
	add_action( 'admin_head', 'of_admin_head' );
}

function of_admin_head() {
	// Hook to add custom scripts
	do_action( 'avedontheme_custom_scripts' );
}


/**
 * Returns an array of system fonts
 * Feel free to edit this, update the font fallbacks, etc.
 */

function options_typography_get_os_fonts() {
	// OS Font Defaults
	$os_faces = array(
		'Arial, sans-serif' => 'Arial',
		'"Avant Garde", sans-serif' => 'Avant Garde',
		'"Helvetica Neue", Helvetica, sans-serif' => 'Helvetica Neue',
		'Tahoma, Geneva, sans-serif' => 'Tahoma'
	);
	return $os_faces;
}

/**
 * Returns a select list of Google fonts
 * Feel free to edit this, update the fallbacks, etc.
 */

function options_typography_get_google_fonts() {
	// Google Font Defaults
	$google_faces = array(
		'Archivon Arrow, sans-serif' => 'Archivon Arrow',
		'Bitter, sans-serif' => 'Bitter',
		'Cabin, sans-serif' => 'Cabin',
		'Comfortaa, sans-serif' => 'Comfortaa',
		'Crete Round, sans-serif' => 'Crete Round',
		'Comfortaa, sans-serif' => 'Comfortaa',
		'Fauna One, sans-serif' => 'Fauna One',
		'Gravitas One, sans-serif' => 'Gravitas One',
		'Lato, sans-serif' => 'Lato',
		'Montserrat, sans-serif' => 'Montserrat',
		'Montserrat Alternates, sans-serif' => 'Montserrat Alternates',
		'Nobile, sans-serif' => 'Nobile',
		'Open Sans, sans-serif' => 'Open Sans',
		'Orienta, sans-serif' => 'Orienta',
		'Oxygen, sans-serif' => 'Oxygen',
		'Paytone One, sans-serif' => 'Paytone One',
		'Pontano Sans, sans-serif' => 'Pontano Sans',
		'Questrial, sans-serif' => 'Questrial',
		'Quicksand, sans-serif' => 'Quicksand',
		'Raleway, sans-serif' => 'Raleway',
		'Righteous, sans-serif' => 'Righteous',
		'Roboto, sans-serif' => 'Roboto',
		'Sintony, sans-serif' => 'Sintony'

	);
	return $google_faces;
}



/*
 * Builds out the options panel.
 *
 * If we were using the Settings API as it was likely intended we would use
 * do_settings_sections here.  But as we don't want the settings wrapped in a table,
 * we'll call our own custom avedontheme_fields.  See options-interface.php
 * for specifics on how each individual field is generated.
 *
 * Nonces are provided using the settings_fields()
 *
 */

if ( !function_exists( 'avedontheme_page' ) ) :
function avedontheme_page() {
	settings_errors(); ?>

	<div id="avedontheme-wrap" class="wrap">
    <span class="avedonlogo"></span>
    <h2 class="nav-tab-wrapper">
        <?php echo avedontheme_tabs(); ?>
    </h2>

    <div id="avedontheme-metabox" class="metabox-holder">
	    <div id="avedontheme" class="postbox">
			<form action="options.php" method="post">
			<?php settings_fields( 'avedontheme' ); ?>
			<?php avedontheme_fields(); /* Settings */ ?>
			<div id="avedontheme-submit">
				<input type="submit" class="button-primary" name="update" value="<?php esc_attr_e( 'Save Options', 'avedon_theme_options' ); ?>" />
				<input type="submit" class="reset-button button-secondary" name="reset" value="<?php esc_attr_e( 'Restore Defaults', 'avedon_theme_options' ); ?>" onclick="return confirm( '<?php print esc_js( __( 'Click OK to reset. Any theme settings will be lost!', 'avedon_theme_options' ) ); ?>' );" />
				<div class="clear"></div>
			</div>
			</form>
		</div> <!-- / #container -->
	</div>
	<?php do_action( 'avedontheme_after' ); ?>
	</div> <!-- / .wrap -->

<?php
}
endif;

/**
 * Validate Options.
 *
 * This runs after the submit/reset button has been clicked and
 * validates the inputs.
 *
 * @uses $_POST['reset'] to restore default options
 */
function avedontheme_validate( $input ) {

	/*
	 * Restore Defaults.
	 *
	 * In the event that the user clicked the "Restore Defaults"
	 * button, the options defined in the theme's options.php
	 * file will be added to the option for the active theme.
	 */

	if ( isset( $_POST['reset'] ) ) {
		add_settings_error( 'options-framework', 'restore_defaults', __( 'Default options restored.', 'avedon_theme_options' ), 'updated fade' );
		return of_get_default_values();
	}

	/*
	 * Update Settings
	 *
	 * This used to check for $_POST['update'], but has been updated
	 * to be compatible with the theme customizer introduced in WordPress 3.4
	 */

	$clean = array();
	$options =& _avedontheme_options();
	foreach ( $options as $option ) {

		if ( ! isset( $option['id'] ) ) {
			continue;
		}

		if ( ! isset( $option['type'] ) ) {
			continue;
		}

		$id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $option['id'] ) );

		// Set checkbox to false if it wasn't sent in the $_POST
		if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
			$input[$id] = false;
		}

		// Set each item in the multicheck to false if it wasn't sent in the $_POST
		if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
			foreach ( $option['options'] as $key => $value ) {
				$input[$id][$key] = false;
			}
		}

		// For a value to be submitted to database it must pass through a sanitization filter
		if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
			$clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
		}
	}

	// Hook to run after validation
	do_action( 'avedontheme_after_validate', $clean );

	return $clean;
}

/* Custom Scripts */

function avedontheme_custom_scripts() {

echo '<script type="text/javascript">
jQuery(document).ready(function(){jQuery("#social_icons").click(function(){jQuery("#section-twitter_uid").fadeToggle(400);jQuery("#section-googleplus_uid").fadeToggle(400);jQuery("#section-facebook_uid").fadeToggle(400);jQuery("#section-stumble_uid").fadeToggle(400);jQuery("#section-pinterest_uid").fadeToggle(400);jQuery("#section-flickr_uid").fadeToggle(400);jQuery("#section-instagram_uid").fadeToggle(400);jQuery("#section-foursquare_uid").fadeToggle(400);jQuery("#section-youtube_uid").fadeToggle(400);jQuery("#section-vimeo_uid").fadeToggle(400);jQuery("#section-linkedin_uid").fadeToggle(400);jQuery("#section-dribbble_uid").fadeToggle(400);jQuery("#section-forrst_uid").fadeToggle(400);jQuery("#section-wordpress_uid").fadeToggle(400);jQuery("#section-soundcloud_uid").fadeToggle(400);jQuery("#section-lastfm_uid").fadeToggle(400);jQuery("#section-rss_uid").fadeToggle(400);jQuery("#section-sociallink_color").fadeToggle(400);jQuery("#section-sociallinkhover_color").fadeToggle(400)});if(jQuery("#social_icons:checked").val()!==undefined){jQuery("#section-twitter_uid").show();jQuery("#section-googleplus_uid").show();jQuery("#section-facebook_uid").show();jQuery("#section-stumble_uid").show();jQuery("#section-pinterest_uid").show();jQuery("#section-flickr_uid").show();jQuery("#section-instagram_uid").show();jQuery("#section-foursquare_uid").show();jQuery("#section-youtube_uid").show();jQuery("#section-vimeo_uid").show();jQuery("#section-linkedin_uid").show();jQuery("#section-dribbble_uid").show();jQuery("#section-forrst_uid").show();jQuery("#section-wordpress_uid").show();jQuery("#section-soundcloud_uid").show();jQuery("#section-lastfm_uid").show();jQuery("#section-rss_uid").show();jQuery("#section-sociallink_color").show();jQuery("#section-sociallinkhover_color").show()}jQuery("#show_supersize").click(function(){jQuery("#section-example_uploadnumber").fadeToggle(400);jQuery("#section-super_effects").fadeToggle(400);jQuery("#section-super_translideint").fadeToggle(400);jQuery("#section-super_transpeed").fadeToggle(400);jQuery("#section-super_mode").fadeToggle(400);jQuery("#section-super_array").fadeToggle(400)});if(jQuery("#show_supersize:checked").val()!==undefined){jQuery("#section-example_uploadnumber").show();jQuery("#section-super_effects").show();jQuery("#section-super_translideint").show();jQuery("#section-super_transpeed").show();jQuery("#section-super_mode").show();jQuery("#section-super_array").show()}jQuery("#radio_images").click(function(){jQuery("#section-radio_image_one").fadeToggle(400);jQuery("#section-radio_image_one_credit").fadeToggle(400)});if(jQuery("#avedontheme_avedon-radio_images-one:checked").val()!==undefined){jQuery("#section-radio_image_one").show();jQuery("#section-radio_image_one_credit").show()}if(jQuery("#avedontheme_avedon-radio_images-two:checked").val()!==undefined){jQuery("#section-radio_image_one").show();jQuery("#section-radio_image_one_credit").show();jQuery("#section-radio_image_two").show();jQuery("#section-radio_image_two_credit").show()}if(jQuery("#avedontheme_avedon-radio_images-three:checked").val()!==undefined){jQuery("#section-radio_image_one").show();jQuery("#section-radio_image_one_credit").show();jQuery("#section-radio_image_two").show();jQuery("#section-radio_image_two_credit").show();jQuery("#section-radio_image_three").show();jQuery("#section-radio_image_three_credit").show()}if(jQuery("#avedontheme_avedon-radio_images-four:checked").val()!==undefined){jQuery("#section-radio_image_one").show();jQuery("#section-radio_image_one_credit").show();jQuery("#section-radio_image_two").show();jQuery("#section-radio_image_two_credit").show();jQuery("#section-radio_image_three").show();jQuery("#section-radio_image_three_credit").show();jQuery("#section-radio_image_four").show();jQuery("#section-radio_image_four_credit").show()}if(jQuery("#avedontheme_avedon-radio_images-five:checked").val()!==undefined){jQuery("#section-radio_image_one").show();jQuery("#section-radio_image_one_credit").show();jQuery("#section-radio_image_two").show();jQuery("#section-radio_image_two_credit").show();jQuery("#section-radio_image_three").show();jQuery("#section-radio_image_three_credit").show();jQuery("#section-radio_image_four").show();jQuery("#section-radio_image_four_credit").show();jQuery("#section-radio_image_five").show();jQuery("#section-radio_image_five_credit").show()}
});</script>';

}

add_action('admin_head', 'avedontheme_custom_scripts');


/**
 * Display message when options have been saved
 */

function avedontheme_save_options_notice() {
	add_settings_error( 'options-framework', 'save_options', __( 'New Options Saved.', 'avedon_theme_options' ), 'updated fade' );
}

add_action( 'avedontheme_after_validate', 'avedontheme_save_options_notice' );

/**
 * Format Configuration Array.
 *
 * Get an array of all default values as set in
 * options.php. The 'id','std' and 'type' keys need
 * to be defined in the configuration array. In the
 * event that these keys are not present the option
 * will not be included in this function's output.
 *
 * @return    array     Rey-keyed options configuration array.
 *
 * @access    private
 */

function of_get_default_values() {
	$output = array();
	$config =& _avedontheme_options();
	foreach ( (array) $config as $option ) {
		if ( ! isset( $option['id'] ) ) {
			continue;
		}
		if ( ! isset( $option['std'] ) ) {
			continue;
		}
		if ( ! isset( $option['type'] ) ) {
			continue;
		}
		if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
			$output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
		}
	}
	return $output;
}

/**
 * Add Theme Options menu item to Admin Bar.
 */

function avedontheme_adminbar() {

	global $wp_admin_bar;

	$wp_admin_bar->add_menu( array(
			'parent' => 'appearance',
			'id' => 'of_theme_options',
			'title' => __( 'Theme Options', 'avedon_theme_options' ),
			'href' => admin_url( 'themes.php?page=options-framework' )
		));
}

/**
 * Wrapper for avedontheme_options()
 *
 * Allows for manipulating or setting options via 'of_options' filter
 * For example:
 *
 * <code>
 * add_filter('of_options', function($options) {
 *     $options[] = array(
 *         'name' => 'Input Text Mini',
 *         'desc' => 'A mini text input field.',
 *         'id' => 'example_text_mini',
 *         'std' => 'Default',
 *         'class' => 'mini',
 *         'type' => 'text'
 *     );
 *
 *     return $options;
 * });
 * </code>
 *
 * Also allows for setting options via a return statement in the
 * options.php file.  For example (in options.php):
 *
 * <code>
 * return array(...);
 * </code>
 *
 * @return array (by reference)
 */
function &_avedontheme_options() {
	static $options = null;

	if ( !$options ) {
		// Load options from options.php file (if it exists)
		$location = apply_filters( 'options_framework_location', array('options.php') );
		if ( $optionsfile = locate_template( $location ) ) {
			$maybe_options = require_once $optionsfile;
			if ( is_array($maybe_options) ) {
				$options = $maybe_options;
			} else if ( function_exists( 'avedontheme_options' ) ) {
				$options = avedontheme_options();
			}
		}

		// Allow setting/manipulating options via filters
		$options = apply_filters('of_options', $options);
	}

	return $options;
}

/**
 * Get Option.
 *
 * Helper function to return the theme option value.
 * If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 */

if ( ! function_exists( 'of_get_option' ) ) {

	function of_get_option( $name, $default = false ) {
		$config = get_option( 'avedontheme' );

		if ( ! isset( $config['id'] ) ) {
			return $default;
		}

		$options = get_option( $config['id'] );

		if ( isset( $options[$name] ) ) {
			return $options[$name];
		}

		return $default;
	}
}