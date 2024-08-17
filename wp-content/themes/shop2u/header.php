<?php 
/**
 * The header for the shop2u theme
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Shop2u
 * 
 * @since Shop2u 0.1
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link rel="profile" href="https://gmpg.org/xfn/11">
  	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<?php 
	    if ( function_exists('wp_body_open') ) {
	      wp_body_open();
	    }else{
	      do_action('wp_body_open');
	    }
    ?>
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content','shop2u'); ?></a>

    <?php do_action('shop2u_site_before'); ?>

	<div class="page-wrapper">

		<?php do_action( 'shop2u_site_inner_before' ); ?>

		<?php do_action('shop2u_header'); ?>		