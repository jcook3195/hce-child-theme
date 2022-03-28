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

// create query function to get all the posts of a certain type
function get_all_posts_by_cpt($args = null) {
    $default_args = array( 
        'numberposts' => -1,
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'fields' => 'ids',
    );

    if (null !== $args && !empty($args))
        $args = array_merge($default_args, $args);
    else 
        $args = $default_args;

    return get_posts($args);
}

// add a function to dynamically create select choices for all of the hiking posts on the site
function camp_hike_link_select_fields( $field ) {
    // reset choices
    $field['choices'] = array();
    // get all the hiking posts
    $hikes_ids = get_all_posts_by_cpt ( 
        array(
            'post_type' => 'hikes',
            'order' => 'ASC',
    ));

    // loop through array and add to field 'hike_id'
    if( is_array($hikes_ids) ) {
        foreach( $hikes_ids as $hike_id ) {
            // get the trail name field value by the post id
            $trail_name = get_field('trail_name', $hike_id);
            $field['choices'][ $hike_id ] = $trail_name;
        }
    }
    // return the field
    return $field;
}

add_filter('acf/load_field/name=site-hike_link', 'camp_hike_link_select_fields');
