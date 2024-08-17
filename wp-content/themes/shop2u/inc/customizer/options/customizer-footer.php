<?php
function shop2u_customizer_footer( $wp_customize ){

	global $shop2u_options;

	// Shop2u Footer Panel
	$wp_customize->add_panel( 'shop2u_footer',
		array(
			'priority'       => 32,
			'capability'     => 'edit_theme_options',
			'title'          => esc_html__('Shop2u Footer','shop2u'),
		)
	);

		// Above
		$wp_customize->add_section( 'footer_above',
			array(
				'priority'    => 1,
				'title'       => esc_html__('Footer Above','shop2u'),
				'panel'       => 'shop2u_footer',
			)
		);

			// shop2u_footer_above_disable
			$wp_customize->add_setting('shop2u_footer_above_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_footer_above_disable'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_footer_above_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide above footer?', 'shop2u'),
					'section'     => 'footer_above',
				)
			);		
			

		// Middle
		$wp_customize->add_section( 'footer_middle',
			array(
				'priority'    => 2,
				'title'       => esc_html__('Footer Middle','shop2u'),
				'panel'       => 'shop2u_footer',
			)
		);

			// shop2u_footer_middle_columns
			$wp_customize->add_setting('shop2u_footer_middle_columns',
					array(
						'sanitize_callback' => 'shop2u_sanitize_select',
						'default'           => $shop2u_options['shop2u_footer_middle_columns'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_footer_middle_columns',
				array(
					'type'        => 'select',
					'label'       => esc_html__('Widgets Column Layout', 'shop2u'),
					'section'     => 'footer_middle',
					'choices' => array(
						'4' => 4,
						'3' => 3,
						'2' => 2,
						'1' => 1,
						'0' => esc_html__('Disable footer widgets', 'shop2u'),
					),
				)
			);

			for ( $i = 1; $i<=4; $i ++ ) {
				$df = 12;
				if ( $i > 1 ) {
					$_n = 12/$i;
					$df = array();
					for ( $j = 0; $j < $i; $j++ ) {
						$df[ $j ] = $_n;
					}
					$df = join( '+', $df );
				}
				$wp_customize->add_setting('footer_custom_'.$i.'_columns',
					array(
						'sanitize_callback' => 'sanitize_text_field',
						'default' => $df,
						'transport' => 'postMessage',
					)
				);
				$wp_customize->add_control('footer_custom_'.$i.'_columns',
					array(
						'label' => $i == 1 ? __('Custom footer 1 column width', 'shop2u') : sprintf( __('Custom footer %s columns width', 'shop2u'), $i ),
						'section' => 'footer_middle',
						'description' => esc_html__('Enter int numbers and sum of them must smaller or equal 12, separated by "+"', 'shop2u'),
					)
				);
			}

		// Copyright
		$wp_customize->add_section( 'footer_copyright',
			array(
				'priority'    => 4,
				'title'       => esc_html__('Footer Copyright','shop2u'),
				'panel'       => 'shop2u_footer',
			)
		);

			// shop2u_footer_copyright_disable
			$wp_customize->add_setting('shop2u_footer_copyright_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_footer_copyright_disable'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_footer_copyright_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide copyright footer?', 'shop2u'),
					'section'     => 'footer_copyright',
				)
			);

			// shop2u_footer_copyright
			$wp_customize->add_setting('shop2u_footer_copyright',
					array(
						'sanitize_callback' => 'wp_kses_post',
						'default'           => $shop2u_options['shop2u_footer_copyright'],
						'priority'          => 2,
					)
				);
			$wp_customize->add_control('shop2u_footer_copyright',
				array(
					'type'        => 'textarea',
					'label'       => esc_html__('Copyright Text', 'shop2u'),
					'description' => __('<code>%current_year%</code> to update the year automatically.<br/><code>%copy%</code> to include the copyright symbol.<br/>HTML is allowed.', 'shop2u'),
					'section'     => 'footer_copyright',
				)
			);			

		// Background
		$wp_customize->add_section( 'footer_background',
			array(
				'priority'    => 5,
				'title'       => esc_html__('Footer Background','shop2u'),
				'panel'       => 'shop2u_footer',
			)
		);

			// shop2u_footer_bg_color
			$wp_customize->add_setting('shop2u_footer_bg_color',
					array(
						'sanitize_callback' => 'shop2u_sanitize_hex_color',
						'default'           => $shop2u_options['shop2u_footer_bg_color'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'shop2u_footer_bg_color',
				array(
					'label' 		=> esc_html__('Background Color', 'shop2u'),
					'section' 		=> 'footer_background',
				)
			) );			
}
add_action('customize_register','shop2u_customizer_footer');