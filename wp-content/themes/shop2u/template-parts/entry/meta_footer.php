<?php 
global $authordata;

if( !is_page() ){
?>
<div class="blog_author_name">
	<h4 class="blog-style">
		<a href="<?php echo esc_url( get_author_posts_url( $authordata->ID, $authordata->user_nicename ) ); ?>"><?php echo get_the_author(); ?></a>
	</h4>
</div>
<?php } ?>