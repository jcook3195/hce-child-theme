<?php
/**
* Template Name: Hikes
* Description: Template for Hikes
*/

get_header(); ?>

<div id="hikes-page" class="adventure-page">
    <div class="adventure-page-title-container">
        <h1 class="adventure-page-title">Take a Hike</h1>
    </div>
    <hr>
    <div id="hikes-container" class="adventure-list-container">                
        <?php
            // Set up pagination
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
            // Create a loop variable for Hikes custom post type
            $loop = new WP_Query( // Single category
                array(
                    'post_type'         => 'hikes',                
                    'posts_per_page'    => 9,
                    'paged'             => $paged
                )
            );                   

            while ( $loop->have_posts() ) : $loop-> the_post();

            $post_id = get_the_ID();                    
        ?>

        
        <div class="adventure-card-container">
            <a href="<?php the_permalink(); ?>" class="adventure-card-link">
            <div class="adventure-card-image-container">
                    <?php the_post_thumbnail(); ?>
            </div>
                <div class="adventure-card-title-container">
                    <h3 class="adventure-card-title"><?php the_field( 'trail_name' ); ?></h3>
                </div>
                <div class="adventure-card-info-container">
                    <div class="adventure-card-info">
                        <p>Length: <?php the_field( 'trail_length' ); ?></p>
                    </div>
                    <div class="adventure-card-info">
                        <p>Rating: <?php the_field( 'trail_rating_overall' ); ?></p>
                    </div>                                
                </div>            
            </a>     
        </div>               

        <?php
            endwhile; // Kill the while loop
        ?>

        <div class="pagination">
            <?php 
                echo paginate_links( array(
                    'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                    'total'        => $loop->max_num_pages,
                    'current'      => max( 1, get_query_var( 'paged' ) ),
                ) );
            ?>
        </div>

        <?php
            wp_reset_postdata(); // Reset the post data as not to interfere with any other loops 
        ?>
    </div>
</div>

<?php
get_footer();