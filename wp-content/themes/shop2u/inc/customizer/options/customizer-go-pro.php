<?php

function shop2u_for_plus( $wp_customize ){
		
		$wp_customize->register_section_type( 'Shop2u_Section_Plus' );
		$wp_customize->add_section( new Shop2u_Section_Plus( $wp_customize, 'plus-shop2u' , array(
			'title'    => esc_html__( 'Upgrade To Pro', 'shop2u' ),
			'plus_text' => esc_html__( 'Click Here', 'shop2u' ),
			'plus_url'  => 'https://www.britetechs.com/theme/shop2u-pro/',
			'priority'     => 42,
		) ) );
}
add_action( 'customize_register', 'shop2u_for_plus' );