<?php
class Shop2u_Theme_Support extends WP_Customize_Control{
    public function render_content() {
        echo wp_kses_post('Upgrade to <a href="https://www.britetechs.com/theme/shop2u-pro/">Shop2u Pro</a> to be able to change the section order and styling!','shop2u');
    }
}