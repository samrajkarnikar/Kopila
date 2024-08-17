<?php 
global $shop2u_options;
$is_sticky = get_theme_mod('shop2u_h_sticky_disable',$shop2u_options['shop2u_h_sticky_disable']);
$user_icon_disable = get_theme_mod('shop2u_middle_user_icon_disable',$shop2u_options['shop2u_middle_user_icon_disable']);
$cart_icon_disable = get_theme_mod('shop2u_middle_cart_icon_disable',$shop2u_options['shop2u_middle_cart_icon_disable']);
$category_label = get_theme_mod('shop2u_bottom_category_label',$shop2u_options['shop2u_bottom_category_label']);
$category_more_label = get_theme_mod('shop2u_bottom_category_more_label',$shop2u_options['shop2u_bottom_category_more_label']);
$category_no_more_label = get_theme_mod('shop2u_bottom_category_no_more_label',$shop2u_options['shop2u_bottom_category_no_more_label']);

$navigation_class = '';
if($is_sticky==false){
	$navigation_class = 'is_sticky';
}

?>
<div class="header-navigation <?php echo esc_attr($navigation_class); ?>">
	<div class="container">
		<div class="navbar-wraper">
			<div class="row align-items-center">
				<div class="col-lg-3 col-md-12 col-12 width_low d-lg-flex d-md-none d-none align-items-center">
					<nav class="vertical-navigation">
						<button type="button" class="vertical-navigation-header">
                            <i class="fa fa-align-left bar-icon"></i>
						    <span class="vertical-navigation-title"><?php echo esc_html($category_label); ?></span>
					    </button>
					    <div class="vertical-menu">
				    	    <?php shop2u_browser_categories(); ?>
					    </div>
					</nav>
					<?php shop2u_logo(); ?>
				</div>
				<div class="col-lg-9 col-md-12 col-12 width_high">
					<nav class="navbar navbar-expand-lg">
					  	<div class="logo">
							<?php shop2u_logo(); ?>
						</div>
					  	<div class="primary-menu col text-lg-left text-md-right text-right">
					  	 	<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
								<i class="fa fa-align-left"></i>
							</button>
							<div id="navbarSupportedContent" class="collapse navbar-collapse nav-menu">
								<nav class="nav navbar-nav main-menu">
									<?php shop2u_navigations(); ?>
								</nav>								
								<button type="button" class="navbar-close"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="social-icon-header text-right mr-3"> 
		 	 	  	   		<ul id="remCart" class="right-header-list">
			 	 	  	   		<?php
			 	 	  	   		if( is_user_logged_in() ){
				                    $user_account_link = wp_logout_url( home_url() );
				                    $user_account_icon = 'fas fa-user';
				                    $user_account_title = sprintf(__('Logout','shop2u'));
				                }else{
				                    $user_account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
				                    $user_account_icon = 'far fa-user';
				                    $user_account_title = sprintf(__('Login','shop2u'));
				                }
			 	 	  	   		if($user_icon_disable==false){ ?>
			 	 	  	   	    <li class="right-header right-header-user">
			 	 	  	   			<a href="<?php echo esc_url( $user_account_link ); ?>" title="<?php echo esc_attr( $user_account_title ); ?>" class="right-icon"><i class="<?php echo esc_attr($user_account_icon); ?>"></i></a>
			 	 	  	   		</li>
			 	 	  	   		<?php } ?>

			 	 	  	   		<?php if( class_exists('woocommerce') && $cart_icon_disable==false ){ ?>
			 	 	  	   	    <li class="woocommerce right-header right-header-card">
			 	 	  	   			<a href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php echo esc_attr_e('Cart','shop2u'); ?>" class="right-card-show-btn right-icon">
			 	 	  	   			  	<i class="fas fa-shopping-cart"></i>
			 	 	  	   			</a>
			 	 	  	   			<span class="cart-count cart_value"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
			 	 	  	   			<div class="cart_popup">
			 	 	  	   				<div class="woocommerce-cart-header">
			 	 	  	   					<div class="cart-details">
			 	 	  	   						<div class="top-total-cart"><?php _e('Your Cart','shop2u'); ?></div>
			 	 	  	   						<?php woocommerce_mini_cart(); ?>
			 	 	  	   					</div>
			 	 	  	   					<div class="remove-cart">
												<a href="javascript:void(0);" class="cart-remove">
													<span class="close-wrap">
														<i class="fas fa-times"></i>
													</span>
												</a>
											</div>
			 	 	  	   				</div>
			 	 	  	   			</div>
			 	 	  	   	   	</li>
			 	 	  	   	   <?php } ?>
		 	 	  	   		</ul>
		 	 	  	    </div>						
					</nav>	
				</div> 
			</div>
		</div>
	</div>
	<div class="remove-cart-shadow"></div>
</div>