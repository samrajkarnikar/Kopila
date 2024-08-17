<?php if( has_category() ) { ?>
<div class="blog-category-list">
	<?php the_category( ' ', get_the_ID() ); ?>
</div>
<?php } ?>