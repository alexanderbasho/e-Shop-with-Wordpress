<?php

	get_header();

?>

<?php echo apply_filters('alger_page_title_bar','','category');?> 

<?php alger_container_before_page( 'blog_archives_sidebar_layout' ); ?>

	<div class="col-main">

      <section class="post-main" role="main" id="content">

          <div class="<?php echo alger_get_blog_style(); ?>">

              

          <?php

              if ( have_posts() ) :

                  while ( have_posts() ) : the_post();

                      get_template_part( 'template-parts/post/content', get_post_format() );

                  endwhile;

              

              else :

                  get_template_part( 'template-parts/post/content', 'none' );

              

              endif;

          ?> 

              

          </div>

          

         <?php alger_get_post_attributes(); ?> 

                           

      </section>

  </div>

<?php alger_container_after_page( 'blog_archives_sidebar_layout', 'archives' );?>

<?php get_footer();