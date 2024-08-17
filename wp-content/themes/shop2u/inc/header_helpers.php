<?php

if( ! function_exists('shop2u_header_section') ){
	function shop2u_header_section(){
		get_template_part('template-parts/header/section','header');
	}
	add_action('shop2u_header','shop2u_header_section', 1);
}

if( ! function_exists('shop2u_header_middle_section') ){
	function shop2u_header_middle_section(){
		get_template_part('template-parts/header/section','middle');
	}
	add_action('shop2u_header_area','shop2u_header_middle_section', 10);
}

if( ! function_exists('shop2u_header_navigation_section') ){
	function shop2u_header_navigation_section(){
		get_template_part('template-parts/header/section','navigation');
	}
	add_action('shop2u_header_area','shop2u_header_navigation_section', 15);
}