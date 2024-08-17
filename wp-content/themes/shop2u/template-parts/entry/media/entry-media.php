<?php if( has_post_thumbnail() ): ?>
<div class="inner post_tumbnail">

	<?php if( ( ! is_single() ) ){ ?>
	<a href="<?php the_permalink(); ?>">
	<?php } ?>

		<?php the_post_thumbnail('full'); ?>
		
	<?php if( ( ! is_single() ) ){ ?>
	</a>
	<?php } ?>

	<?php if( ( ! is_single() ) ){ ?>
	<div class="blog__single-hvr"></div>
	<?php } ?>

</div>
<?php endif; ?>