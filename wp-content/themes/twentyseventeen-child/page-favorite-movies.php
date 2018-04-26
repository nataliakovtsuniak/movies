<?php
/*
Template Name: Favorite Movies
Template Post Type: page
*/
get_header();
$current_user = wp_get_current_user();
?>
    <div class="wrap">
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php while (have_posts()) : the_post(); ?>


                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                        <header class="entry-header">
                            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            <?php twentyseventeen_edit_link(get_the_ID()); ?>
                        </header><!-- .entry-header -->


                        <?php if (is_user_logged_in()):
                            $favorite_movies_arr = get_user_favorites($current_user->ID);
                            if (!empty ($favorite_movies_arr)) {
                                ?>
                                <div class="entry-content movies">
                                    <?php

                                    $favorite_movies_query = new WP_Query(
                                        array(
                                            'post_type' => 'movies',
                                            'post__in' => get_user_favorites($current_user->ID)
                                        )
                                    );

                                    if ($favorite_movies_query->have_posts()) {
                                        while ($favorite_movies_query->have_posts()) {
                                            $favorite_movies_query->the_post();

                                          ?>

                                            <div class="single-movie">
                                                <a href="<?php echo get_the_permalink() ?>"><span><?php echo get_the_title(); ?></span><br>
                                                    <img
                                                        src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'medium'); ?>"></a>
                                                <div><?php the_favorites_button(get_the_ID()); ?></div>
                                            </div>


                                        <?php }
                                    } ?>
                                    <?php wp_reset_postdata();


                                    wp_link_pages(array(
                                        'before' => '<div class="page-links">' . __('Pages:', 'twentyseventeen'),
                                        'after' => '</div>',
                                    ));
                                    ?>
                                </div><!-- .entry-content -->

                            <?php } else { ?>
                                <div>No favorite movies added</div>
                            <?php }; ?>
                        <?php else: ?>

                            <div><a class="login_link"
                                    href="<?php echo wp_login_url(get_permalink('movies-favorites')); ?>" title="Login">Login</a>
                                to add your favorite movies
                            </div>

                        <?php endif; ?>
                    </article><!-- #post-## -->


                <?php endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->
    </div><!-- .wrap -->


<?php get_footer();
