

<?php
/**
* Template Name: Home Page
* Description: Template for the Home Page
*/
get_header();?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-content' ); ?>>
            <?php the_content(); ?>
        </article>
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();