<?php
/**
 * Template Name: Page-Fullwidth
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
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

			<div class="col-12">

				<?php
            	// Check if posts exist
				if ( have_posts() ) :

					// loop
					while ( have_posts() ) : the_post();

						echo get_post_format();

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

		</div><!-- .row -->
	</div><!-- .container -->
</section>
<?php get_footer(); ?>