<?php
class Shop2u_Primary_Color_Control extends WP_Customize_Control{
	
	public $type = 'new_menu';

   function render_content(){

   		echo sprintf(__('<span class="customize-control-title">%s</span>','shop2u'),'Select Primary Color');

		$name = '_customize-color-radio-' . $this->id; 
		foreach($this->choices as $key => $value ) {
	        ?>
            <label>
				<input type="radio" value="<?php echo $key; ?>" name="<?php echo esc_attr( $name ); ?>" data-customize-setting-link="<?php echo esc_attr( $this->id ); ?>" <?php if($this->value() == $key){ echo 'checked="checked"'; } ?>>
				<div class="swicher_color <?php if($this->value() == $key){ echo 'color_active'; } ?>" style="background-color:<?php echo $key; ?>;"></div>
			</label>
	    <?php }	?>
	  	<script>
			jQuery(document).ready(function($) {
				$("#customize-control-shop2u_theme_color label div").click(function(){
					$("#customize-control-shop2u_theme_color label div").removeClass("color_active");
					$(this).addClass("color_active");
				});
			});
	  	</script>
	  <?php
   }
}