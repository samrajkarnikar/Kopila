<?php 
/**
 * Right sidebar
 *
 *
 */
 
if ( ! is_active_sidebar('woocommerce') ) {
	return;
}
?>
<div class="col-xl-4 col-lg-4 col-md-12">
	<div class="sidebar">
		<?php dynamic_sidebar('woocommerce'); ?> 
	</div>
</div>