<?php get_header();	?>
<?php echo apply_filters('alger_page_title_bar','','page');?>  
<?php alger_container_before_page( 'page_sidebar_layout' ); ?>
<div class="col-main">
 <section class="post-main" role="main" id="content">
<?php do_action('lqt_before_page_content');?>
<?php
	/* Start the Loop */
	while ( have_posts() ) : the_post();

		get_template_part( 'template-parts/page/content' );

		the_posts_pagination( array(
		'prev_text' => '<i class="fa fa-arrow-left"></i><span class="screen-reader-text">' . esc_html__( 'Previous page', 'alger' ) . '</span>',
		'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'alger' ) . '</span><i class="fa fa-arrow-right"></i>' ,
		'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'alger' ) . ' </span>',
	) );

	endwhile; // End of the loop.
?>
<?php do_action('lqt_after_page_content');?>    
</section>
</div>     
<?php alger_container_after_page( 'page_sidebar_layout', 'page' );?>
<?php do_action('lqt_after_page_wrap');?>

<?php get_footer();