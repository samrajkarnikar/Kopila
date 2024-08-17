<?php 
/**
 * Template Name: Home Page
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Shop2u
 * 
 * @since Shop2u 0.1
 */
if ( is_page_template() ) {
	get_header();
		do_action('shop2u_sections',false);
	get_footer();
}
?>