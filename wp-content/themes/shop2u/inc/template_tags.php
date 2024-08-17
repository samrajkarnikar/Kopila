<?php

function shop2u_body_classes( $classes ) {
    global $shop2u_options;
    return $classes;
}
add_filter( 'body_class', 'shop2u_body_classes');

if ( ! function_exists( 'shop2u_logo' ) ) {
    function shop2u_logo(){
        $class = array();
        $html = '';
        
        if ( function_exists( 'has_custom_logo' ) ) {
            if ( has_custom_logo()) {
                $html .= get_custom_logo();
            }else{
                $html .= '<h1 class="site-title"><a href="'.esc_url( home_url( '/' ) ).'" rel="home">' . get_bloginfo('name') . '</a></h1>';
                
                $description = get_bloginfo( 'description', 'display' );
                if ( $description || is_customize_preview() ) {
                    $html .= '<p class="site-description mb-0">'.$description.'</p>';
                }
            }
        }
        ?>
        <div class="logo-img <?php echo esc_attr( join( ' ', $class ) ); ?>"><?php echo wp_kses_post($html); ?></div>
        <?php
    }
}

if ( ! function_exists( 'shop2u_navigations' ) ) {
    function shop2u_navigations(){
        if ( has_nav_menu( 'primary' ) || ! has_nav_menu( 'expanded' ) ) {
        ?>
        <ul class="primary-menu-list">
            <?php 
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'container'  => '',
                    'items_wrap' => '%3$s',
                    'theme_location' => 'primary',
                ) );
            }elseif( ! has_nav_menu( 'expanded' ) ) {
                wp_list_pages( array(
                    'match_menu_classes' => true,
                    'show_sub_menu_icons' => true,
                    'title_li' => false,
                    'walker'   => new Shop2u_Walker_Page(),
                ) );
            }
            ?>
        </ul>
        <?php
        }
    }
}

