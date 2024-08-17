<?php 
global $shop2u_options;
$section_disable = get_theme_mod('shop2u_footer_above_disable',$shop2u_options['shop2u_footer_above_disable']);
$content = shop2u_footer_above_data();
if($section_disable==false){
?>
<div class="above-footer above-footer-content ">
    <div class="container">
	   	<div class="footer-top-area">
	   		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-4 g-4 wow fadeInUp">
	   			<?php 
                if(!empty($content)) { 
                    foreach ($content as $val) {
                    	$image = shop2u_get_media_url( $val['image'] );
		                $title = isset( $val['title'] ) ?  $val['title'] : '';
		                $desc = isset( $val['desc'] ) ?  $val['desc'] : '';
                ?>
	   	   	    <div class="col">
	   	   	   	    <div class="d-flex align-items-center footer-top-area-column">
	   	   	   	    	<?php if($image!=''){ ?>
	   	   	   	   	    <div class="ft-icon">
	   	   	   	   	   	   <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
	   	   	   	   	    </div>
	   	   	   	   	    <?php } ?>
	   	   	   	   	    <div class="ft-content">
	   	   	   	   	    	<?php if($title!=''){ ?>
	   	   	   	   	   	    <h5><?php echo esc_html($title); ?></h5>
	   	   	   	   	   	    <?php } ?>

	   	   	   	   	   	    <?php if($desc!=''){ ?>
	   	   	   	   	   	    <p><?php echo esc_html($desc); ?></p>
	   	   	   	   	   	    <?php } ?>
	   	   	   	   	    </div>
	   	   	   	    </div>
	   	   	    </div>
	   	   	    <?php } } ?>
	   	    </div>
	   	</div>   
    </div>
</div>
<?php } ?>