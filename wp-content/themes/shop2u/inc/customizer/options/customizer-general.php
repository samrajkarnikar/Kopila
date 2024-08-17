<?php
function shop2u_customizer_general( $wp_customize ){
	
	global $shop2u_options;

	// Shop2u General Panel
	$wp_customize->add_panel( 'shop2u_general',
		array(
			'priority'       => 31,
			'capability'     => 'edit_theme_options',
			'title'          => esc_html__('Shop2u Global','shop2u'),
		)
	);

		// Header Breadcrumb
		$wp_customize->add_section( 'section_breadcrumb',
			array(
				'priority'    => 2,
				'title'       => esc_html__('Breadcrumbs','shop2u'),
				'panel'       => 'shop2u_general',
			)
		);

			// shop2u_breadcrumb_disable
			$wp_customize->add_setting('shop2u_breadcrumb_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_breadcrumb_disable'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_breadcrumb_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide breadcrumb section?', 'shop2u'),
					'section'     => 'section_breadcrumb',
				)
			);

			$wp_customize->add_setting('shop2u_breadcrumb_bg_color', 
				array(
				'default'    => $shop2u_options['shop2u_breadcrumb_bg_color'],
				'sanitize_callback' => 'sanitize_text_field',
				'priority'          => 4,
				)
			);
			$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize,'shop2u_breadcrumb_bg_color', 
				array(
				'label' => __('Background Color','shop2u'),
				'section' => 'section_breadcrumb',
				'settings'=>'shop2u_breadcrumb_bg_color'
			) ) );			

			// shop2u_breadcrumb_height
			$wp_customize->add_setting('shop2u_breadcrumb_height',
					array(
						'sanitize_callback' => 'shop2u_sanitize_range_value',
						'priority'          => 11,
						'transport'         => 'postMessage',
					)
				);
			$wp_customize->add_control(new Shop2u_Range_Control($wp_customize,'shop2u_breadcrumb_height',
				array(
					'label' 		=> esc_html__('Breadcrumb Section Height', 'shop2u'),
					'section' 		=> 'section_breadcrumb',
					'type'          => 'range-value',
					'media_query'   => true,
                    'input_attr' => array(
                        'mobile' => array(
                            'min' => 100,
                            'max' => 1024,
                            'step' => 1,
                            'default_value' => $shop2u_options['shop2u_breadcrumb_height'],
                        ),
                        'tablet' => array(
                            'min' => 100,
                            'max' => 1024,
                            'step' => 1,
                            'default_value' => $shop2u_options['shop2u_breadcrumb_height'],
                        ),
                        'desktop' => array(
                            'min' => 100,
                            'max' => 1024,
                            'step' => 1,
                            'default_value' => $shop2u_options['shop2u_breadcrumb_height'],
                        ),
                    ),
				)
			) );

		// BackTotop Button
		$wp_customize->add_section( 'section_backtotop',
			array(
				'priority'    => 3,
				'title'       => esc_html__('Back To Top','shop2u'),
				'panel'       => 'shop2u_general',
			)
		);

			// shop2u_backTotop_disable
			$wp_customize->add_setting('shop2u_backTotop_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_backTotop_disable'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_backTotop_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide back to top button?', 'shop2u'),
					'section'     => 'section_backtotop',
				)
			);

		// Single Page
		$wp_customize->add_section( 'section_single_page',
			array(
				'priority'    => 4,
				'title'       => esc_html__('Single Page','shop2u'),
				'panel'       => 'shop2u_general',
			)
		);

			// shop2u_page_title_disable
			$wp_customize->add_setting('shop2u_page_title_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_page_title_disable'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_page_title_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide Page Title?', 'shop2u'),
					'section'     => 'section_single_page',
				)
			);
}
add_action('customize_register','shop2u_customizer_general');