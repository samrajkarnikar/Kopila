<?php
function shop2u_customizer_header( $wp_customize ){

	global $shop2u_options;

	// Shop2u Header Panel
	$wp_customize->add_panel( 'shop2u_header',
		array(
			'priority'       => 30,
			'capability'     => 'edit_theme_options',
			'title'          => esc_html__('Shop2u Header','shop2u'),
		)
	);
		// Site identity
        $wp_customize->add_section('title_tagline',
            array(
                'priority'     => 1,
                'title'        => __('Site Identity','shop2u'),
                'panel'        => 'shop2u_header',
            )
        );

        	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

        	// shop2u_h_logo_width
			$wp_customize->add_setting('shop2u_h_logo_width',
					array(
						'sanitize_callback' => 'shop2u_sanitize_range_value',
						'priority'          => 6,
						'transport'         => 'postMessage',
					)
				);
			$wp_customize->add_control(new Shop2u_Range_Control($wp_customize,'shop2u_h_logo_width',
				array(
					'label' 		=> esc_html__('Logo Width', 'shop2u'),
					'section' 		=> 'title_tagline',
					'type'          => 'range-value',
					'media_query'   => true,
                    'input_attr' => array(
                        'mobile' => array(
                            'min' => 10,
                            'max' => 300,
                            'step' => 1,
                            'default_value' => $shop2u_options['shop2u_h_logo_width'],
                        ),
                        'tablet' => array(
                            'min' => 10,
                            'max' => 300,
                            'step' => 1,
                            'default_value' => $shop2u_options['shop2u_h_logo_width'],
                        ),
                        'desktop' => array(
                            'min' => 10,
                            'max' => 300,
                            'step' => 1,
                            'default_value' => $shop2u_options['shop2u_h_logo_width'],
                        ),
                    ),
				)
			) );

		// Header Above Section
		$wp_customize->add_section( 'header_above',
			array(
				'priority'    => 2,
				'title'       => esc_html__('Header Above','shop2u'),
				'panel'       => 'shop2u_header',
			)
		);
			// shop2u_topbar_disable
			$wp_customize->add_setting('shop2u_topbar_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_topbar_disable'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_topbar_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide header topbar?', 'shop2u'),
					'section'     => 'header_above',
				)
			);			

		// Header Middle Section
		$wp_customize->add_section( 'header_middle',
			array(
				'priority'    => 3,
				'title'       => esc_html__('Header Middle','shop2u'),
				'panel'       => 'shop2u_header',
			)
		);

			// shop2u_bottom_r_icon
			$wp_customize->add_setting('shop2u_bottom_r_icon',
					array(
						'sanitize_callback' => 'sanitize_text_field',
						'default'           => $shop2u_options['shop2u_bottom_r_icon'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control(new Shop2u_Iconpicker_Control($wp_customize,'shop2u_bottom_r_icon',
				array(
					'label'       => esc_html__('Icon', 'shop2u'),
					'section'     => 'header_middle',
				)
			) );

			// shop2u_bottom_r_title
			$wp_customize->add_setting('shop2u_bottom_r_title',
					array(
						'sanitize_callback' => 'sanitize_text_field',
						'default'           => $shop2u_options['shop2u_bottom_r_title'],
						'priority'          => 2,
					)
				);
			$wp_customize->add_control('shop2u_bottom_r_title',
				array(
					'type'        => 'text',
					'label'       => esc_html__('Title', 'shop2u'),
					'section'     => 'header_middle',
				)
			);

			// shop2u_bottom_r_desc
			$wp_customize->add_setting('shop2u_bottom_r_desc',
					array(
						'sanitize_callback' => 'wp_kses_post',
						'default'           => $shop2u_options['shop2u_bottom_r_desc'],
						'priority'          => 3,
					)
				);
			$wp_customize->add_control('shop2u_bottom_r_desc',
				array(
					'type'        => 'textarea',
					'label'       => esc_html__('Description', 'shop2u'),
					'section'     => 'header_middle',
				)
			);

		// Header Bottom Section
		$wp_customize->add_section( 'header_bottom',
			array(
				'priority'    => 4,
				'title'       => esc_html__('Header Bottom','shop2u'),
				'panel'       => 'shop2u_header',
			)
		);

			// shop2u_bottom_category_label
			$wp_customize->add_setting('shop2u_bottom_category_label',
					array(
						'sanitize_callback' => 'sanitize_text_field',
						'default'           => $shop2u_options['shop2u_bottom_category_label'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_bottom_category_label',
				array(
					'type'        => 'text',
					'label'       => esc_html__('Category Dropdown Label', 'shop2u'),
					'section'     => 'header_bottom',
				)
			);

			// shop2u_bottom_category_more_label
			$wp_customize->add_setting('shop2u_bottom_category_more_label',
					array(
						'sanitize_callback' => 'sanitize_text_field',
						'default'           => $shop2u_options['shop2u_bottom_category_more_label'],
						'priority'          => 2,
					)
				);
			$wp_customize->add_control('shop2u_bottom_category_more_label',
				array(
					'type'        => 'text',
					'label'       => esc_html__('Category Dropdown Load More Label', 'shop2u'),
					'section'     => 'header_bottom',
				)
			);

			// shop2u_bottom_category_no_more_label
			$wp_customize->add_setting('shop2u_bottom_category_no_more_label',
					array(
						'sanitize_callback' => 'sanitize_text_field',
						'default'           => $shop2u_options['shop2u_bottom_category_no_more_label'],
						'priority'          => 3,
					)
				);
			$wp_customize->add_control('shop2u_bottom_category_no_more_label',
				array(
					'type'        => 'text',
					'label'       => esc_html__('Category Dropdown No More Label', 'shop2u'),
					'section'     => 'header_bottom',
				)
			);

			// shop2u_middle_user_icon_disable
			$wp_customize->add_setting('shop2u_middle_user_icon_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_middle_user_icon_disable'],
						'priority'          => 4,
					)
				);
			$wp_customize->add_control('shop2u_middle_user_icon_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide user icon?', 'shop2u'),
					'section'     => 'header_bottom',
				)
			);

			// shop2u_middle_cart_icon_disable
			$wp_customize->add_setting('shop2u_middle_cart_icon_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_middle_cart_icon_disable'],
						'priority'          => 7,
					)
				);
			$wp_customize->add_control('shop2u_middle_cart_icon_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide cart icon?', 'shop2u'),
					'section'     => 'header_bottom',
				)
			);			

		// Header Sticky
		$wp_customize->add_section( 'header_sticky',
			array(
				'priority'    => 5,
				'title'       => esc_html__('Header Sticky','shop2u'),
				'panel'       => 'shop2u_header',
			)
		);

			// shop2u_h_sticky_disable
			$wp_customize->add_setting('shop2u_h_sticky_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_h_sticky_disable'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_h_sticky_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide sticky header?','shop2u'),
					'section'     => 'header_sticky',
				)
			);
}
add_action('customize_register','shop2u_customizer_header');