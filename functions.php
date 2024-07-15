function custom_product_categories_no_images( $atts ) {
    
    $atts = shortcode_atts( array(
        'number'  => null,
        'orderby' => 'name',
        'order'   => 'ASC',
        'columns' => 4,
        'hide_empty' => 1,
    ), $atts, 'custom_product_categories_no_images' );

    $args = array(
        'taxonomy'   => 'product_cat',
        'orderby'    => $atts['orderby'],
        'order'      => $atts['order'],
        'hide_empty' => $atts['hide_empty'],
        'number'     => $atts['number'],
    );
    $product_categories = get_terms( $args );

    if ( empty( $product_categories ) || is_wp_error( $product_categories ) ) {
        return '';
    }

    $columns = intval( $atts['columns'] );
    $column_width = floor(100 / $columns);

    ob_start();
    echo '<ul class="custom-product-categories-no-images" style="list-style: none; padding: 0;">';
    foreach ( $product_categories as $category ) {
        echo '<li style="width: ' . $column_width . '%; display: inline-block; vertical-align: top; box-sizing: border-box; padding: 10px;">';
        echo '<a href="' . esc_url( get_term_link( $category ) ) . '" style="text-decoration: none; color: inherit;">';
        echo '<h2 style="margin: 0;">' . esc_html( $category->name ) . '</h2>';
        echo '</a>';
        echo '</li>';
    }
    echo '</ul>';

    return ob_get_clean();
}
add_shortcode( 'custom_product_categories_no_images', 'custom_product_categories_no_images' );
