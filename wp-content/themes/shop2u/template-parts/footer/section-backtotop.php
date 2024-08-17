<?php 
global $shop2u_options;
$section_disable = get_theme_mod('shop2u_backTotop_disable',$shop2u_options['shop2u_backTotop_disable']);
if($section_disable==false){
?>
<div class="sp-go-top-area">
   <div class="sp-go-top-wrap">
      <div  class="sp-go-top-btn-wrap">
         <div id="back-to-top" class="go-top go-top-btn">
            <i class="fa fa-angle-double-up"></i>
            <i class="fa fa-angle-double-up"></i>
         </div>
      </div>
   </div>
</div>
<?php } ?>