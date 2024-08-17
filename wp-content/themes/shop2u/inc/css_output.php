<?php
if ( ! function_exists( 'shop2u_get_dynamic_css' ) ) :
	function shop2u_get_dynamic_css() {

		global $shop2u_options;

		// Calling Shopcozi_CSS class for generate dynamic css
		$pro_css = new Shop2u_CSS;

		$body_bg_color = get_background_color();
		if($body_bg_color==''){
		 	$body_bg_color = 'ffffff';
		}
		list($body_r, $body_g, $body_b) = sscanf( '#'.$body_bg_color, "#%02x%02x%02x" );

		$logo_width = json_decode(get_theme_mod('shop2u_h_logo_width',$shop2u_options['shop2u_h_logo_width']));

		$breadcrumb_bg_color = get_theme_mod('shop2u_breadcrumb_bg_color',$shop2u_options['shop2u_breadcrumb_bg_color']);
		$breadcrumb_bg_image = get_theme_mod('shop2u_breadcrumb_bg_image',$shop2u_options['shop2u_breadcrumb_bg_image']);
		$breadcrumb_attachment = get_theme_mod('shop2u_breadcrumb_attachment',$shop2u_options['shop2u_breadcrumb_attachment']);
		$breadcrumb_repeat = get_theme_mod('shop2u_breadcrumb_repeat',$shop2u_options['shop2u_breadcrumb_repeat']);
		$breadcrumb_position = get_theme_mod('shop2u_breadcrumb_position',$shop2u_options['shop2u_breadcrumb_position']);
		$breadcrumb_size = get_theme_mod('shop2u_breadcrumb_size',$shop2u_options['shop2u_breadcrumb_size']);
		$breadcrumb_overlay = get_theme_mod('shop2u_breadcrumb_overlay',$shop2u_options['shop2u_breadcrumb_overlay']);
		$breadcrumb_height = json_decode(get_theme_mod('shop2u_breadcrumb_height',$shop2u_options['shop2u_breadcrumb_height']));

		$footer_bg_color = get_theme_mod('shop2u_footer_bg_color',$shop2u_options['shop2u_footer_bg_color']);
		$footer_bg_image = get_theme_mod('shop2u_footer_bg_image',$shop2u_options['shop2u_footer_bg_image']);
		$footer_attachment = get_theme_mod('shop2u_footer_bg_attachment',$shop2u_options['shop2u_footer_bg_attachment']);
		$footer_repeat = get_theme_mod('shop2u_footer_bg_repeat',$shop2u_options['shop2u_footer_bg_repeat']);
		$footer_position = get_theme_mod('shop2u_footer_bg_position',$shop2u_options['shop2u_footer_bg_position']);
		$footer_size = get_theme_mod('shop2u_footer_bg_size',$shop2u_options['shop2u_footer_bg_size']);
		$footer_overlay = get_theme_mod('shop2u_footer_overlay',$shop2u_options['shop2u_footer_overlay']);

		// Accent color 1
		$accent_color = get_theme_mod('shop2u_accent_color',$shop2u_options['shop2u_accent_color']);
		list($r, $g, $b) = sscanf( $accent_color, "#%02x%02x%02x" );

		// Secondary Color
		$secondary_color = get_theme_mod('shop2u_secondary_color',$shop2u_options['shop2u_secondary_color']);

		$slider_bg_color = get_theme_mod('shop2u_slider_bg_color',$shop2u_options['shop2u_slider_bg_color']);
		$slider_left_bg_color = get_theme_mod('shop2u_slider_left_bg_color',$shop2u_options['shop2u_slider_left_bg_color']);
		
		// All Root Vaiables
		$pro_css->set_selector( ':root' );		
		$pro_css->add_property( '--bs-body-bg-color', esc_attr($body_bg_color));
		$pro_css->add_property( '--bs-primary', esc_attr($accent_color));
		$pro_css->add_property( '--bs-primary-lite', shop2u_convertRGBAtoHEX6('rgba('.esc_attr($r).', '.esc_attr($g).', '.esc_attr($b).', .1)'));
		$pro_css->add_property( '--bs-primary-lite2', shop2u_convertRGBAtoHEX6('rgba('.esc_attr($r).', '.esc_attr($g).', '.esc_attr($b).', .2)'));
		$pro_css->add_property( '--bs-secondary', esc_attr($secondary_color));
		$pro_css->add_property( '--bs-slider-bg-color', esc_attr($slider_bg_color));
		$pro_css->add_property( '--bs-slider-left-bg-color', esc_attr($slider_left_bg_color));

		$pro_css->add_property( '--breadcrumb-bg-color', esc_attr($breadcrumb_bg_color));
		$pro_css->add_property( '--breadcrumb-bg-image', 'url('.esc_url($breadcrumb_bg_image).')');
		$pro_css->add_property( '--breadcrumb-bg-attachment', esc_attr($breadcrumb_attachment));
		$pro_css->add_property( '--breadcrumb-bg-repeat', esc_attr($breadcrumb_repeat));
		$pro_css->add_property( '--breadcrumb-bg-position', esc_attr($breadcrumb_position));
		$pro_css->add_property( '--breadcrumb-bg-size', esc_attr($breadcrumb_size));
		$pro_css->add_property( '--breadcrumb-bg-overlay', esc_attr($breadcrumb_overlay));

		$pro_css->add_property( '--footer-bg-color', esc_attr($footer_bg_color));
		$pro_css->add_property( '--footer-bg-image', 'url("'.esc_url($footer_bg_image).'")');
		$pro_css->add_property( '--footer-bg-attachment', esc_attr($footer_attachment));
		$pro_css->add_property( '--footer-bg-repeat', esc_attr($footer_repeat));
		$pro_css->add_property( '--footer-bg-position', esc_attr($footer_position));
		$pro_css->add_property( '--footer-bg-size', esc_attr($footer_size));
		$pro_css->add_property( '--footer-bg-overlay', esc_attr($footer_overlay));	

		// Start Typography
		$typo_sections = array('body','h1','h2','h3','h4','h5','h6');
		foreach($typo_sections as $sec) {
			$sec_fontsize = json_decode(get_theme_mod('shop2u_'.$sec.'_fontsize',$shop2u_options['shop2u_'.$sec.'_fontsize']));
			$sec_lineheight = json_decode(get_theme_mod('shop2u_'.$sec.'_lineheight',$shop2u_options['shop2u_'.$sec.'_lineheight']));
			$sec_letterspace = json_decode(get_theme_mod('shop2u_'.$sec.'_letterspace',$shop2u_options['shop2u_'.$sec.'_letterspace']));
			$sec_fontweight = get_theme_mod('shop2u_'.$sec.'_fontweight',$shop2u_options['shop2u_'.$sec.'_fontweight']);
			$sec_texttransform = get_theme_mod('shop2u_'.$sec.'_texttransform',$shop2u_options['shop2u_'.$sec.'_texttransform']);

			$pro_css->set_selector( $sec );
			
			// Font Weight
			if($sec_fontweight!=''){
				$pro_css->add_property( 'font-weight', esc_attr($sec_fontweight));
			}
			
			// Text Transform
			if($sec_texttransform!=''){
				$pro_css->add_property( 'text-transform', esc_attr($sec_texttransform));
			}			

			// Desktop CSS
			$pro_css->start_media_query( apply_filters( 'shop2u_'.$sec.'_desktop_media_query', '(min-width:991px)' ) );
				$pro_css->set_selector( $sec );
				if(isset($sec_fontsize->desktop)){
					$pro_css->add_property( 'font-size', esc_attr($sec_fontsize->desktop).'px' );
				}
				if(isset($sec_lineheight->desktop)){
				$pro_css->add_property( 'line-height', esc_attr($sec_lineheight->desktop) );
				}
				if(isset($sec_letterspace->desktop)){
				$pro_css->add_property( 'letter-spacing', esc_attr($sec_letterspace->desktop).'px' );
				}			
			$pro_css->stop_media_query();

			// Tablet CSS
			$pro_css->start_media_query( apply_filters( 'shop2u_'.$sec.'_tablet_media_query', '(min-width:768px) and (max-width:991px)' ) );
				$pro_css->set_selector( $sec );
				if(isset($sec_fontsize->tablet)){
					$pro_css->add_property( 'font-size', esc_attr($sec_fontsize->tablet).'px' );
				}
				if(isset($sec_lineheight->tablet)){
				$pro_css->add_property( 'line-height', esc_attr($sec_lineheight->tablet) );
				}
				if(isset($sec_letterspace->tablet)){
				$pro_css->add_property( 'letter-spacing', esc_attr($sec_letterspace->tablet).'px' );
				}
			$pro_css->stop_media_query();

			// Mobile CSS
			$pro_css->start_media_query( apply_filters( 'shop2u_'.$sec.'_mobile_media_query', '(max-width:768px)' ) );
				$pro_css->set_selector( $sec );
				if(isset($sec_fontsize->mobile)){
					$pro_css->add_property( 'font-size', esc_attr($sec_fontsize->mobile).'px' );
				}
				if(isset($sec_lineheight->mobile)){
				$pro_css->add_property( 'line-height', esc_attr($sec_lineheight->mobile) );
				}
				if(isset($sec_letterspace->mobile)){
				$pro_css->add_property( 'letter-spacing', esc_attr($sec_letterspace->mobile).'px' );
				}
			$pro_css->stop_media_query();
		}

		// End Typography

		// Desktop CSS
		$pro_css->start_media_query( apply_filters( 'shop2u_desktop_media_query', '(min-width:991px)' ) );
			if(isset($logo_width->desktop)){
				$pro_css->set_selector('.logo-img img');
				$pro_css->add_property('max-width', esc_attr($logo_width->desktop).'px');
			}

			if(isset($breadcrumb_height->desktop)){
				$pro_css->set_selector('.breadcrumb-area,.breadcrumb-area:has(.bg_overlay)');
				$pro_css->add_property('min-height', esc_attr($breadcrumb_height->desktop).'px');
			}
		$pro_css->stop_media_query();

		// Tablet CSS
		$pro_css->start_media_query( apply_filters( 'shop2u_tablet_media_query', '(min-width:768px) and (max-width:991px)' ) );
			if(isset($logo_width->tablet)){
				$pro_css->set_selector('.logo-img img');
				$pro_css->add_property('max-width', esc_attr($logo_width->tablet).'px');
			}

			if(isset($breadcrumb_height->tablet)){
				$pro_css->set_selector('.breadcrumb-area,.breadcrumb-area:has(.bg_overlay)');
				$pro_css->add_property('min-height', esc_attr($breadcrumb_height->tablet).'px');
			}
		$pro_css->stop_media_query();

		// Mobile CSS
		$pro_css->start_media_query( apply_filters( 'shop2u_mobile_media_query', '(max-width:768px)' ) );
			if(isset($logo_width->mobile)){
				$pro_css->set_selector('.logo-img img');
				$pro_css->add_property('max-width', esc_attr($logo_width->mobile).'px');
			}

			if(isset($breadcrumb_height->mobile)){
				$pro_css->set_selector('.breadcrumb-area,.breadcrumb-area:has(.bg_overlay)');
				$pro_css->add_property('min-height', esc_attr($breadcrumb_height->mobile).'px');
			}
		$pro_css->stop_media_query();

		return apply_filters( 'shop2u_pro_dynamic_css', wp_strip_all_tags( $pro_css->css_output() ) );
	}
endif;

if ( ! function_exists( 'shop2u_enqueue_dynamic_css' ) ) :
	function shop2u_enqueue_dynamic_css() {
		$css = shop2u_get_dynamic_css();
		wp_add_inline_style( 'shop2u-style', wp_strip_all_tags( $css ) );
	}
	add_action( 'wp_enqueue_scripts', 'shop2u_enqueue_dynamic_css');
endif;