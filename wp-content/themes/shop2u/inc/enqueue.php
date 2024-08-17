<?php
if( ! function_exists('shop2u_enqueue_scripts') ):
	function shop2u_enqueue_scripts(){
		global $shop2u_options;

		$theme = wp_get_theme();
	    $version = $theme->get('Version');
		wp_enqueue_style('shop2u-fonts', shop2u_fonts_url(), array(), $version);

		// CSS files
		wp_enqueue_style('fontawesome-all',get_template_directory_uri().'/css/all.min.css');
		wp_enqueue_style('bootstrap',get_template_directory_uri().'/css/bootstrap.min.css');
		wp_enqueue_style('owl-carousel',get_template_directory_uri().'/css/owl.carousel.min.css');
		wp_enqueue_style('animate',get_template_directory_uri().'/css/animate.min.css');
		wp_enqueue_style('shop2u-animation',get_template_directory_uri().'/css/theme_animation.css');
		wp_enqueue_style('shop2u-main',get_template_directory_uri().'/css/main.css');
		wp_enqueue_style('shop2u-widget',get_template_directory_uri().'/css/widget.css');
		wp_enqueue_style('shop2u-responsive',get_template_directory_uri().'/css/responsive.css');
		wp_enqueue_style('shop2u-woo',get_template_directory_uri().'/css/woo.css');
		wp_enqueue_style('shop2u-style',get_stylesheet_uri());

		// JS files
		wp_enqueue_script('jquery');
		wp_enqueue_script('bootstrap',get_template_directory_uri().'/js/bootstrap.bundle.min.js',array('jquery'),false,true);
		wp_enqueue_script('owl-carousel',get_template_directory_uri().'/js/owl.carousel.min.js','',false,true);
		wp_enqueue_script('wow',get_template_directory_uri().'/js/wow.min.js','',false,true);
		wp_enqueue_script('isotope',get_template_directory_uri().'/js/isotope.pkgd.min.js','',false,true);
		wp_enqueue_script('shop2u-custom',get_template_directory_uri().'/js/custom.js','',false,true);

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		$shop2u_settings = array(
	        'homeUrl'     => home_url( '/' ),
			'category_more_label' => get_theme_mod('shop2u_bottom_category_more_label',$shop2u_options['shop2u_bottom_category_more_label']),
			'category_no_more_label' => get_theme_mod('shop2u_bottom_category_no_more_label',$shop2u_options['shop2u_bottom_category_no_more_label']),
			'slider_speed' => get_theme_mod('shop2u_slider_speed',$shop2u_options['shop2u_slider_speed']),
			'slider_animation_start' => get_theme_mod('shop2u_slider_animation_start',$shop2u_options['shop2u_slider_animation_start']),
			'slider_animation_end' => get_theme_mod('shop2u_slider_animation_end',$shop2u_options['shop2u_slider_animation_end']),
	    );
		wp_localize_script( 'shop2u-custom', 'shop2u_settings', $shop2u_settings );
	}
	add_action( 'wp_enqueue_scripts', 'shop2u_enqueue_scripts' );
endif;

if( ! function_exists('shop2u_admin_enqueue_scripts') ):
	function shop2u_admin_enqueue_scripts(){
		wp_enqueue_style('shop2u-admin', get_template_directory_uri() . '/css/admin.css');

		wp_enqueue_script( 'shop2u-admin-script', get_template_directory_uri() . '/js/admin-script.js', array( 'jquery' ), '', true );

		wp_localize_script( 'shop2u-admin-script', 'shop2u_ajax_object',
	        array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
	    );
	}
	add_action( 'admin_enqueue_scripts', 'shop2u_admin_enqueue_scripts' );
endif;