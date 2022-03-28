<?php
/*
 * Single Hike Post Template
 */

get_header();

// get the campsite hike link field value and label
$site_hike_link = get_field_object( 'site-hike_link' );
$site_hike_link_value = $site_hike_link['value'];
$site_hike_link_label = $site_hike_link['choices'][ $site_hike_link_value ];
// get the permalink for the hike this campsite is linked to
$linked_hike_permalink = get_permalink( $site_hike_link_value );

?>
<h1><?php echo the_field( 'campsite_name' ) ?></h1>
<a href="<?php echo $linked_hike_permalink; ?>"><?php echo $site_hike_link_label;?></a>

<?php

get_footer();