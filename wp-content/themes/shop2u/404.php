<?php
get_header();
get_template_part('template-parts/section-breadcrumbs');
global $shop2u_options;
$error_code = get_theme_mod('shop2u_error_code',$shop2u_options['shop2u_error_code']);
$error_title = get_theme_mod('shop2u_error_title',$shop2u_options['shop2u_error_title']);
$error_desc = get_theme_mod('shop2u_error_desc',$shop2u_options['shop2u_error_desc']);
$error_btn_label = get_theme_mod('shop2u_error_btn_label',$shop2u_options['shop2u_error_btn_label']);
?>
<section class="section section-404 bg-dots_section">
	<div class="container">
	    <div class="row">
	    	<div class="col-lg-8 col-12 m-auto text-center">
	    		<div class="sp-card-404">
	    			<?php if($error_code!=''){ ?>
	    			<h2 class="sp-404-title"><?php echo esc_html($error_code); ?></h2>
	    			<?php } ?>
	    			
	    			<?php if($error_title!=''){ ?>
	    			<h4><?php echo wp_kses_post($error_title); ?></h4>
	    			<?php } ?>

	    			<?php if($error_desc!=''){ ?>
	    			<p><?php echo wp_kses_post($error_desc); ?></p>
	    			<?php } ?>

	    			<div class="sp-404-btn mt-4">
	    				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary main-btn"><i class="fa fa-share"></i> <?php echo esc_html($error_btn_label); ?></a>
	    			</div>
	    		</div>
	    	</div>
	    </div>		
	</div>
</section>
<?php get_footer(); ?>