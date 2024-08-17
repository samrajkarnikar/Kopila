<div class="entry-content">
    <?php 
    global $post;

    if( ( is_home() || is_archive() || is_search() || is_page_template() ) ){
        the_excerpt();
    }else{
        the_content();
    }

    if( get_post_format() === false || get_post_format() == 'standard' ){

        wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shop2u' ),
                        'after'  => '</div>',
                    ) );

    }

    shop2u_edit_link();
    ?>
</div>