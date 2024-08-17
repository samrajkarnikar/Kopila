<?php if( !is_page() ){ ?>
<span class="post-date">
	<a href="<?php echo esc_url( get_day_link(get_post_time('Y'), get_post_time('m'), get_post_time('j')));  ?>">
		<?php echo wp_kses_post(wp_date( get_option( 'date_format' ), get_post_timestamp() )); ?>
	</a>
</span>
<?php } ?>