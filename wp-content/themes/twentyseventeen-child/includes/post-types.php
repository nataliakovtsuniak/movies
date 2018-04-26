<?php
//Custom Post Types & Taxonomies

add_action( 'init', 'custom_post_type_movies' );

function custom_post_type_movies() {

    $lables = array(
        'name'               => 'Movies',
        'singular_name'      => 'Movie',
        'add_new'            => 'Add Movie',
        'all_items'          => 'All Movies',
        'add_new_item'       => 'Add New Movie',
        'edit_item'          => 'Edit Movie',
        'new_item'           => 'New Movie',
        'view_item'          => 'View Movie',
        'search_items'       => 'Search Movie',
        'not_found'          => 'No Movie found',
        'not_found_in_trash' => 'No Movies found in trash',
        'parent_item_colon'  => 'Parent Movie',
        'menu_name'          => 'Movies'
    );

    $args = array(
        'labels' => $lables,

        'public'              => true,
        'has_archive'         => 'movies',
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array(
            'title',
            'editor',
            'thumbnail',
//            'custom-fields'

        ),
        'taxonomies'          => array( 'movie_cat'),
        'menu_position'       => 57,
        'exclude_from_search' => false,
        'menu_icon'           => 'dashicons-editor-video'

    );
    register_post_type( 'movies', $args );
}




add_action( 'init', 'movie_post_type_category' );

function movie_post_type_category() {
    $labels = array(
        'name'              => 'Movie Category',
        'singular_name'     => 'Movie Category',
        'search_items'      => 'Movie Category',
        'all_items'         => 'All Movie Categories',
        'parent_item'       => 'Parent Movie Category',
        'parent_item_colon' => 'Parent Movie Category:',
        'edit_item'         => 'Edit Movie Category',
        'update_item'       => 'Update Movie Category',
        'add_new_item'      => 'Add New Movie Category',
        'new_item_name'     => 'New Movie Category',
        'menu_name'         => 'Movie Categories',
    );

    $args = array(
        'label'                 => '',
        'labels'                => $labels,
        'description'           => '',
        'public'                => true,
        'publicly_queryable'    => null,
        'show_in_nav_menus'     => true,
        'show_ui'               => true,
        'show_tagcloud'         => true,
        'show_in_rest'          => null,
        'rest_base'             => null,
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        'capabilities'          => array(),
        'meta_box_cb'           => null,
        'show_admin_column'     => false,
        '_builtin'              => false,
        'show_in_quick_edit'    => null,
    );
    register_taxonomy( 'movie_cat', 'movies', $args );
}

