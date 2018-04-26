<?php

// Custom Meta-boxes for CPT


// Movie Subtitle Meta Box
add_action('add_meta_boxes', 'movie_subtitle_meta_box');

add_action('save_post', 'save_movie_subtitle');

function movie_subtitle_meta_box(){

   add_meta_box( 'movie_subtitle',// $id
        'Movie Subtitle',// $title
        'movie_subtitle_callback',// $callback
        'movies',// $screen
        'advanced',// $context
        'high'
   );

}

function movie_subtitle_callback($post){
    wp_nonce_field('save_movie_subtitle', 'action_movie_subtitle_nonce');
    $movie_subtitle = get_post_meta($post->ID, '_movie_subtitle', true);
    echo '<label for="movie_subtitle_field">';
    echo '<input type="text" id="movie_subtitle_field" name="movie_subtitle_field" placeholder="Enter Subtitle here" value="'. esc_attr($movie_subtitle ) .'">';


}

function save_movie_subtitle($post_id){

    if( wp_verify_nonce($_POST['action_movie_subtitle_nonce'],'save_movie_subtitle') ){
        $movie_subtitle_data = $_POST['movie_subtitle_field'];
        update_post_meta($post_id, '_movie_subtitle', $movie_subtitle_data);
    }

}

// Move "advanced" meta-box above the default editor
add_action('edit_form_after_title', function() {
    global $post, $wp_meta_boxes;
    do_meta_boxes(get_current_screen(), 'advanced', $post);
    unset($wp_meta_boxes[get_post_type($post)]['advanced']);
});








// Movie Price Meta Box
add_action('add_meta_boxes', 'movie_price_meta_box');
add_action('save_post', 'save_movie_price');

function movie_price_meta_box(){
    add_meta_box(
        'movie_price',// $id
        'Movie Price',// $title
        'movie_price_callback',// $callback
        'movies',// $screen
        'side'// $context
    );
}

function movie_price_callback($post){

    wp_nonce_field('save_movie_price', 'action_movie_price_nonce');
    $movie_price = get_post_meta($post->ID, '_movie_price', true);
    echo '<label for="movie_price_field">';
    echo '<input type="text" id="movie_price_field" name="movie_price_field" placeholder="Price" value="'. esc_attr($movie_price ) .'">';

}

function save_movie_price($post_id){

    if( wp_verify_nonce($_POST['action_movie_price_nonce'],'save_movie_price') ){
        $movie_subtitle_data = $_POST['movie_price_field'];
        update_post_meta($post_id, '_movie_price', $movie_subtitle_data);
    }

}
