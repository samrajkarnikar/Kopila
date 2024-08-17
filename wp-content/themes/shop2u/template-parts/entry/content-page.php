<div class="entry-content">
    <?php 
    global $post;

    the_content();

    if( get_post_format() === false || get_post_format() == 'standard' ){

        wp_link_pages( array(
                        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shop2u' ),
                        'after'  => '</div>',
                    ) );

    }

    shop2u_edit_link();
    ?>
</div>