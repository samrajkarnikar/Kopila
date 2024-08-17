<?php 
global $shop2u_options;
$section_disable = get_theme_mod('shop2u_breadcrumb_disable',$shop2u_options['shop2u_breadcrumb_disable']);
$breadcrumb_title_disable = get_theme_mod('shop2u_breadcrumb_title_disable',$shop2u_options['shop2u_breadcrumb_title_disable']);
$breadcrumb_path_disable = get_theme_mod('shop2u_breadcrumb_path_disable',$shop2u_options['shop2u_breadcrumb_path_disable']);
$bg_image = get_theme_mod('shop2u_breadcrumb_bg_image',$shop2u_options['shop2u_breadcrumb_bg_image']);
if($section_disable==false){
?>
<section class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-content">					
					<?php 
					if($breadcrumb_title_disable==false){
						shop2u_breadcrumbs_title();
					}

					if($breadcrumb_path_disable==false){
						shop2u_breadcrumbs();
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php if( class_exists('woocommerce') ){ ?>
	<div class="breadcrumb-icon-bag">
		<a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="brad_bag_icon">
			<i class="fas fa-shopping-bag"></i>
		</a>
	</div>
	<?php } ?>

	<?php if($bg_image!=''){ ?>
	<div class="bg_overlay"></div>
	<?php } ?>
</section>
<?php } ?>