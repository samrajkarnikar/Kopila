<?php

class Shop2u_Reorder_Custom_Control extends WP_Customize_Control {
        
    public function render_content() {

    	global $shop2u_options;

        $sections = get_theme_mod('shop2u_section_reorder',$shop2u_options['shop2u_section_reorder']);
        
        $de = explode(",",$sections);
        $defaultshowdata = shop2u_homepage_sections();
        $ld = array_diff($defaultshowdata,$de);

        ?>
        <h3><?php _e('Active Sections:','shop2u'); ?></h3>
        <ul class="businessacontentsort busienss_customizer_layout" id="bacitve">
            <?php if( !empty($de[0]) ){ foreach( $de as $value ){ ?>
                <li class="businessa-section" id="<?php echo $value; ?>"><b><?php echo ucfirst($value); ?></b> <i class="dashicons dashicons-menu"></i></li>
            <?php } } ?>
        </ul>

        <h3><?php _e('Disabled Sections:','shop2u'); ?></h3>
        <ul class="businessacontentsort busienss_customizer_layout" id="bdeactive">
            <?php if(!empty($ld)){ foreach($ld as $val){ ?>
                <li class="businessa-section" id="<?php echo $val; ?>"><b><?php echo ucfirst($val); ?></b> <i class="dashicons dashicons-menu"></i></li>
            <?php } } ?>
        </ul>
        <script>
            jQuery(document).ready(function($) {
                $( ".businessacontentsort" ).sortable({
                    connectWith: '.businessacontentsort'
                });
            });

            jQuery(document).ready( function( $ ) {

                function allactivedata( web ) {
                    var col = [];
                    $(web + ' #bacitve').each(function(){
                        col.push($(this).sortable('toArray').join(','));
                    });
                    return col.join('|');
                }

                function alldeactivedata( web ) {
                    var col = [];
                    $(web + ' #bdeactive').each(function(){
                        col.push($(this).sortable('toArray').join(','));
                    });
                    return col.join('|');
                }

                $( '#bacitve .businessa-section, #bdeactive .businessa-section' ).mouseleave( function() {
                    var bacitve   = allactivedata('#customize-control-shop2u_lmc');
                    var bdeactive = alldeactivedata('#customize-control-shop2u_lmc');

                    $("#customize-control-shop2u_section_reorder input[type = 'text']").val(bacitve);
                    $("#customize-control-shop2u_lmdc input[type = 'text']").val(bdeactive);
                    $("#customize-control-shop2u_section_reorder input[type = 'text']").change();
                });
            });
        </script>
        <?php
    }
}