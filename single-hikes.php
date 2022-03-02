<?php
/*
 * Single Hike Post Template
 */

get_header();

// get the categories for the post
$categories = get_categories( array(
    'orderby' => 'name',
    'order'   => 'ASC'
) );

// get the tags for the post
$tags = get_the_terms($post->ID, 'difficulty');

// convert trail length in miles to km with 1 number after decimal
$trail_length_km = round((get_field('trail_length') * 1.609344), 1);

// get the pretty version of the trail type values
$trail_type_pretty = '';
$trail_type = get_field('trail_type');

if( $trail_type == 'out_and_back' ) {
    $trail_type_pretty = 'Out and Back';
} else if ( $trail_type === 'loop' ) {
    $trail_type_pretty = 'Loop';
}

?>

<div id="single-hikes-page" class="single-adventure-page">
    <div class="single-adventure-container">
        <div class="single-adventure-hero-container">
            <?php the_post_thumbnail(); ?>
            <div class="single-adventure-title-container">
                <h1 class="single-adventure-title"><?php the_field( 'trail_name'); ?></h1>
            </div>
        </div>
        <div class="single-adventure-info-container">
            <div class="single-adventure-misc-info">
                <div class="single-misc-info">
                    <p>Location: <?php the_field('major_city_nearest_trail'); ?>, <?php the_field('trail_state'); ?></p>
                </div>
                <div class="single-misc-info">
                    <p>Trail Length: <?php the_field('trail_length'); ?>mi (<?php echo $trail_length_km; ?>km)</p>
                </div>
                <div class="single-misc-info">
                    <p>Trail Type: <?php echo $trail_type_pretty; ?></p>
                </div>
            </div>
            <div class="single-adventure-ratings-container">
                <div id="overall-rating" class="single-adventure-single-rating">
                    <div class="single-adventure-rating-title">
                        <p class="rating-title">Overall</p>
                    </div>
                    <div class="single-adventure-rating-bar">
                        <div class="single-adventure-rating-progress">                            
                            <div class="hidden-rating-progress-number"><?php the_field( 'trail_rating_overall' ); ?></div>
                        </div>
                    </div>
                    <div class="rating-descriptive-text">
                        <p></p>
                    </div>
                </div>

                <div id="difficulty-rating" class="single-adventure-single-rating">
                    <div class="single-adventure-rating-title">
                        <p class="rating-title">Difficulty</p>
                    </div>
                    <div class="single-adventure-rating-bar">
                        <div class="single-adventure-rating-progress">                            
                            <div class="hidden-rating-progress-number"><?php the_field( 'trail_rating_difficulty' ); ?></div>
                        </div>
                    </div>
                    <div class="rating-descriptive-text">
                        <p></p>
                    </div>
                </div>

                <div id="views-rating" class="single-adventure-single-rating">
                    <div class="single-adventure-rating-title">
                        <p class="rating-title">Views</p>
                    </div>
                    <div class="single-adventure-rating-bar">
                        <div class="single-adventure-rating-progress">                            
                            <div class="hidden-rating-progress-number"><?php the_field( 'trail_rating_views' ); ?></div>
                        </div>
                    </div>
                    <div class="rating-descriptive-text">
                        <p></p>
                    </div>
                </div>

                <div id="popularity-rating" class="single-adventure-single-rating">
                    <div class="single-adventure-rating-title">
                        <p class="rating-title">Popularity</p>
                    </div>
                    <div class="single-adventure-rating-bar">
                        <div class="single-adventure-rating-progress">                            
                            <div class="hidden-rating-progress-number"><?php the_field( 'trail_rating_popularity' ); ?></div>
                        </div>
                    </div>
                    <div class="rating-descriptive-text">
                        <p></p>
                    </div>
                </div>
            </div>            
        </div>
        <div class="single-adventure-description-container">
            <div class="single-adventure-description">
                <?php the_field('trail_description'); ?>
            </div>
        </div>
        <div class="single-adventure-categories-container">
            <h3 class="single-adventure-categories-title">Categories</h3>
            <?php                                
                foreach( $categories as $category ) { ?>
                <div class="single-category">
                    <?php
                        if ($category->name != 'Uncategorized') {
                            echo '<p>' . $category->name . '</p>';
                        }                        
                    ?>
                </div>
                <?php
                } 
            ?>
        </div>
        <div class="single-adventure-tags-container">
            <h3 class="single-adventure-tags-title">Tags</h3>
            <?php                                
                foreach( $tags as $tag ) { ?>
                <div class="single-tag">
                    <?php
                        echo '<p>' . $tag->name . '</p>';                       
                    ?>
                </div>
                <?php
                } 
            ?>
        </div>
    </div>
</div>

<?php

get_footer();