<?php

if( ! function_exists('shop2u_footer_section') ){
	function shop2u_footer_section(){
		get_template_part('template-parts/footer/section','footer');
	}
	add_action('shop2u_footer','shop2u_footer_section', 1);
}

if( ! function_exists('shop2u_footer_main_section') ){
	function shop2u_footer_main_section(){
		get_template_part('template-parts/footer/section','main');
	}
	add_action('shop2u_footer_area','shop2u_footer_main_section', 10);
}

if( ! function_exists('shop2u_footer_copyright_section') ){
	function shop2u_footer_copyright_section(){
		get_template_part('template-parts/footer/section','copyright');
	}
	add_action('shop2u_footer_area','shop2u_footer_copyright_section', 15);
}

if( ! function_exists('shop2u_back_to_top_section') ){
	function shop2u_back_to_top_section(){
		get_template_part('template-parts/footer/section','backtotop');
	}
	add_action('shop2u_footer','shop2u_back_to_top_section', 20);
}