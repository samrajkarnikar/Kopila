<?php 
global $shop2u_options;
$r_icon = get_theme_mod('shop2u_bottom_r_icon',$shop2u_options['shop2u_bottom_r_icon']);
$r_title = get_theme_mod('shop2u_bottom_r_title',$shop2u_options['shop2u_bottom_r_title']);
$r_desc = get_theme_mod('shop2u_bottom_r_desc',$shop2u_options['shop2u_bottom_r_desc']);

$nav_r_info_disable = true;
if(
	$r_icon!='' ||
	$r_title!='' ||
	$r_desc!=''
){
	$nav_r_info_disable = false;
}

?>
<div class="middle-section">
 	<div class="container">
 	 	<div class="row align-items-center">
 	 	  	<div class="col-xl-3 col-lg-3 col-md-6 d-none d-lg-block">
 	 	  	   <?php shop2u_logo(); ?>
 	 	  	</div>
 	 	  	<div class="col-xl-7 col-lg-6 col-md-8 col-12 d-none d-md-block">
 	 	  	   <?php 
 	 	  	   if( class_exists('DGWT_WC_Ajax_Search') ){
 	 	  	   		echo do_shortcode('[fibosearch]');
 	 	  	   }else{
 	 	  	   		shop2u_header_product_search();
 	 	  	   }
 	 	  	   ?>
 	 	  	</div>
 	 	  	<div class="col-xl-2 col-lg-3 col-md-4 col-12 d-none d-md-block">
 	 	  	    <?php if($nav_r_info_disable==false){ ?>
                <aside class="widget widget-contact d-none d-md-block">
			 	    <div class="contact-area">
			 	    	<?php if($r_icon!=''){ ?>
			 		   	<div class="contact-icon">
			 		   	 	<i class="<?php echo esc_attr($r_icon); ?>"></i>
			 		   	</div>
			 		   	<?php } ?>
                        <div class="contact-info">
                        	<?php if($r_title!=''){ ?>
                        	<h6 class="title"><?php echo esc_html($r_title); ?></h6>
                        	<?php } ?>

                        	<?php if($r_desc!=''){ ?>
                        	<p class="text"><?php echo wp_kses_post($r_desc); ?></p>
                        	<?php } ?>
                        </div>
			 		</div>
			 	</aside>
			 	<?php } ?>
 	 	  	</div>
 	 	</div>
 	</div>
</div>