<?php

/**
 * Shop2u theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Shop2u
 * 
 * @since Shop2u 0.1
 */

// Creating constant variables

$shop2u_theme = wp_get_theme();
define('SHOP2U_THEME_DIR', get_template_directory() );
define('SHOP2U_THEME_URI', get_template_directory_uri() );
define('SHOP2U_THEME_NAME', $shop2u_theme->get('Name') );
define('SHOP2U_THEME_VERSION', $shop2u_theme->get('Version') );

if( ! function_exists( 'shop2u_setup' ) ):
	function shop2u_setup() {
		
		// Defining a text domain name for the theme
		load_theme_textdomain('shop2u');
		
		// Supporting automatic feed links here
		add_theme_support('automatic-feed-links');
		
		// Supporting WordPress "Title" tags here
		add_theme_support('title-tag');
		
		// Supporting "Pages" and "Excerpt" here
		add_post_type_support('page','excerpt');
		
		// Supporting "Featured Images" for the pages here
		add_theme_support('post-thumbnails');

		// Setup global content-width here
		global $content_width;
		
		if ( ! isset( $content_width ) ) {
			$content_width = 800;
		}
		
		// Registering primary navigation area here
		register_nav_menus( array(
			'primary' => esc_html__('Primary Menu','shop2u'),
		) );
		
		// Supporting HTML5 tags on the following theme parts
		add_theme_support('html5',array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		
		// Enqueue editor styles for the theme
		add_editor_style( array('css/editor-style.css', shop2u_fonts_url() ) );
		
		// Adding a custom logo image here
		add_theme_support('custom-logo',array(
            'height'      => 73,
            'width'       => 210,
            'flex-height' => true,
            'flex-width'  => true,
        ) );        
		
		// Adding a custom header image here
		$args = array(
			'width'        => 1600,
			'flex-width'   => true,
			'default-image'=> '',
			'header-text'  => false,
		);
		add_theme_support( 'custom-header', $args );

		// Custom background theme supports
		add_theme_support( 'custom-background' );
		
		// Supporting following plugins for adding advanced theme features
		add_theme_support( 'recommend-plugins', array(
			'britetechs-companion' => array(
                'name' => esc_html__( 'Britetechs Companion', 'shop2u' ),
                'active_filename' => 'britetechs-companion/britetechs-companion.php',
				'desc' => esc_html__( 'We highly recommend that you install the britetechs companion plugin to gain access to the team and testimonial sections.', 'shop2u' ),
            ),
            'contact-form-7' => array(
                'name' => esc_html__( 'Contact Form 7', 'shop2u' ),
                'active_filename' => 'contact-form-7/wp-contact-form-7.php',
            ),
        ) );
		
		// Adding selective refresh feature in the theme
		add_theme_support( 'customize-selective-refresh-widgets' );
		
		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'image',
			'video',
			'quote',
			'link',
			'gallery',
			'audio',
		) );

		/*
		 * Woocommerce plugin supports
		 */
		add_theme_support( 'woocommerce' );	
		add_theme_support( 'wc-product-gallery-slider' );	

		// load starter Content.
		add_theme_support( 'starter-content', shop2u_wp_starter_pack() );
	}
	add_action( 'after_setup_theme', 'shop2u_setup' );
endif;

if ( ! function_exists( 'shop2u_fonts_url' ) ) :
	function shop2u_fonts_url() {
		global $shop2u_options;

	    $fonts_url = '';
	    $Poppins = _x( 'on', 'Poppins font: on or off', 'shop2u' );

	    if ( 'off' !== $Poppins ) {

	        $font_families = array();
	        if ( 'off' !== $Poppins ) {
	            $font_families[] = 'Poppins:100,200,300,400,500,600,700,800,900,italic';
	        }

	        $sections = array(
				'body',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
			);

			foreach( $sections as $section ){
				$font = get_theme_mod('shop2u_'.$section.'_font');
				if(isset($font) && $font != '' ){
					$font_families[] = $font.':100,200,300,400,500,600,700,800,900,italic';
				}				 
			}
	        
	        $subset = 'latin';
	        $query_args = array(
	            'family' => urlencode( implode( '|', $font_families ) ),
	            'subset' => urlencode( $subset ),
	        );
	        $fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css?family=' );
	    }
	    return esc_url_raw( $fonts_url );
	}
endif;

if( ! function_exists('shop2u_widgets_register') ):
	function shop2u_widgets_register(){
		register_sidebar( array(
			'name'          => esc_html__( 'Primary Sidebar', 'shop2u' ),
			'id'            => 'sidebar-1',
			'description'   => 'This sidebar contents will be show on the blog archive pages.',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="title-box"><div class="sidebar_widget_icon"><i class="fa fa-shopping-bag"></i></div><h5 class="widget_title">',
			'after_title'   => '</h5></div>',
		) );
		
		for ( $i = 1; $i<= 4; $i++ ) {
			register_sidebar( array(
				'name'          => sprintf( __('Footer %s', 'shop2u'), $i ),
				'id'            => 'footer-' . $i,
				'description'   => 'This sidebar contents will be show in the footer '.$i.' column area.',
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<div class="main-footer-title"><h5 class="widget_title">',
				'after_title'   => '</h5><div class="shipping-icon text-center"><i class="fa fa-shopping-basket"></i></div></div>',
			) );
		}

		register_sidebar( array(
			'name'          => __('Woocommerce Sidebar','shop2u'),
			'id'            => 'woocommerce',
			'description'   => __('This Widget area for woocommerce widget','shop2u'),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<div class="title-box"><div class="sidebar_widget_icon"><i class="fa fa-shopping-bag"></i></div><h5 class="widget_title">',
			'after_title'   => '</h5></div>',
		) );
	}
	add_action('widgets_init','shop2u_widgets_register');
endif;

// Include default data file
get_template_part('/inc/default_data');

// Include css and js files
get_template_part('/inc/enqueue');

// Include page walker file
get_template_part('/inc/theme_page_walker');

// Include helpers files here
get_template_part('/inc/header_helpers');
get_template_part('/inc/sections_helpers');
get_template_part('/inc/footer_helpers');

// Include template tags file
get_template_part('/inc/template_tags');

// Include dynamic css files
get_template_part('/inc/class-frontend-css');
get_template_part('/inc/css_output');

// Woocommerce files includes
get_template_part('/inc/woo_hooks');

// Include customizer file
get_template_part('/inc/customizer/customizer');

// Include customizer recommanded plugins files
require get_parent_theme_file_path('/inc/customizer/install/class-install-helper.php');
require get_parent_theme_file_path('/inc/customizer/install/customizer_recommended_plugin.php');