<?php

define( 'HCE_THEME_VERSION',    '1.1.2' );
define( 'HCE_CHILD_THEME_DIR',   get_stylesheet_directory() );
define( 'HCE_CHILD_THEME_URL',   get_stylesheet_directory_uri() );

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'genesis-block-theme-style'; 
    $theme = wp_get_theme();
    wp_enqueue_script( 'ratings', HCE_CHILD_THEME_URL . '/assets/js/ratings.js', array( 'jquery' ) );
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') 
    );
    wp_enqueue_style( 'hce-child-theme', HCE_CHILD_THEME_URL . '/css/source.css', [], HCE_THEME_VERSION );
}

function hce_theme_footer_text() {

	// Get the footer copyright text.
	$footer_copy_text = get_theme_mod( 'genesis_block_theme_footer_text' );
    $year = date('Y');

	if ( $footer_copy_text ) {
		$footer_text = $footer_copy_text;
	} else {
		$footer_text = '&copy; ' . $year . ' | Hike Camp Explore';
	}

	return wp_kses_post( $footer_text );

}
add_filter( 'genesis_block_theme_footer_text', 'hce_theme_footer_text' );

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
        return $data;
    }

    $filetype = wp_check_filetype( $filename, $mimes );

    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];

    }, 10, 4 );

    function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
    }
    add_filter( 'upload_mimes', 'cc_mime_types' );

    function fix_svg() {
    echo '<style type="text/css">
            .attachment-266x266, .thumbnail img {
                width: 100% !important;
                height: auto !important;
            }
            </style>';
    }
add_action( 'admin_head', 'fix_svg' );