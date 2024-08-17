<?php
global $shop2u_options; 
$page_title_disable = get_theme_mod('shop2u_page_title_disable',$shop2u_options['shop2u_page_title_disable']);

if( $page_title_disable == false  ){
?>
<h3 class="post-title">
	<?php the_title(); ?>
</h3>
<?php } ?>