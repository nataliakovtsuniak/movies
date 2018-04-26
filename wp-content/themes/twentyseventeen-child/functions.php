<?php

add_action( 'wp_enqueue_scripts', 'mychildtheme_enqueue_styles' );
function mychildtheme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

require get_template_directory() . '-child/includes/post-types.php';
require get_template_directory() . '-child/includes/meta-boxes.php';
require get_template_directory() . '-child/includes/admin-scripts.php';
require get_template_directory() . '-child/includes/redirects.php';

if ( class_exists( 'WooCommerce' ) ) {
    require get_template_directory() . '-child/includes/movie-product-data-store-cpt.php';
}


add_filter( 'wp_nav_menu_items', 'add_login_logout_register_menu', 199, 2 );
function add_login_logout_register_menu( $items, $args ) {
    if ( $args->theme_location != 'top' ) {
        return $items;
    }
    if ( is_user_logged_in() ) {
        $items .= '<li><a href="' . wp_logout_url() . '">' . __( 'Log Out' ) . '</a></li>';
    } else {
        $items .= '<li><a href="' . wp_login_url() . '">' . __( 'Login In' ) . '</a></li>';
        $items .= '<li><a href="' . wp_registration_url() . '">' . __( 'Sign Up' ) . '</a></li>';
    }
    return $items;
}


add_action( 'register_form', 'myplugin_register_form' );
function myplugin_register_form() {

    $first_name = ( ! empty( $_POST['skype'] ) ) ? sanitize_text_field( $_POST['skype'] ) : '';

    ?>
    <p>
        <label for="skype"><?php _e( 'Skype', 'mydomain' ) ?><br />
            <input type="text" name="skype" id="skype" class="input" value="<?php echo esc_attr(  $first_name  ); ?>" size="25" /></label>
    </p>
    <?php
}



add_filter( 'registration_errors', 'myplugin_registration_errors', 10, 3 );
function myplugin_registration_errors( $errors, $sanitized_user_login, $user_email ) {

    if ( empty( $_POST['skype'] ) || ! empty( $_POST['skype'] ) && trim( $_POST['skype'] ) == '' ) {
        $errors->add( 'skype_error', sprintf('<strong>%s</strong>: %s',__( 'ERROR', 'mydomain' ),__( 'You must include skype', 'mydomain' ) ) );
    }

    return $errors;
}



add_action( 'user_register', 'myplugin_user_register' );
function myplugin_user_register( $user_id ) {
    if ( ! empty( $_POST['skype'] ) ) {
        update_user_meta( $user_id, 'skype', sanitize_text_field( $_POST['skype'] ) );
    }
}


add_filter( 'user_contactmethods', 'skype_contact_field' );

function skype_contact_field( $fields ) {
    $fields['skype'] = __( 'Skype' );
    return $fields;
}


add_filter('login_redirect', 'login_redirect_to_favorites');
function login_redirect_to_favorites() {
    return '/favorite-movies';
}

add_filter( 'registration_redirect', 'register_redirect_to_favorites' );
function register_redirect_to_favorites() {
    return home_url( '/favorite-movies' );
}




add_action( 'admin_notices', 'my_theme_dependencies' );

function my_theme_dependencies() {
    if( ! function_exists('favorites_check_versions') )
        echo '<div class="error"><p>' . __( 'Warning: The theme needs Plugin <a href="https://wordpress.org/plugins/favorites/">Favories</a> to function', 'my-theme' ) . '</p></div>';
}