<?php

function shop2u_add_to_cart_fragment( $fragments ) {
           global $woocommerce;
           $cart_inner_tag = sprintf ( __( '<span class="cart-count cart_value">%d</span>', 'shop2u'), WC()->cart->get_cart_contents_count() );
          ob_start();
          echo $cart_inner_tag;
          $fragments['.cart_value'] = ob_get_clean();
          return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'shop2u_add_to_cart_fragment' ); 


function shop2u_mini_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <div class="cart-details">
			<div class="top-total-cart"><?php _e('Your Cart','shop2u'); ?></div>
			<?php woocommerce_mini_cart(); ?>
		</div>
    <?php
    $fragments['.cart-details'] = ob_get_clean();
    return $fragments;
} 
add_filter( 'woocommerce_add_to_cart_fragments', 'shop2u_mini_cart_fragment' );

// Yith WCWL

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'shop2u_yith_wcwl_get_items_count' ) ) {
 function shop2u_yith_wcwl_get_items_count() {
  ob_start();
  ?>
  <span class="cart-count favorite_value">
    <?php echo esc_html( yith_wcwl_count_all_products() ); ?>
  </span>
  <?php
  return ob_get_clean();
 }
 //add_shortcode( 'yith_wcwl_items_count', 'shop2u_yith_wcwl_get_items_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'shop2u_yith_wcwl_ajax_update_count' ) ) {
 function shop2u_yith_wcwl_ajax_update_count() {
  wp_send_json( array(
      'count' => yith_wcwl_count_all_products()
  ) );
 }
 add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'shop2u_yith_wcwl_ajax_update_count' );
 add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'shop2u_yith_wcwl_ajax_update_count' );
}

if ( defined( 'YITH_WCWL' ) && ! function_exists( 'shop2u_yith_wcwl_enqueue_custom_script' ) ) {
 function shop2u_yith_wcwl_enqueue_custom_script() {
  wp_add_inline_script(
      'jquery-yith-wcwl',
      "
        jQuery( function( $ ) {
          $( document ).on( 'added_to_wishlist removed_from_wishlist', function() {
            $.get( yith_wcwl_l10n.ajax_url, {
              action: 'yith_wcwl_update_wishlist_count'
            }, function( data ) {
              $('.favorite_value').html( data.count );
            } );
          } );
        } );

        // Compare count add and remove function
        jQuery(document)
          .on( 'click', '.product a.compare:not(.added)', function(e){
            e.preventDefault();
                jQuery.ajax({
                    type: 'POST',
                    url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', 'yith_woocompare_add_count' ),
                    data: {
                      action: 'yith_woocompare_add_count'
                    },
                    dataType: 'json',
                    success: function(data){
                      jQuery('.compare_value').html(data);
                    }
                });
          })
          .on('click', '.yith-woocompare-widget li a.remove, .yith-woocompare-widget a.clear-all', function (e) {
            e.preventDefault();
            jQuery.ajax({
                  type: 'POST',
                  url: yith_woocompare.ajaxurl.toString().replace( '%%endpoint%%', 'yith_woocompare_update_count' ),
                  data: {
                    action: 'yith_woocompare_update_count'
                  },
                  dataType: 'json',
                  success: function(data){
                    jQuery('.compare_value').html(data);
                  }
              });
          });

      "
  );
 }
 add_action( 'wp_enqueue_scripts', 'shop2u_yith_wcwl_enqueue_custom_script', 20 );
}

// End Yith WCWL

// YITH Compare button

function shop2u_yith_woocompare_button( $button_text ){

    if(!is_single()){
      return '<i class="fas fa-exchange-alt"></i>';
    }else{
      return $button_text;
    }
    
}
add_filter('wpml_translate_single_string','shop2u_yith_woocompare_button');

function shop2u_yith_woocompare_add_count(){
    global $yith_woocompare;
    echo count($yith_woocompare->obj->products_list) + 1;
    die();
}
add_filter('wc_ajax_yith_woocompare_add_count','shop2u_yith_woocompare_add_count' );
add_filter('wc_ajax_nopriv_yith_woocompare_add_count','shop2u_yith_woocompare_add_count' );

function shop2u_yith_woocompare_update_count(){
    global $yith_woocompare;
    echo count($yith_woocompare->obj->products_list) - 1;
    die();
}
add_filter('wc_ajax_yith_woocompare_update_count','shop2u_yith_woocompare_update_count' );
add_filter('wc_ajax_nopriv_yith_woocompare_update_count','shop2u_yith_woocompare_update_count' );

// End YITH Compare button

/* Loop Remove hook */

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

/* Loop Add new hook */

add_action('woocommerce_before_shop_loop_item_title', 'shop2u_template_loop_product_title_before', 20);
add_action('woocommerce_after_shop_loop_item', 'shop2u_template_loop_product_title_after', 30);
add_action('woocommerce_before_shop_loop_item_title', 'shop2u_template_loop_product_thumbnail', 10);
add_action('woocommerce_after_shop_loop_item', 'shop2u_template_loop_item_before', 1);
add_action('woocommerce_after_shop_loop_item', 'shop2u_template_loop_item_after', 30);
add_action('woocommerce_shop_loop_item_title', 'shop2u_template_loop_product_title', 20);
add_action('woocommerce_before_shop_loop_item_title', 'shop2u_template_loop_product_label', 10);
add_filter('option_yith_woocompare_button_text', 'shop2u_compare_button_text_filter', 99);

