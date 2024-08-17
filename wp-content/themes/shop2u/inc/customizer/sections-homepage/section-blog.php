<?php
function shop2u_customizer_blog_section( $wp_customize ){

	global $shop2u_options;

		// Homepage Blog
		$wp_customize->add_section( 'blog_section',
			array(
				'priority'    => 10,
				'title'       => esc_html__('Section Blog','shop2u'),
				'panel'       => 'shop2u_frontpage',
			)
		);

			// shop2u_blog_disable
			$wp_customize->add_setting('shop2u_blog_disable',
					array(
						'sanitize_callback' => 'shop2u_sanitize_checkbox',
						'default'           => $shop2u_options['shop2u_blog_disable'],
						'priority'          => 1,
					)
				);
			$wp_customize->add_control('shop2u_blog_disable',
				array(
					'type'        => 'checkbox',
					'label'       => esc_html__('Hide this section?', 'shop2u'),
					'section'     => 'blog_section',
				)
			);

			// shop2u_blog_subtitle
			$wp_customize->add_setting('shop2u_blog_subtitle',
					array(
						'sanitize_callback' => 'wp_kses_post',
						'default'           => $shop2u_options['shop2u_blog_subtitle'],
						'priority'          => 2,
					)
				);
			$wp_customize->add_control('shop2u_blog_subtitle',
				array(
					'type'        => 'text',
					'label'       => esc_html__('Subtitle', 'shop2u'),
					'section'     => 'blog_section',
				)
			);

			// shop2u_blog_title
			$wp_customize->add_setting('shop2u_blog_title',
					array(
						'sanitize_callback' => 'wp_kses_post',
						'default'           => $shop2u_options['shop2u_blog_title'],
						'priority'          => 3,
					)
				);
			$wp_customize->add_control('shop2u_blog_title',
				array(
					'type'        => 'text',
					'label'       => esc_html__('Title', 'shop2u'),
					'section'     => 'blog_section',
				)
			);

			// shop2u_blog_desc
			$wp_customize->add_setting('shop2u_blog_desc',
					array(
						'sanitize_callback' => 'wp_kses_post',
						'default'           => $shop2u_options['shop2u_blog_desc'],
						'priority'          => 4,
					)
				);
			$wp_customize->add_control('shop2u_blog_desc',
				array(
					'type'        => 'textarea',
					'label'       => esc_html__('Description', 'shop2u'),
					'section'     => 'blog_section',
				)
			);

			// shop2u_blog_category
			$wp_customize->add_setting('shop2u_blog_category',
					array(
						'sanitize_callback' => 'shop2u_sanitize_array',
						'default'           => $shop2u_options['shop2u_blog_category'],
						'priority'          => 5,
					)
				);
			$wp_customize->add_control(new Shop2u_Multiselect_Control($wp_customize,'shop2u_blog_category',
				array(
					'label'       => esc_html__('Select Categories', 'shop2u'),
					'section'     => 'blog_section',
					'choices' => shop2u_categories(),
				)
			) );

			// shop2u_blog_posts_per_page
			$wp_customize->add_setting('shop2u_blog_posts_per_page',
					array(
						'sanitize_callback' => 'shop2u_sanitize_number',
						'default'           => $shop2u_options['shop2u_blog_posts_per_page'],
						'priority'          => 6,
					)
				);
			$wp_customize->add_control('shop2u_blog_posts_per_page',
				array(
					'type'        => 'number',
					'label'       => esc_html__('No. of blogs to show', 'shop2u'),
					'section'     => 'blog_section',
					'input_attrs' => array(
									    'min' => 1,
									    'max' => 100
									),
				)
			);
}
add_action('customize_register','shop2u_customizer_blog_section');