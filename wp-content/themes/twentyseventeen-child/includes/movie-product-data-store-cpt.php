<?php
// Rewrite Woocommerce data for cpt Movies


class WCCPT_Product_Data_Store_CPT extends WC_Product_Data_Store_CPT {

    public function read( &$product ) {

        $product->set_defaults();

        if ( ! $product->get_id() || ! ( $post_object = get_post( $product->get_id() ) ) || ! in_array( $post_object->post_type, array( 'movies', 'product' ) ) ) { 
            throw new Exception( __( 'Invalid product.', 'woocommerce' ) );
        }

        $id = $product->get_id();

        $product->set_props( array(
            'name'              => $post_object->post_title,
            'slug'              => $post_object->post_name,
            'date_created'      => 0 < $post_object->post_date_gmt ? wc_string_to_timestamp( $post_object->post_date_gmt ) : null,
            'date_modified'     => 0 < $post_object->post_modified_gmt ? wc_string_to_timestamp( $post_object->post_modified_gmt ) : null,
            'status'            => $post_object->post_status,
            'description'       => $post_object->post_content,
            'short_description' => $post_object->post_excerpt,
            'parent_id'         => $post_object->post_parent,
            'menu_order'        => $post_object->menu_order,
            'reviews_allowed'   => 'open' === $post_object->comment_status,
        ) );

        $this->read_attributes( $product );
        $this->read_downloads( $product );
        $this->read_visibility( $product );
        $this->read_product_data( $product );
        $this->read_extra_data( $product );
        $product->set_object_read( true );
    }

   // Get the product type based on product ID.
    
    public function get_product_type( $product_id ) {
        $post_type = get_post_type( $product_id );
        if ( 'product_variation' === $post_type ) {
            return 'variation';
        } elseif ( in_array( $post_type, array( 'movies', 'product' ) ) ) { // change birds with your post type
            $terms = get_the_terms( $product_id, 'product_type' );
            return ! empty( $terms ) ? sanitize_title( current( $terms )->name ) : 'simple';
        } else {
            return false;
        }
    }
}

add_filter( 'woocommerce_data_stores', 'movies_woocommerce_data_stores' );

function movies_woocommerce_data_stores ( $stores ) {
    $stores['product'] = 'WCCPT_Product_Data_Store_CPT';
    return $stores;
}

add_filter('woocommerce_product_get_price', 'woocommerce_product_get_price', 10, 2 );
function woocommerce_product_get_price( $price, $product ) {
    if ($product->post->post_type === 'movies')
        $price = get_post_meta($product->id, "_movie_price", true);
    return $price;
}
