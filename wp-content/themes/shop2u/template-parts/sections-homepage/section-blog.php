<?php 
global $shop2u_options;
$section_disable = get_theme_mod('shop2u_blog_disable',$shop2u_options['shop2u_blog_disable']);
$section_subtitle = get_theme_mod('shop2u_blog_subtitle',$shop2u_options['shop2u_blog_subtitle']);
$section_title = get_theme_mod('shop2u_blog_title',$shop2u_options['shop2u_blog_title']);
$section_desc = get_theme_mod('shop2u_blog_desc',$shop2u_options['shop2u_blog_desc']);
$category = get_theme_mod('shop2u_blog_category',$shop2u_options['shop2u_blog_category']);
$posts_per_page = get_theme_mod('shop2u_blog_posts_per_page',$shop2u_options['shop2u_blog_posts_per_page']);
$column = 3;

$section_header_show = false;
if(
	$section_subtitle != '' || 
	$section_title != '' || 
	$section_desc!='' ){

	$section_header_show = true;
}

if($section_disable==false){
?>
<section class="section blog-section">
   	<div class="container">

   		<?php if( $section_header_show == true ){ ?>
   	   	<div class="row">
    	 	<div class="col-lg-7 col-md-12 col-12 mx-lg-auto mb-4">
    			<div class="sp-theme-heading text-center wow fadeInUp">
    					<?php if($section_subtitle!=''){ ?>
						<span class="badge"><?php echo wp_kses_post($section_subtitle); ?></span>
						<?php } ?>

    					<?php if($section_title!=''){ ?>
						<h2><?php echo wp_kses_post($section_title); ?></h2>
						<?php } ?>

						<?php if($section_desc!=''){ ?>
						<p><?php echo wp_kses_post($section_desc); ?></p>
						<?php } ?>
    			</div>
    		</div>
    	</div>
    	<?php } ?>

    	<div class="row wow fadeInUp">
    		<?php 
    		$column = 12 / $column;

    		global $paged;
            $paged  = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
            $args = array(
            	'post_type'      => 'post',
            	'posts_per_page' => -1,
            	'paged'          => $paged,
            );

            if($posts_per_page!=''){
        		$args['posts_per_page'] = $posts_per_page;
        	}

            if (  isset($category) ) {
                $args['category__in'] = $category;
            }
            
            $loop = new WP_Query($args);
            $wp_query = $loop;

            // Check if posts exist
			if ( $loop->have_posts() ) :

				// loop
				while ( $loop->have_posts() ) : $loop->the_post();
    		?>
	 	 	<div class="col-lg-<?php echo esc_attr($column); ?> col-md-6 col-12 mb-5">
	 	 		<div class="blog-item">
		    	 	<div id="post-<?php the_ID(); ?>" <?php post_class('blog-one__single'); ?>>
	
						<?php get_template_part('template-parts/entry/media/entry','media'); ?>

						<div class="post-meta">
							<div>
								<?php get_template_part('template-parts/entry/date'); ?>
							</div> 
						</div>
						<div class="blog-single__content">
							<?php 
							get_template_part('template-parts/entry/meta_category'); 
							get_template_part('template-parts/entry/title'); 
							?>
							<div class="entry-content">
							    <?php 
							    the_excerpt();
						        
							    shop2u_edit_link();
							    ?>
							</div>
							<?php 
							get_template_part('template-parts/entry/meta_footer'); 
							?>
						</div>
					</div><!-- #post-<?php the_ID(); ?> -->
		    	</div>
			</div> 
			<?php endwhile; wp_reset_postdata(); ?>
			<?php endif; ?>	
    	</div>
   	</div>
</section>
<?php } ?>