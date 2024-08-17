<?php 
global $shop2u_options;
$section_disable = get_theme_mod('shop2u_footer_copyright_disable',$shop2u_options['shop2u_footer_copyright_disable']);
$copyright = get_theme_mod('shop2u_footer_copyright',$shop2u_options['shop2u_footer_copyright']);

if( SHOP2U_THEME_NAME == 'Shop2u Pro' && $copyright!='' ){
  $ft_copyright = $copyright;
}else{

  $copyright .= sprintf( 
    __( 'Copyright %1$s, Powered by %2$s', 'shop2u' ), 
    '%copy% %current_year%', 
    '<a href="' . esc_url( 'https://www.wordpress.org/', 'shop2u' ) . '">WordPress</a>' 
    );

  $ft_copyright = sprintf( 
    __( '%1$s <span>&ndash;</span>', 'shop2u' ), 
    $copyright,
    );

  $ft_copyright .= sprintf( 
    __( ' %1$s theme by %2$s', 'shop2u' ), 
    '<a href="' . esc_url( 'https://www.britetechs.com/', 'shop2u' ) . '">Shop2u</a>', 
    'Britetechs' 
    );
}

$options = array(
	'%current_year%',
	'%copy%'
);

$replace = array(
	date('Y'),
	'&copy;'
);

$copyright = str_replace( $options, $replace, $ft_copyright );

if($section_disable==false){
?>
<div class="copy-right"> 
    <div class="row">
        <div class="col-12 text-center">
        	<?php if($copyright!=''){ ?>
            <div class="copyright-text">        
			    <p><?php echo wp_kses_post($copyright); ?></p>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>