function shop2u_template_loop_product_title_before(){
	?>
	<div class="product-content">
		<div class="product-info">
	<?php
}

function shop2u_template_loop_product_title_after(){
	?>
		</div>
	</div>
	<?php
}

function shop2u_template_loop_item_before(){
	?>
	<div class="product_actions">
	<?php
}

function shop2u_template_loop_item_after(){
	?>
	</div>
	<?php
}

function shop2u_template_loop_product_thumbnail(){
	global $product;
	$post_thumbnail_id = $product->get_image_id();
	$placeholder_img_src = wc_placeholder_img();
	?>
	<div class="product_thumbnail">
		<?php
		if ( $post_thumbnail_id ) {
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
			$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'shop2u' ) );
			$html .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
		?>		
	</div>
	<?php
}

function shop2u_compare_button_text_filter( $button_text ){
	return '<i class="fa fa-refresh"></i>';
}

function shop2u_template_loop_product_title(){
	global $product;
	echo '<h2 class="woocommerce-loop-product__title">';
	echo '<a href="' . esc_url($product->get_permalink()) . '">' . esc_html($product->get_title()) . '</a>';
	echo '</h2>';
}

function shop2u_template_loop_product_label(){
	global $product;
	?>
	<div class="product-label">
	<?php 
	echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'shop2u' ) . '</span>', $product );
	?>
	</div>
	<?php
}

function shop2u_calc_discount_percent($regular_price, $sale_price){
	return ( 1 - round($sale_price / $regular_price, 2) ) * 100;
}

add_filter('woocommerce_pagination_args', 'shop2u_woocommerce_pagination_args');
function shop2u_woocommerce_pagination_args( $args ){
	$args['prev_text'] = esc_html__('Prev page', 'shop2u');
	$args['next_text'] = esc_html__('Next page', 'shop2u');
	return $args;
}

/* Sort by best selling */
add_filter( 'woocommerce_default_catalog_orderby_options', 'shop2u_woocommerce_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'shop2u_woocommerce_catalog_orderby' );
function shop2u_woocommerce_catalog_orderby( $sortby ){
	$sortby['best_selling'] = esc_html__('Sort by best selling', 'shop2u');
	return $sortby;
}

add_filter( 'woocommerce_get_catalog_ordering_args', 'shop2u_woocommerce_get_catalog_ordering_args', 10, 2 );
function shop2u_woocommerce_get_catalog_ordering_args( $args, $orderby ){
	if ( 'best_selling' == $orderby ){
		$args['meta_key'] 	= 'total_sales';
		$args['orderby'] 	= 'meta_value_num';
		$args['order'] 		= 'desc';
	}
	return $args;
}


/* Single Remove hook */

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/* Single Add new hook */

add_action('woocommerce_product_thumbnails', 'shop2u_template_loop_product_label', 10);
add_action('woocommerce_single_product_summary', 'shop2u_single_product_calc_discount', 11);
add_filter( 'woocommerce_single_product_carousel_options', 'shop2u_single_product_carousel_options' );

function shop2u_single_product_calc_discount(){
	global $product;
	$percent = '';
	if( $product->is_on_sale() ){
		if( $product->get_type() == 'variable' ){
			$percent = '-1'; /* add html but hide */
		}
		else{
			$regular_price = $product->get_regular_price();
			$sale_price = $product->get_price();
			
			if( $regular_price && $sale_price ){
				$percent = shop2u_calc_discount_percent($regular_price, $sale_price);
			}
		}
	}
	
	if( $percent ){
		echo '<span class="shop2u-discount-percent '.($percent == '-1' ? 'hidden': '').'">-<span>'.$percent.'</span>%</span>';
	}
}

function shop2u_single_product_carousel_options( $options ){
	$options['directionNav'] = true;
    return $options;
}

function shop2u_get_star_rating(){
    global $woocommerce, $product;

    if ( ! wc_review_ratings_enabled() ) {
		return;
	}

	$rating_count = $product->get_rating_count();
	$review_count = $product->get_review_count();
	$average      = $product->get_average_rating();

	if ( $rating_count > 0 ) : ?>

		<div class="woocommerce-product-rating">
			<?php echo wc_get_rating_html( $average, $rating_count ); // WPCS: XSS ok. ?>
			<?php if ( comments_open() ) : ?>
				<?php //phpcs:disable ?>
				<a href="#reviews" class="woocommerce-review-link" rel="nofollow">(<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'shop2u' ), '<span class="count">' . esc_html( $review_count ) . '</span>' ); ?>)</a>
				<?php // phpcs:enable ?>
			<?php endif ?>
		</div>

	<?php endif;
}

add_filter( 'woocommerce_output_related_products_args', 'shop2u_related_products_column', 9999 );
function shop2u_related_products_column( $args ) {
	$args['posts_per_page'] = 3; // # of related products
	$args['columns'] = 3; // # of columns per row
	return $args;
}