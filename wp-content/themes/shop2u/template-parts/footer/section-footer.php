<?php 
global $shop2u_options;
$bg_image = get_theme_mod('shop2u_footer_bg_image',$shop2u_options['shop2u_footer_bg_image']);
?>

<?php do_action( 'shop2u_content_after' ); ?>

</div><!-- .content -->

<?php do_action('shop2u_footer_before'); ?>

<footer class="section footer-wrapper pb-0 full-landing-image">
   	   
   <?php do_action('shop2u_footer_area'); ?>
   
   <?php if($bg_image!=''){ ?>
   <div class="bg_overlay"></div>
   <?php } ?>
</footer>

<?php do_action('shop2u_footer_after'); ?>