<?php
/**
 * This is the main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Shop2u
 * 
 * @since Shop2u 0.1
 */

get_header(); 
get_template_part('template-parts/section-breadcrumbs');
?>
<section class="section blog-right-section ">
	<div class="container">
		<div class="row">
			<div class="col-xl-<?php if ( !is_active_sidebar( 'sidebar-1' ) ){ echo '12'; }else{ echo '8'; } ?> col-lg-<?php if ( !is_active_sidebar( 'sidebar-1' ) ){ echo '12'; }else{ echo '8'; } ?> col-md-12">

				<?php
            	// Check if posts exist
				if ( have_posts() ) :

					// loop
					while ( have_posts() ) : the_post();

						get_template_part('template-parts/entry/layout','page');

					endwhile;

					the_posts_pagination( array(
                                'prev_text' => '<i class="fa fa-angle-double-left"></i>',
                                'next_text' => '<i class="fa fa-angle-double-right"></i>',
                            ) );

					// If comments are open or we have at least one comment, load up the comment template.
                    if ( comments_open() || get_comments_number() ) :
                        comments_template();
                    endif;

				else:

					get_template_part('template-parts/entry/layout','none');

				endif;
            	?>

			</div><!-- .col-xl-8 -->

			<?php 
            // woocommerce
            if ( 
                class_exists('woocommerce') && is_woocommerce() || 
                class_exists('woocommerce') && is_shop() || 
                class_exists('woocommerce') && is_cart() || 
                class_exists('woocommerce') && is_product() || 
                class_exists('woocommerce') && is_checkout() || 
                class_exists('woocommerce') && is_account_page() 
            ){
                get_sidebar('woocommerce');
            } else {
                get_sidebar();
            } 
            ?>

		</div><!-- .row -->
	</div><!-- .container -->
</section>
<?php get_footer(); ?>