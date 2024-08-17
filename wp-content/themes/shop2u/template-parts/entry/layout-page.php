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
		get_template_part('template-parts/entry/title-page'); 
		get_template_part('template-parts/entry/content-page'); 
		get_template_part('template-parts/entry/meta_footer'); 
		?>
	</div>
</div><!-- #post-<?php the_ID(); ?> -->