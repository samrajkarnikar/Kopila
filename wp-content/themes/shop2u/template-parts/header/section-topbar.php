<?php 
global $shop2u_options;
$section_disable = get_theme_mod('shop2u_topbar_disable',$shop2u_options['shop2u_topbar_disable']);
$content_left = shop2u_above_left_data();
$content_right = shop2u_above_right_data();
if($section_disable==false){
?>
<div id="info-bar" class="info-bar d-none d-xl-block wow fadeInDown">
 	<div class="container">
 	 	<div class="row ">
 	 	 	<div class="col-lg-6 col-md-6 col-12">
 	 	 	 	<div class="top-bar-inner column left ">
 	 	 	 		<?php 
		            if(!empty($content_left)) { 
		                foreach ($content_left as $val) {
		                    $title = isset( $val['title'] ) ?  $val['title'] : '';
		            ?>
 	 	 	 	 	<span><?php echo esc_html($title); ?></span>
 	 	 	 	 	<?php } } ?>
 	 	 	 	</div>
 	 	 	</div>
 	 	 	<div class="col-lg-6 col-md-6 col-12 right">
 	 	 	 	<div class="top-bar-inner column">
 	 	 	 		<?php 
		            if(!empty($content_right)) { 
		                foreach ($content_right as $val) {
		                    $icon = isset( $val['icon'] ) ?  $val['icon'] : '';
		                    $title = isset( $val['title'] ) ?  $val['title'] : '';
		            ?>
 	 	 	 		<div class="topbar-right topbar-phone">
 	 	 	 			<span>
 	 	 	 				<i class="<?php echo esc_attr($icon); ?> mr-1"></i>
 	 	 	 				<?php echo esc_html($title); ?>
 	 	 	 			</span>
 	 	 	 		</div>
 	 	 	 		<?php } } ?>
 	 	 	 	</div>
 	 	 	</div>
	 	</div>
 	</div>
</div>
<?php } ?>