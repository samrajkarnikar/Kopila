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

<?php do_action('shop2u_main_content_before'); ?>

<section class="section blog-right-section">

	<?php do_action('shop2u_main_content_inner_before'); ?>

	<div class="container">
		<div class="row">
			<div class="col-xl-<?php if ( !is_active_sidebar( 'woocommerce' ) ){ echo '12'; }else{ echo '8'; } ?> col-lg-<?php if ( !is_active_sidebar( 'woocommerce' ) ){ echo '12'; }else{ echo '8'; } ?> col-md-12">

				<?php do_action('shop2u_content_before'); ?>

				<?php woocommerce_content(); ?>

				<?php do_action('shop2u_content_after'); ?>

			</div><!-- .col-xl-8 -->

			<?php get_sidebar('woocommerce'); ?>

		</div><!-- .row -->
	</div><!-- .container -->

	<?php do_action('shop2u_main_content_inner_after'); ?>

</section>

<?php do_action('shop2u_main_content_after'); ?>

<?php get_footer(); ?>