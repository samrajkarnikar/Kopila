( function( $ , api ) {
    function shop2u_range_live_media_load(setting, css_selector, css_prop, ext='') {
        wp.customize(
            setting, function( value ) {
                'use strict';
                value.bind(
                    function( to ){
                        var values          = JSON.parse( to );
                        var desktop_value   = JSON.parse( values.desktop );
                        var tablet_value    = JSON.parse( values.tablet );
                        var mobile_value    = JSON.parse( values.mobile );

                        var class_name      = 'customizer-' + setting;
                        var css_class       = $( '.' + class_name );
                        var selector_name   = css_selector;
                        var property_name   = css_prop;

                        var desktop_css     = '';
                        var tablet_css      = '';
                        var mobile_css      = '';

                        if ( property_name.length == 1 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                        } else if ( property_name.length == 2 ) {
                            var desktop_css     = property_name[0] + ': ' + desktop_value + ext + ';';
                            var desktop_css     = desktop_css + property_name[1] + ': ' + desktop_value + ext + ';';

                            var tablet_css      = property_name[0] + ': ' + tablet_value + ext + ';';
                            var tablet_css      = tablet_css + property_name[1] + ': ' + tablet_value + ext + ';';

                            var mobile_css      = property_name[0] + ': ' + mobile_value + ext + ';';
                            var mobile_css      = mobile_css + property_name[1] + ': ' + mobile_value + ext + ';';
                        }

                        var head_append     = '<style class="' + class_name + '">@media (min-width: 320px){ ' + selector_name + ' { ' + mobile_css + ' } } @media (min-width: 720px){ ' + selector_name + ' { ' + tablet_css + ' } } @media (min-width: 960px){ ' + selector_name + ' { ' + desktop_css + ' } }</style>';

                        if ( css_class.length ) {
                            css_class.replaceWith( head_append );
                        } else {
                            $( "head" ).append( head_append );
                        }
                    }
                );
            }
        );
    }

    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $('.site-title').text( to );
        } );
    } );
    
	wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            $('.site-description').text( to );
        } );
    } );

    // wp.customize( 'shop2u_slider_opacity', function( value ) {
    //     value.bind( function( to ) {
    //         $('.home-slider-one .main-slider').css( 'background-color', 'rgba(0,0,0,'+to+')' );
    //     } );
    // } );

    shop2u_range_live_media_load('shop2u_h_site_title_fontsize','.site-title',['font-size'],'px !important');
    shop2u_range_live_media_load('shop2u_h_site_desc_fontsize','.site-description',['font-size'],'px !important');
    shop2u_range_live_media_load('shop2u_h_logo_width','.logo-img  img',['max-width'],'px');   
    shop2u_range_live_media_load('shop2u_breadcrumb_height','.breadcrumb-area,.breadcrumb-area:has(.bg_overlay)',['min-height'],'px');

    // Typography
    shop2u_range_live_media_load('shop2u_body_fontsize','body',['font-size'],'px');
    shop2u_range_live_media_load('shop2u_body_lineheight','body',['line-height']);
    shop2u_range_live_media_load('shop2u_body_letterspace','body',['letter-spacing'],'px');
    wp.customize( 'shop2u_body_fontweight', function( value ) {
        value.bind( function( to ) {
            $('body').css('font-weight',to);
        } );
    } );
    wp.customize( 'shop2u_body_texttransform', function( value ) {
        value.bind( function( to ) {
            $('body').css('text-transform',to);
        } );
    } );

    shop2u_range_live_media_load('shop2u_h1_fontsize','h1',['font-size'],'px');
    shop2u_range_live_media_load('shop2u_h1_lineheight','h1',['line-height']);
    shop2u_range_live_media_load('shop2u_h1_letterspace','h1',['letter-spacing'],'px');
    wp.customize( 'shop2u_h1_fontweight', function( value ) {
        value.bind( function( to ) {
            $('h1').css('font-weight',to);
        } );
    } );
    wp.customize( 'shop2u_h1_texttransform', function( value ) {
        value.bind( function( to ) {
            $('h1').css('text-transform',to);
        } );
    } );

    shop2u_range_live_media_load('shop2u_h2_fontsize','h2',['font-size'],'px');
    shop2u_range_live_media_load('shop2u_h2_lineheight','h2',['line-height']);
    shop2u_range_live_media_load('shop2u_h2_letterspace','h2',['letter-spacing'],'px');
    wp.customize( 'shop2u_h2_fontweight', function( value ) {
        value.bind( function( to ) {
            $('h2').css('font-weight',to);
        } );
    } );
    wp.customize( 'shop2u_h2_texttransform', function( value ) {
        value.bind( function( to ) {
            $('h2').css('text-transform',to);
        } );
    } );

    shop2u_range_live_media_load('shop2u_h3_fontsize','h3',['font-size'],'px');
    shop2u_range_live_media_load('shop2u_h3_lineheight','h3',['line-height']);
    shop2u_range_live_media_load('shop2u_h3_letterspace','h3',['letter-spacing'],'px');
    wp.customize( 'shop2u_h3_fontweight', function( value ) {
        value.bind( function( to ) {
            $('h3').css('font-weight',to);
        } );
    } );
    wp.customize( 'shop2u_h3_texttransform', function( value ) {
        value.bind( function( to ) {
            $('h3').css('text-transform',to);
        } );
    } );

    shop2u_range_live_media_load('shop2u_h4_fontsize','h4',['font-size'],'px');
    shop2u_range_live_media_load('shop2u_h4_lineheight','h4',['line-height']);
    shop2u_range_live_media_load('shop2u_h4_letterspace','h4',['letter-spacing'],'px');
    wp.customize( 'shop2u_h4_fontweight', function( value ) {
        value.bind( function( to ) {
            $('h4').css('font-weight',to);
        } );
    } );
    wp.customize( 'shop2u_h4_texttransform', function( value ) {
        value.bind( function( to ) {
            $('h4').css('text-transform',to);
        } );
    } );

    shop2u_range_live_media_load('shop2u_h5_fontsize','h5',['font-size'],'px');
    shop2u_range_live_media_load('shop2u_h5_lineheight','h5',['line-height']);
    shop2u_range_live_media_load('shop2u_h5_letterspace','h5',['letter-spacing'],'px');
    wp.customize( 'shop2u_h5_fontweight', function( value ) {
        value.bind( function( to ) {
            $('h5').css('font-weight',to);
        } );
    } );
    wp.customize( 'shop2u_h5_texttransform', function( value ) {
        value.bind( function( to ) {
            $('h5').css('text-transform',to);
        } );
    } );

    shop2u_range_live_media_load('shop2u_h6_fontsize','h6',['font-size'],'px');
    shop2u_range_live_media_load('shop2u_h6_lineheight','h6',['line-height']);
    shop2u_range_live_media_load('shop2u_h6_letterspace','h6',['letter-spacing'],'px');
    wp.customize( 'shop2u_h6_fontweight', function( value ) {
        value.bind( function( to ) {
            $('h6').css('font-weight',to);
        } );
    } );
    wp.customize( 'shop2u_h6_texttransform', function( value ) {
        value.bind( function( to ) {
            $('h6').css('text-transform',to);
        } );
    } );

} )( jQuery , wp.customize );