if( !function_exists('shop2u_header_product_search') ){
    function shop2u_header_product_search(){
        ?>
        <form class="header-search-form" method="get" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="product-search-auter">
                <div class="product-category">
                    <div class="box">
                        <select name="product_cat" class="form-control form-select product-cat-select">
                            <option value=""><?php esc_html_e('Select Category', 'shop2u'); ?></option>
                            <?php 
                            $categories = get_categories('taxonomy=product_cat');
                            foreach ($categories as $category) {
                            ?>
                            <option value="<?php echo esc_attr($category->category_nicename); ?>"><?php echo esc_html($category->cat_name); ?> (<?php echo absint($category->category_count); ?>)</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="search-wrapper">
                    <input type="search" class="form-control search-field" name="s" placeholder="<?php esc_attr_e('Search Product...', 'shop2u'); ?>">
                </div>
                <input type="hidden" name="post_type" value="product">
                <button type="submit" value="Search" class="search-btn"><i class="fa fa-search"></i></button>
            </div>
        </form>
        <?php
    }
}

if(!function_exists('shop2u_browser_categories')){
    function shop2u_browser_categories(){
        $list_args = array(
            'taxonomy'     => 'category',
            'title_li'     => '',
            'show_count'   => 0,
            'hierarchical' => 1,            
            'hide_empty'   => 1,
            'max_depth'    => 50,
            'current_category' => 0,
        );

        if( class_exists('woocommerce') ){
            $list_args['taxonomy'] = 'product_cat';
        }

        echo '<ul class="menu">';
            wp_list_categories($list_args);
        echo '</ul>';
    }
}

if( !function_exists('shop2u_breadcrumbs_title') ){
    function shop2u_breadcrumbs_title(){
        ?>
        <h3 class="breadcrumb-hrading">
            <?php 
            if ( is_day() ) : 
                    
                printf( __( 'Daily Archives: %s', 'shop2u' ), get_the_date() ); 
            
            elseif ( is_month() ) :
            
                printf( __( 'Monthly Archives: %s', 'shop2u' ), get_the_date( 'F Y' ) );
                
            elseif ( is_year() ) :
            
                printf( __( 'Yearly Archives: %s', 'shop2u' ), get_the_date( 'Y' )  );
                
            elseif ( is_category() ) :
            
                printf( __( 'Category Archives: %s', 'shop2u' ), single_cat_title( '', false ) );

            elseif ( is_tag() ) :
            
                printf( __( 'Tag Archives: %s', 'shop2u' ), single_tag_title( '', false ) );
                
            elseif ( is_404() ) :

                printf( __( 'Error 404', 'shop2u' ));
                
            elseif ( is_author() ) :
            
                printf( __( 'Author: %s', 'shop2u' ), get_the_author( '', false ) );

            elseif ( is_archive() ):

                if( is_post_type_archive() ){

                    printf( __( '%s', 'shop2u' ), post_type_archive_title( '', false ) );

                }else{

                    printf( __( 'Archives: %s', 'shop2u' ), post_type_archive_title( '', false ) );

                }

            elseif ( is_front_page() ):

                printf( __( 'Home', 'shop2u' ) );

            elseif ( is_home() ):

                single_post_title();

            else :
                the_title();
            endif;
            ?>
        </h3>
        <?php
    }
}

if( !function_exists('shop2u_breadcrumbs') ){
    function shop2u_breadcrumbs(){

        $delimiter_char = '<i class="fas fa-chevron-right"></i>';

        if( class_exists('WooCommerce') ){
            if( 
                function_exists('woocommerce_breadcrumb') && 
                function_exists('is_woocommerce') && 
                is_woocommerce() ){
                woocommerce_breadcrumb(
                    array(
                        'wrap_before'=>'<span class="breadcrumb-links">',
                        'delimiter'=>isset($delimiter_char) ?'<span>'.$delimiter_char.'</span>':'',
                        'wrap_after'=>'</span>'
                    )
                );
                return;
            }
        }

        $allowed_html = array(
            'a'     => array('href' => array(), 'title' => array()),
            'span' => array('class' => array()),
            'div'  => array('class' => array()),
            'i'  => array('class' => array())
        );

        $output = '';

        $delimiter = isset($delimiter_char) ?'<span>'.$delimiter_char.'</span>':'';
        
        $ar_title = array(
                    'home'          => '<i class="fas fa-home"></i>'
                    ,'search'       => __('Search results for ', 'shop2u')
                    ,'404'          => __('Error 404', 'shop2u')
                    ,'tagged'       => __('Tagged ', 'shop2u')
                    ,'author'       => __('Articles posted by ', 'shop2u')
                    ,'page'         => __('Page', 'shop2u')
                    );
      
        $before = '<span class="current">'; /* tag before the current crumb */
        $after = '</span>'; /* tag after the current crumb */

        global $wp_rewrite, $post;

        $rewriteUrl = $wp_rewrite->using_permalinks();

        if( !is_home() && !is_front_page() || is_paged() ){

            $output .= '<span class="breadcrumb-links">';
     
            $homeLink = esc_url( home_url('/') ); 
            $output .= '<a href="' . $homeLink . '">' . $ar_title['home'] . '</a> ' . $delimiter . ' ';
     
            if( is_category() ){
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if( $thisCat->parent != 0 ){ 
                    $output .= get_category_parents($parentCat, true, ' ' . $delimiter . ' ');
                }
                $output .= $before . single_cat_title('', false) . $after;
            }
            elseif( is_search() ){
                $output .= $before . $ar_title['search'] . '"' . get_search_query() . '"' . $after;
            }elseif( is_day() ){
                $output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                $output .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                $output .= $before . get_the_time('d') . $after;
            }elseif( is_month() ){
                $output .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                $output .= $before . get_the_time('F') . $after;
            }elseif( is_year() ){
                $output .= $before . get_the_time('Y') . $after;
            }elseif( is_single() && !is_attachment() ){
                if( get_post_type() != 'post' ){
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $post_type_name = $post_type->labels->singular_name;
                    if( $rewriteUrl ){
                        $output .= '<a href="' . $homeLink . $slug['slug'] . '/' . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }else{
                        $output .= '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }
                    $output .= $before . get_the_title() . $after;
                }else{
                    $cat = get_the_category(); $cat = $cat[0];
                    $output .= get_category_parents($cat, true, ' ' . $delimiter . ' ');
                    $output .= $before . get_the_title() . $after;
                }
            }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                $post_type_name = $post_type->labels->singular_name;
                if( is_tag() ){
                    $output .= $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
                }
                elseif( is_taxonomy_hierarchical(get_query_var('taxonomy')) ){
                    if( $rewriteUrl ){
                        $output .= '<a href="' . $homeLink . $slug['slug'] . '/' . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }else{
                        $output .= '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }           
                    
                    $curTaxanomy = get_query_var('taxonomy');
                    $curTerm = get_query_var( 'term' );
                    $termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
                    $pushPrintArr = array();
                    if( $termNow !== false ){
                        while( (int)$termNow->parent != 0 ){
                            $parentTerm = get_term((int)$termNow->parent,get_query_var('taxonomy'));
                            array_push($pushPrintArr,'<a href="' . get_term_link((int)$parentTerm->term_id,$curTaxanomy) . '">' . $parentTerm->name . '</a> ' . $delimiter . ' ');
                            $curTerm = $parentTerm->name;
                            $termNow = get_term_by( 'name', $curTerm, $curTaxanomy );
                        }
                    }
                    $pushPrintArr = array_reverse($pushPrintArr);
                    array_push($pushPrintArr,$before  . get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) )->name  . $after);
                    $output .= implode($pushPrintArr);
                }else{
                    $output .= $before . $post_type_name . $after;
                }
            }elseif( is_attachment() ){
                if( (int)$post->post_parent > 0 ){
                    $parent = get_post($post->post_parent);
                    $cat = get_the_category($parent->ID);
                    if( count($cat) > 0 ){
                        $cat = $cat[0];
                        $output .= get_category_parents($cat, true, ' ' . $delimiter . ' ');
                    }
                    $output .= '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
                }
                $output .= $before . get_the_title() . $after;
            }elseif( is_page() && !$post->post_parent ){
                $output .= $before . get_the_title() . $after;
            }elseif( is_page() && $post->post_parent ){
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while( $parent_id ){
                    $page = get_post($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach( $breadcrumbs as $crumb ){
                    $output .= $crumb . ' ' . $delimiter . ' ';
                }
                $output .= $before . get_the_title() . $after;
            }elseif( is_tag() ){
                $output .= $before . $ar_title['tagged'] . '"' . single_tag_title('', false) . '"' . $after;
            }elseif( is_author() ){
                global $author;
                $userdata = get_userdata($author);
                $output .= $before . $ar_title['author'] . $userdata->display_name . $after;
            }elseif( is_404() ){
                $output .= $before . $ar_title['404'] . $after;
            }
            if( get_query_var('paged') || get_query_var('page') ){
                if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
                    $output .= $before .' ('; 
                }
                $output .= $ar_title['page'] . ' ' . ( get_query_var('paged')?get_query_var('paged'):get_query_var('page') );
                if( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() ||  is_post_type_archive() || is_archive() ){ 
                    $output .= ')'. $after; 
                }
            }
            $output .= '</span>';
        }
        
        echo wp_kses($output, $allowed_html);
        
        wp_reset_postdata();
    }
}

if ( ! function_exists( 'shop2u_get_media_url' ) ) {
    function shop2u_get_media_url( $media = array(), $size = 'full' ) {

        $media = wp_parse_args( $media, array('url' => '', 'id' => '') );
        $url = '';

        if ($media['id'] != '') {
            if ( strpos( get_post_mime_type( $media['id'] ), 'image' ) !== false ) {
                $image = wp_get_attachment_image_src( $media['id'],  $size );
                if ( $image ){
                    $url = $image[0];
                }
            } else {
                $url = wp_get_attachment_url( $media['id'] );
            }
        }

        if ($url == '' && $media['url'] != '') {
            $id = attachment_url_to_postid( $media['url'] );
            if ( $id ) {
                if ( strpos( get_post_mime_type( $id ), 'image' ) !== false ) {
                    $image = wp_get_attachment_image_src( $id,  $size );
                    if ( $image ){
                        $url = $image[0];
                    }
                } else {
                    $url = wp_get_attachment_url( $id );
                }
            } else {
                $url = $media['url'];
            }
        }
        return $url;
    }
}

function shop2u_above_left_data(){
    $items = get_theme_mod('shop2u_topbar_left_content');

    if(is_string($items)){
        $items = json_decode($items);
    }

    if ( empty( $items ) || !is_array( $items ) ) {
        $items = array();
    }

    $val = array();
    if (!empty($items) && is_array($items)) {
        foreach ($items as $k => $v) {
            $val[] = wp_parse_args($v,array(
                    'title' => '',
                    ));
        }
    }else{
        $val = shop2u_above_left_default_data();
    }

    return $val;
}

function shop2u_above_right_data(){
    $items = get_theme_mod('shop2u_topbar_right_content');

    if(is_string($items)){
        $items = json_decode($items);
    }

    if ( empty( $items ) || !is_array( $items ) ) {
        $items = array();
    }

    $val = array();
    if (!empty($items) && is_array($items)) {
        foreach ($items as $k => $v) {
            $val[] = wp_parse_args($v,array(
                    'icon' => 'fa fa-phone',
                    'title' => '',
                    ));
        }
    }else{
        $val = shop2u_above_right_default_data();
    }

    return $val;
}

function shop2u_homepage_slider_data(){
    $items = get_theme_mod('shop2u_slider_content');

    if(is_string($items)){
        $items = json_decode($items);
    }

    if ( empty( $items ) || !is_array( $items ) ) {
        $items = array();
    }

    $val = array();
    if (!empty($items) && is_array($items)) {
        foreach ($items as $k => $v) {
            $val[] = wp_parse_args($v,array(
                    'image' => array(
                        'url'=>get_template_directory_uri().'/img/slide-01.png',
                    ),
                    'subtitle' => 'Sale Upto 50% OFF',
                    'title' => 'New Brand Collection',
                    'desc' => 'Lorem ipsum dolor sit amet consectetur adipiscing elited do niam.',
                    'button1_label' => 'Shop Now',
                    'button1_link' => '#',
                    'button1_target' => false,
                    'button2_label' => 'Discover',
                    'button2_link' => '#',
                    'button2_target' => false,
                    ));
        }
    }else{
        $val = shop2u_homepage_slider_default_data();
    }

    return $val;
}

function shop2u_homepage_slider_left_content_data(){
    $items = get_theme_mod('shop2u_slider_left_content');

    if(is_string($items)){
        $items = json_decode($items);
    }

    if ( empty( $items ) || !is_array( $items ) ) {
        $items = array();
    }

    $val = array();
    if (!empty($items) && is_array($items)) {
        foreach ($items as $k => $v) {
            $val[] = wp_parse_args($v,array(
                    'image' => array(
                        'url'=>get_template_directory_uri().'/img/slide-04.png',
                    ),
                    'subtitle' => 'Fashion',
                    'title' => 'Women Collection',
                    'desc' => 'Sale Upto 50% OFF',
                    'button_label' => 'Shop Now',
                    'button_link' => '#',
                    'button_target' => false,
                    ));
        }
    }else{
        $val = shop2u_homepage_slider_left_content_default_data();
    }

    return $val;
}

function shop2u_homepage_banner_data(){
    $items = get_theme_mod('shop2u_banner_content');

    if(is_string($items)){
        $items = json_decode($items);
    }

    if ( empty( $items ) || !is_array( $items ) ) {
        $items = array();
    }

    $val = array();
    if (!empty($items) && is_array($items)) {
        foreach ($items as $k => $v) {
            $val[] = wp_parse_args($v,array(
                    'image' => array(
                        'url'=>get_template_directory_uri().'/img/banner/banner-01.jpg',
                    ),
                    'subtitle' => 'New Sale on',
                    'title' => 'Women Collection',
                    'desc' => 'Sale Upto 50% OFF',
                    'align' => 'left',
                    'button_label' => 'Shop Now',
                    'button_link' => '#',
                    'button_target' => false,
                    ));
        }
    }else{
        $val = shop2u_homepage_banner_default_data();
    }

    return $val;
}

function shop2u_homepage_testimonial_data(){
    $items = get_theme_mod('shop2u_testimonial_content');

    if(is_string($items)){
        $items = json_decode($items);
    }

    if ( empty( $items ) || !is_array( $items ) ) {
        $items = array();
    }

    $val = array();
    if (!empty($items) && is_array($items)) {
        foreach ($items as $k => $v) {
            $val[] = wp_parse_args($v,array(
                    'image' => array(
                        'url'=>get_template_directory_uri().'/img/testimonial/testi-01.png',
                    ),
                    'title' => 'Jackline Wiliam',
                    'position' => 'Co-Founder',
                    'desc' => 'Love the conience of Shop2u and the uber friendly service. The produce is always fresh and the meat department is first class.Until recently.',
                    'rating' => 5,
                    ));
        }
    }else{
        $val = shop2u_homepage_testimonial_default_data();
    }

    return $val;
}

function shop2u_footer_above_data(){
    $items = get_theme_mod('shop2u_footer_above_content');

    if(is_string($items)){
        $items = json_decode($items);
    }

    if ( empty( $items ) || !is_array( $items ) ) {
        $items = array();
    }

    $val = array();
    if (!empty($items) && is_array($items)) {
        foreach ($items as $k => $v) {
            $val[] = wp_parse_args($v,array(
                    'image' => array(
                        'url'=>get_template_directory_uri().'/img/footer/delivery-truck.png',
                    ),
                    'title' => 'Free Shipping',
                    'desc' => 'On all US order or order above $99',
                    ));
        }
    }else{
        if( function_exists('shop2u_footer_above_default_data')){
            $val = shop2u_footer_above_default_data();
        }        
    }

    return $val;
}

if ( ! function_exists( 'shop2u_edit_link' ) ) :
    function shop2u_edit_link() {
        edit_post_link(
            sprintf(
                /* translators: %s: Post title. */
                __( 'Edit<span class="screen-reader-text"> "%s"</span>', 'shop2u' ),
                get_the_title()
            ),
            '<div class="edit-link">',
            '</div>'
        );
    }
endif;


/*** Get excerpt ***/
if( !function_exists ('shop2u_string_limit_words') ){
    function shop2u_string_limit_words($string, $word_limit){
        $words = explode(' ', $string, ($word_limit + 1));
        if( count($words) > $word_limit ){
            array_pop($words);
        }
        return implode(' ', $words);
    }
}

if( !function_exists ('shop2u_the_excerpt_max_words') ){
    function shop2u_the_excerpt_max_words( $word_limit = -1, $post = '', $strip_tags = true, $extra_str = '', $echo = true ) {
        if( $post ){
            $excerpt = shop2u_get_the_excerpt_by_id($post->ID);
        }
        else{
            $excerpt = get_the_excerpt();
        }
            
        if( !is_array($strip_tags) && $strip_tags ){
            $excerpt = wp_strip_all_tags($excerpt);
            $excerpt = strip_shortcodes($excerpt);
        }
        
        if( is_array($strip_tags) ){
            $excerpt = wp_kses($excerpt, $strip_tags); // allow, not strip
        }
            
        if( $word_limit != -1 ){
            $result = shop2u_string_limit_words($excerpt, $word_limit);
            if( $result != $excerpt ){
                $result .= $extra_str;
            }
        }   
        else{
            $result = $excerpt;
        }
            
        if( $echo ){
            echo do_shortcode($result);
        }
        return $result;
    }
}

if( !function_exists('shop2u_get_the_excerpt_by_id') ){
    function shop2u_get_the_excerpt_by_id( $post_id = 0 ){
        global $wpdb;
        $query = "SELECT post_excerpt, post_content FROM $wpdb->posts WHERE ID = %d LIMIT 1";
        $result = $wpdb->get_results( $wpdb->prepare($query, $post_id), ARRAY_A );
        if( $result[0]['post_excerpt'] ){
            return $result[0]['post_excerpt'];
        }
        else{
            $content = $result[0]['post_content'];
            if( false !== strpos( $content, '<!--nextpage-->' ) ){
                $pages = explode( '<!--nextpage-->', $content );
                return $pages[0];
            }
            return $content;
        }
    }
}

/**
 * Custom excerpt length
 */
if ( ! function_exists( 'shop2u_custom_excerpt_length' ) ) :
    add_filter( 'excerpt_length', 'shop2u_custom_excerpt_length', 100);
    function shop2u_custom_excerpt_length( $length ) {
        return absint( apply_filters( 'shop2u_excerpt_length', $length ) );
    }
endif;

/**
 * Remove […]
 */
if ( ! function_exists( 'shop2u_new_excerpt_more' ) ) :
    add_filter('excerpt_more', 'shop2u_new_excerpt_more', 15 );
    function shop2u_new_excerpt_more( $more ) {
        global $post;

        $excerpt_readmore = __('Read More','shop2u');        
        return apply_filters( 'shop2u_excerpt_more_output', sprintf(
            '... <div><a class="more-link btn btn-primary main-btn ml-3 mb-3" href="%s">%1s</a></div>',
            esc_url( get_the_permalink() ),
            $excerpt_readmore
            ) );
    }
endif;

/* Content Read More */

if ( ! function_exists( 'shop2u_blog_content_more' ) ) :
    add_filter( 'the_content_more_link', 'shop2u_blog_content_more', 15 );
    function shop2u_blog_content_more( $more ) {
        global $post;
        $excerpt_readmore = __('Read More','shop2u');

        return apply_filters( 'shop2u_content_more_link_output', sprintf( '<div><a title="%1$s" class="more-link btn btn-primary main-btn ml-3 mb-3" href="%2$s">%3$s%4$s</a></div>',
            the_title_attribute( 'echo=0' ),
            esc_url( get_permalink( get_the_ID() ) . apply_filters( 'shop2u_more_jump','#more-' . get_the_ID() ) ),
            wp_kses_post( $excerpt_readmore ),
            '<span class="screen-reader-text">' . get_the_title() . '</span>'
        ) );
    }
endif;

// Content starter pack data
function shop2u_wp_starter_pack() {

    // Define and register starter contents

    $starter_content = array(
        'widgets'     => array(
            'sidebar-1'   => array(
                'search',
                'categories',
                'tag',
                'meta',
            ),
            'footer-1'    => array(
                'my_text' => array(
                    'text',
                    array(
                        'title' => _x('About US', 'My text starter contents', 'shop2u'),
                        'text'  =>  _x('Lorem ipsum dolor sit amet consectetur dipisicing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua Ut enim ad minim veniam.', 'My text starter contents', 'shop2u'),
                    ),
                ),
            ),
            'footer-2'    => array(
                'search' => array(
                    'search',
                    array(
                        'title' => _x( 'search', 'My text starter contents', 'shop2u' ),
                    )
                ),
            ),
            'footer-3'    => array(
                'categories'=> array(
                    'categories',
                    array(
                        'title' => _x( 'categories', 'My text starter contents', 'shop2u' ),
                    )
                ),
            ),
        ),
        'posts'       => array(
            'home',
            'about',
            'contact',
            'blog',
        ),
        'options'     => array(
            'show_on_front'  => 'page',
            'page_on_front'  => '{{home}}',
            'page_for_posts' => '{{blog}}',
            'header_image'   => '',
        ),
        'nav_menus'   => array(
            'primary'    => array(
                'name'  => __( 'Primary Menu', 'shop2u' ),
                'items' => array(
                    'link_home',
                    'page_about',
                    'page_blog',
                    'page_contact',
                    'page_loremuipsum' => array(
                        'type'      => 'post_type',
                        'object'    => 'page',
                        'object_id' => '{{loremipsum}}',
                    ),
                ),
            ),
        ),
    );

    return apply_filters( 'shop2u_wp_starter_pack', $starter_content );
}

// Get Started Notice

add_action( 'wp_ajax_shop2u_dismissed_notice_handler', 'shop2u_ajax_notice_handler' );
function shop2u_ajax_notice_handler() {
    if ( isset( $_POST['type'] ) ) {
        $type = sanitize_text_field( wp_unslash( $_POST['type'] ) );
        update_option( 'dismissed-' . $type, TRUE );
    }
}

function shop2u_deprecated_hook_admin_notice() {
        if ( ! get_option('dismissed-get_started', FALSE ) ) {
            ?>
            <div class="updated notice notice-get-started-class is-dismissible" data-notice="get_started">
                <div class="shop2u-getting-started-notice clearfix">
                    <div class="shop2u-theme-screenshot">
                        <img src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png" class="screenshot" alt="<?php esc_attr_e( 'Theme Screenshot', 'shop2u' ); ?>" />
                    </div>
                    <div class="shop2u-theme-notice-content">
                        <h2 class="shop2u-notice-h2">
                            <?php
                        printf(
                            /* translators: 1: welcome page link starting html tag, 2: welcome page link ending html tag. */
                            esc_html__( 'Welcome! Thank you for choosing %1$s!', 'shop2u' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>' );
                        ?>
                        </h2>

                        <p class="plugin-install-notice"><?php echo sprintf(__('Install and activate <strong>Britetechs Companion</strong> plugin for taking full advantage of all the features this theme has to offer.', 'shop2u')) ?></p>

                        <a class="shop2u-btn-get-started button button-primary button-hero shop2u-button-padding" href="#" data-name="" data-slug=""><?php _e( 'Get started with Shop2u', 'shop2u' ) ?></a><span class="shop2u-push-down">
                        <?php
                            /* translators: %1$s: Anchor link start %2$s: Anchor link end */
                            printf(
                                'or %1$sCustomize theme%2$s</a></span>',
                                '<a target="_blank" href="' . esc_url( admin_url( 'customize.php' ) ) . '">',
                                '</a>'
                            );
                        ?>
                    </div>
                </div>
            </div>
        <?php }
}
add_action( 'admin_notices', 'shop2u_deprecated_hook_admin_notice' );

// Plugin Installer

function shop2u_admin_install_plugin() {

    include_once ABSPATH . '/wp-admin/includes/file.php';
    include_once ABSPATH . '/wp-admin/includes/class-wp-upgrader.php';
    include_once ABSPATH . '/wp-admin/includes/plugin-install.php';

    if ( ! file_exists( WP_PLUGIN_DIR . '/britetechs-companion' ) ) {
        $api = plugins_api( 'plugin_information', array(
            'slug'   => sanitize_key( wp_unslash( 'britetechs-companion' ) ),
            'fields' => array(
                'sections' => false,
            ),
        ) );

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );
    }

    // Activate plugin.
    if ( current_user_can( 'activate_plugin' ) ) {
        $result = activate_plugin( 'britetechs-companion/britetechs-companion.php' );
    }
}
add_action( 'wp_ajax_install_act_plugin', 'shop2u_admin_install_plugin' );