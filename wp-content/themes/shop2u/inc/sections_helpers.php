<?php

// Blog
if( ! function_exists('shop2u_blog_section') ){
	function shop2u_blog_section(){
		get_template_part('template-parts/sections-homepage/section','blog');
	}

	$section_priority = apply_filters( 'shop2u_section_priority', 60, 'shop2u_blog_section' );
	if(isset($section_priority) && $section_priority != '' ){
		add_action('shop2u_sections','shop2u_blog_section', absint($section_priority));
	}
}