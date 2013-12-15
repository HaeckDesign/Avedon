<?php

/**
 * Media Uploader Using the WordPress Media Library.
 *
 * Parameters:
 * - string $_id - A token to identify this field (the name).
 * - string $_value - The value of the field, if present.
 * - string $_desc - An optional description of the field.
 *
 */

if ( ! function_exists( 'avedontheme_uploader' ) ) :

function avedontheme_uploader( $_id, $_value, $_desc = '', $_name = '' ) {

	$avedontheme_settings = get_option( 'avedontheme' );

	// Gets the unique option id
	if ( isset( $avedontheme_settings['id'] ) ) {
		$option_name = $avedontheme_settings['id'];
	}
	else {
		$option_name = 'avedon_theme_options';
	};

	$output = '';
	$id = '';
	$class = '';
	$int = '';
	$value = '';
	$name = '';

	$id = strip_tags( strtolower( $_id ) );

	// If a value is passed and we don't have a stored value, use the value that's passed through.
	if ( $_value != '' && $value == '' ) {
		$value = $_value;
	}

	if ( $_name != '' ) {
		$name = $_name;
	}
	else {
		$name = $option_name.'['.$id.']';
	}

	if ( $value ) {
		$class = ' has-file';
	}
	$output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="'.$name.'" value="' . $value . '" placeholder="' . __('No file chosen', 'avedon_theme_options') .'" />' . "\n";
	if ( function_exists( 'wp_enqueue_media' ) ) {
		if ( ( $value == '' ) ) {
			$output .= '<input id="upload-' . $id . '" class="upload-button button" type="button" value="' . __( 'Upload', 'avedon_theme_options' ) . '" />' . "\n";
		} else {
			$output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . __( 'Remove', 'avedon_theme_options' ) . '" />' . "\n";
		}
	} else {
		$output .= '<p><i>' . __( 'Upgrade your version of WordPress for full media support.', 'avedon_theme_options' ) . '</i></p>';
	}

	if ( $_desc != '' ) {
		$output .= '<span class="of-metabox-desc">' . $_desc . '</span>' . "\n";
	}

	$output .= '<div class="screenshot" id="' . $id . '-image">' . "\n";

	if ( $value != '' ) {
		$remove = '<a class="remove-image">Remove</a>';
		$image = preg_match( '/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value );
		if ( $image ) {
			$output .= '<img src="' . $value . '" alt="" />'.$remove.'';
		} else {
			$parts = explode( "/", $value );
			for( $i = 0; $i < sizeof( $parts ); ++$i ) {
				$title = $parts[$i];
			}

			// No output preview if it's not an image.
			$output .= '';

			// Standard generic output if it's not an image.
			$title = __( 'View File', 'avedon_theme_options' );
			$output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">'.$title.'</a></span></div>';
		}
	}
	$output .= '</div>' . "\n";
	return $output;
}

endif;

/**
 * Enqueue scripts for file uploader
 */

if ( ! function_exists( 'avedontheme_media_scripts' ) ) :

add_action( 'admin_enqueue_scripts', 'avedontheme_media_scripts' );

function avedontheme_media_scripts( $hook ) {

	$menu = avedontheme_menu_settings();

	if ( 'appearance_page_' . $menu['menu_slug'] != $hook )
		return;

	if ( function_exists( 'wp_enqueue_media' ) )
		wp_enqueue_media();
	wp_register_script( 'of-media-uploader', OPTIONS_FRAMEWORK_DIRECTORY .'js/media-uploader.js', array( 'jquery' ) );
	wp_enqueue_script( 'of-media-uploader' );
	wp_localize_script( 'of-media-uploader', 'avedontheme_l10n', array(
		'upload' => __( 'Upload', 'avedon_theme_options' ),
		'remove' => __( 'Remove', 'avedon_theme_options' )
	) );
}

endif;