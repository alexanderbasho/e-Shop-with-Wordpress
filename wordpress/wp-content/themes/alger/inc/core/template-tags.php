<?php
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function alger_posted_on() {
	
	$display_category = alger_option('excerpt_display_category');
	$display_author = alger_option('excerpt_display_author');
	$display_date = alger_option('excerpt_display_date');
	
	if (is_single()){
		$display_category = alger_option('display_category');
		$display_author = alger_option('display_author');
		$display_date = alger_option('display_date');
	}

	?>
<div class="entry-meta">
           <?php if($display_date == '1' ):?>
              <span class="entry-date updated"><i class="fa fa-calendar-o" aria-hidden="true"></i> <a href="<?php echo esc_url(get_month_link(get_the_time('Y'), get_the_time('m')));?>"><?php echo get_the_date();?></a></span> 
              <?php endif; ?>
              <?php if($display_author == '1' ):?>
              <span class="entry-author author vcard" rel="author"><i class="fa fa-user-o" aria-hidden="true"></i> <span class="fn"> <?php echo get_the_author_posts_link();?></span></span>
              <?php endif; ?>
         <?php if($display_category == '1' ):?>
        <span class="entry-category"> <i class="fa fa-folder-o" aria-hidden="true"></i> 
          <?php the_category(', '); ?>
        </span>
        <?php endif; ?>
        </div>
              
             
    <?php
}

/**
 * Returns an accessibility-friendly link to edit a post or page.
 */
function alger_edit_link() {

	$link = edit_post_link(
		sprintf(
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'alger' ),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);

	return $link;
}

/**
 *  Custom comments list
 */	
function alger_comment($comment, $args, $depth) {

?>

<li <?php comment_class("comment media-comment"); ?> id="comment-<?php comment_ID() ;?>">
  <article class="comment-body">
      <footer class="comment-meta">
          <div class="comment-author vcard">
             <?php echo get_avatar($comment,'100','' ); ?>
              <b class="fn"><?php echo get_comment_author_link();?></b>
              <span class="says"><?php esc_html_e('says','alger') ;?>:</span>
          </div>
          <div class="comment-metadata">
                  <time datetime="<?php echo get_the_modified_date( DATE_W3C );?>"><?php comment_date(); ?></time> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ;?>
          </div>
      </footer>
      <div class="comment-content">
      <?php if ($comment->comment_approved == '0') : ?>
                   <em><?php esc_html_e('Your comment is awaiting moderation.','alger') ;?></em>
                   <br />
                <?php endif; ?>
         <?php comment_text() ;?>
      </div>
  </article>
</li>
                            
<?php
	}
	
/**
 * Returns breadcrumbs.
 */
function alger_breadcrumbs() {
	$delimiter = '/'; 
	$before = '<span class="current">';
	$after = '</span>';
	if ( !is_home() && !is_front_page() || is_paged() ) {
		echo '<div itemscope itemtype="http://schema.org/WebPage" id="crumbs"><i class="fa fa-home"></i>';
		global $post;
		$homeLink = esc_url(home_url());
		echo ' <a itemprop="breadcrumb" href="' . $homeLink . '">' . esc_html__( 'Home' , 'alger' ) . '</a> ' . $delimiter . ' ';
		if ( is_category() ) {
			global $wp_query;
			$cat_obj = $wp_query->get_queried_object();
			$thisCat = $cat_obj->term_id;
			$thisCat = get_category($thisCat);
			$parentCat = get_category($thisCat->parent);
			if ($thisCat->parent != 0){
				$cat_code = get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
			}
			echo $before . '' . single_cat_title('', false) . '' . $after;
		} elseif ( is_day() ) {
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo '<a itemprop="breadcrumb"  href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('d') . $after;
		} elseif ( is_month() ) {
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			echo $before . get_the_time('F') . $after;
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				echo '<a itemprop="breadcrumb" href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' ';
				echo $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cat_code = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				echo $cat_code = str_replace ('<a','<a itemprop="breadcrumb"', $cat_code );
				echo $before . get_the_title() . $after;
			}
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' ) {
			$post_type = get_post_type_object(get_post_type());
			if ($post_type)
			echo $before . $post_type->labels->singular_name . $after;
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = isset($cat[0])?$cat[0]:'';
			echo '<a itemprop="breadcrumb" href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;
		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a itemprop="breadcrumb" href="' .esc_url( get_permalink($page->ID)) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter . ' ';
			echo $before . get_the_title() . $after;
		} elseif ( is_search() ) {
			echo $before ;
			printf( __( 'Search Results for: %s', 'alger' ),  get_search_query() );
			echo  $after;
		} elseif ( is_tag() ) {
			echo $before ;
			printf( __( 'Tag Archives: %s', 'alger' ), single_tag_title( '', false ) );
			echo  $after;
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before ;
			printf( __( 'Author Archives: %s', 'alger' ),  $userdata->display_name );
			echo  $after;
		} elseif ( is_404() ) {
			echo $before;
			_e( 'Not Found', 'alger' );
			echo  $after;
		}
		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() )
				echo sprintf( __( '( Page %s )', 'alger' ), get_query_var('paged') );
		}
		echo '</div>';
	}
}

/**
 * Get sidebar
 */
function alger_get_sidebar($layout,$type){
	if($layout=='' || $layout == 'none' || $layout == 'no' )
		return '';
	?>
	<div class="col-aside-<?php echo $layout; ?>">
    <?php do_action('lqt_before_sidebar');?>
      <aside class="blog-side left text-left">
          <div class="widget-area">
             <?php get_sidebar($type);?>
          </div>
        </aside>
        <?php do_action('lqt_after_sidebar');?>
      </div>
<?php
	}
	
/**
 * Add script to the footer
 *
 */
function alger_footer_script(){
	
	$display_scroll_to_top = alger_option('display_scroll_to_top');
	$scroll_btn_position = alger_option('scroll_btn_position');
	
	if($display_scroll_to_top=='1' ){
		$css_class = 'back-to-top';
		$css_class .= ' '.$scroll_btn_position;
		
		echo '<div class="'.$css_class.'"></div>';
		}

 } 
add_action('wp_footer','alger_footer_script');

/**
 * Add title bar
 *
 */
function alger_page_title_bar( $content, $type='page' ){
	
	$display_titlebar_default   = alger_option('display_titlebar');
	$display_breadcrumb_default = alger_option('display_breadcrumb');
	
	
	
	$display_titlebar = apply_filters( 'lqt_display_titlebar', $display_titlebar_default );
	$display_breadcrumb = apply_filters( 'lqt_display_breadcrumb', $display_breadcrumb_default );
	
	if( $display_titlebar == 'default' )
		$display_titlebar   = $display_titlebar_default;
	
	if( $display_breadcrumb == 'default' )
		$display_breadcrumb   = $display_breadcrumb_default;
	
	if( $display_titlebar != '1' )
		return '';
	
    $title_bar_layout_default = alger_option('title_bar_layout');
	$title_bar_layout = apply_filters('lqt_title_bar_layout',$title_bar_layout_default);
	
	if( $title_bar_layout == 'default' )
		$title_bar_layout   = $title_bar_layout_default;
	
	$title_bar_css = apply_filters('lqt_title_bar_css', '' );
	
		
	$class = 'page-title-bar '.$title_bar_layout;
	$html = '<section class="'.$class.'" style="'.$title_bar_css.'">';
	$html .= '<div class="lq-container">';
	$html .= '<div class="page-title-bar-inner">';
	 
   	$html .= ' <hgroup class="page-title">';
	if ( class_exists( 'WooCommerce' ) && function_exists('is_shop') && is_shop()){
		$html .= '<h1 class="woocommerce-products-header__title page-title">'. woocommerce_page_title(false).'</h1>';
	}
    elseif ( class_exists( 'WooCommerce' ) && (is_product_category() || is_product_tag()) ){
        $html .= '<h1 class="woocommerce-products-header__title page-title">'.single_term_title('',false).'</h1>';
	}elseif( is_home() ){
		 $header_custom_text = alger_option('header_custom_text');
		$html .= '<h2>'.wp_kses_post( $header_custom_text ).'</h2>';
	}elseif(  is_single() ){
		$html .= '<h2>'.get_the_title().'</h2>';
	}elseif(is_singular()){
   		$html .= '<h1>'.get_the_title().'</h1>';
	}elseif(is_category()){
   		$html .= '<h1>'.single_cat_title('', false).'</h1>';
	}elseif(is_archive()){
   		$html .= '<h1>'.get_the_archive_title().'</h1>';
	}
	
    $html .= '</hgroup>';

	 
	 if( $display_breadcrumb == '1' ){
		$html .= '<div class="breadcrumb-nav">';
		ob_start();
		alger_breadcrumbs();
		$html .= ob_get_contents();
		ob_end_clean();
		$html .= '</div>';
	 }
	
	$html .= '</div>';
	$html .= '</div>';
	$html .= '</section>';

	return $html;
	
	}

add_filter( 'alger_page_title_bar', 'alger_page_title_bar', 10, 2 );


/**
 * Add menu shoping cart
 *
 */
function alger_add_cart_single_ajax() {
	
	$html = '';
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ), true ) ) {
		ob_start();
		the_widget( 'WC_Widget_Cart' );
		$html = ob_get_clean();
	}
	return $html;
}
add_filter('alger_shopping_cart','alger_add_cart_single_ajax', 10, 2);


/**
 * Container before page content
 *
 */
 
function alger_container_before_page( $layout ){
  
	$sidebar_layout = apply_filters('lqthemes_page_sidebar_layout', alger_option( $layout ));
	
	switch($sidebar_layout){
		case 'left':
			$aside_class = 'left-aside';
		break;
		case 'right':
			$aside_class = 'right-aside';
		break;
		default:
			$aside_class = 'no-aside';
		break;
		
		};
		
	$html = '<main id="main" class="page-wrap '.$aside_class.'">
            <div class="lq-container">
                <div class="lq-row">';

		echo $html;
	
	}
/**
 * Container after page content
 *
 */
 function alger_container_after_page( $layout, $type = 'page' ){
	 
	$sidebar_layout = apply_filters('lqthemes_page_sidebar_layout',alger_option( $layout ));

	alger_get_sidebar($sidebar_layout,$type);
                        
       echo '</div>
                </div>
            </div>  
        </main>';
	}

/**
 * Footer of single page content
 *
 */
function alger_get_post_footer(){

	echo '<div class="entry-footer clearfix">';
    echo '<div class="pull-left"> ';

	if(get_the_tag_list()) {
		echo get_the_tag_list(__( 'Tags: ', 'alger' ),', ');
	}

    echo '</div>';
    echo '</div>';

	}

/**
 * Get post attributes
 *
 */
function alger_get_post_attributes(){
	?>
   <nav class="navigation pagination" role="navigation">
                                <div class="nav-links">
<?php the_posts_pagination( array(
					'prev_text' => '<i class="fa fa-arrow-left"></i><span class="screen-reader-text">' . esc_html__( 'Previous page', 'alger' ) . '</span>',
					'next_text' => '<span class="screen-reader-text">' . esc_html__( 'Next page', 'alger' ) . '</span><i class="fa fa-arrow-right"></i>' ,
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'alger' ) . ' </span>',
				) );?>
</div>
</nav>
    <?php
}

/**
 * Get blog list style css class
 *
 */
function alger_get_blog_style(){
	
	$blog_style = absint(alger_option( 'blog_list_style'));
	$wrap_class = '';
	switch($blog_style){
		case '1':
			$wrap_class = 'blog-list-wrap';
		break;
		case '2':
			$wrap_class = 'blog-list-wrap blog-aside-image';
		break;
		case '3':
			$wrap_class = 'blog-list-wrap blog-grid';
		break;
		default:
			$wrap_class = 'blog-list-wrap';
		break;
		
		};
	return $wrap_class;
	}
	
add_filter( 'comment_form_fields', 'alger_move_comment_field' );
function alger_move_comment_field( $fields ) {
    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

/*
 * Add admin about page
 */
function alger_admin_menu(){
	
	add_theme_page( __( 'About Alger', 'alger' ), __( 'About Alger', 'alger' ), 'manage_options', 'about-alger','alger_about_alger');
	
	}
add_action( 'admin_menu', 'alger_admin_menu' );

function alger_about_alger(){
	
	?>

    <div class="alger-info-wrap">
  <h1><?php  _e( 'Welcome to Alger WordPress Theme', 'alger' ) ?></h1>
  <p>
  <?php  _e( 'Alger is the perfect theme which could be used to build one page sites for design agency, corporate, restaurant, personal, showcase, magazine, portfolio, ecommerce, etc. The theme is compatible with Elementor, the most popular drag & drop page builder, which you could use to create elegant sites with no code knowledge. We have designed various specific elements and elegant frontpage template for the plugin which can help you create a site like the demo with just several steps. Alger also offers various options for header, footer, pages & posts, etc. And it is compatible with WooCommerce, Polylang, WPML, Contact Form 7, etc.', 'alger' ) ?>
  </p>
  <div class="alger-column-left">
    <div class="alger-message">
      <h2><?php _e( 'Import demo sites', 'alger' ); ?></h2>
      
      <?php
	   if ( function_exists( 'is_plugin_active' ) && is_plugin_active('lqthemes-companion/lqthemes-companion.php') ) {
    			
			?>
      <p><?php  printf(__( 'Alger offers a free library of <a href="%s">demo sites</a>. Import your favorite one by just one click.', 'alger' ),admin_url('themes.php?page=lqthemes-sites')); ?></p>
      <?php }else{?>
      		 <p><?php  _e( 'Alger offers a free library of demo sites. Import your favorite one by just one click.', 'alger' ); ?></p>
      <?php }?>
      <?php
	   if ( function_exists( 'is_plugin_active' ) && !is_plugin_active('lqthemes-companion/lqthemes-companion.php') ) {
    			
			?>
      <p><a href="<?php echo esc_url(admin_url('themes.php?page=tgmpa-install-plugins&plugin_status=install'));?>" class="button"><?php _e( 'Install the plugins', 'alger' ); ?></a></p>
      <?php }?>
    </div>
    <div class="alger-message">
  <h2><?php _e( 'Start to customize your site', 'alger' ); ?></h2>
  <ul class="alger-customize-list">
    
<li>
      <div class="alger-customize-box">
        <h4><?php _e( 'Upload Your Logo', 'alger' ); ?></h4>
        <p class="alger-customize-desc"><?php _e( 'Add your own logo for the header.', 'alger' ); ?></p>
        <p class="alger-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=custom_logo'));?>"><?php _e( 'Navigate to the option', 'alger' ); ?></a></p>
      </div>
    </li>
<li>
      <div class="alger-customize-box">
        <h4><?php _e( 'Upload Favicon', 'alger' ); ?></h4>
        <p class="alger-customize-desc"><?php _e( 'Set the icon that would display as browser and app icon.', 'alger' ); ?></p>
        <p class="alger-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=site_icon'));?>"><?php _e( 'Navigate to the option', 'alger' ); ?></a></p>
      </div>
    </li>
<li>
      <div class="alger-customize-box">
        <h4><?php _e( 'Sidebar Settings', 'alger' ); ?></h4>
        <p class="alger-customize-desc"><?php _e( 'Set sidebar for pages & posts.', 'alger' ); ?></p>
        <p class="alger-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=alger[page_sidebar_layout]'));?>"><?php _e( 'Navigate to the option', 'alger' ); ?></a></p>
      </div>
    </li>
<li>
      <div class="alger-customize-box">
        <h4><?php _e( 'Blog Settings', 'alger' ); ?></h4>
        <p class="alger-customize-desc"><?php _e( 'Set contents display in archive pages & posts.', 'alger' ); ?></p>
        <p class="alger-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=alger[display_feature_image]'));?>"><?php _e( 'Navigate to the option', 'alger' ); ?></a></p>
      </div>
    </li><li>
      <div class="alger-customize-box">
        <h4><?php _e( 'Typography Settings', 'alger' ); ?></h4>
        <p class="alger-customize-desc"><?php _e( 'Choose your own typography for any parts of your website.', 'alger' ); ?></p>
        <p class="alger-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php'));?>"><?php _e( 'Navigate to the option', 'alger' ); ?></a></p>
      </div>
    </li>
    
    <li>
      <div class="alger-customize-box">
        <h4><?php _e( 'Top Bar Options', 'alger' ); ?></h4>
        <p class="alger-customize-desc"><?php _e( 'Set info for the top bar above header.', 'alger' ); ?></p>
        <p class="alger-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=alger[display_topbar]'));?>"><?php _e( 'Navigate to the option', 'alger' ); ?></a></p>
      </div>
    </li>
    
    <li>
      <div class="alger-customize-box">
        <h4><?php _e( 'Header Options', 'alger' ); ?></h4>
        <p class="alger-customize-desc"><?php _e( 'Set layout for the default header.', 'alger' ); ?></p>
        <p class="alger-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=alger[header_style]'));?>"><?php _e( 'Navigate to the option', 'alger' ); ?></a></p>
      </div>
    </li>
    
    <li>
      <div class="alger-customize-box">
        <h4><?php _e( 'Footer Widgets Options', 'alger' ); ?></h4>
        <p class="alger-customize-desc"><?php _e( 'Choose to display & customize the widget areas in the footer.', 'alger' ); ?></p>
        <p class="alger-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=alger[display_footer_widgets]'));?>"><?php _e( 'Navigate to the option', 'alger' ); ?></a></p>
      </div>
    </li>
    
     <li>
      <div class="alger-customize-box">
        <h4><?php _e( 'Footer Info Options', 'alger' ); ?></h4>
        <p class="alger-customize-desc"><?php _e( 'Insert copyright info and social icons in the footer.', 'alger' ); ?></p>
        <p class="alger-customize-link"><a target="_blank" href="<?php echo esc_url(admin_url('customize.php?autofocus%5Bcontrol%5D=alger[display_footer_icons]'));?>"><?php _e( 'Navigate to the option', 'alger' ); ?></a></p>
      </div>
    </li>

    
  </ul>
</div>
  </div>
  <div class="alger-column-right">
    <div class="alger-message"><h4><?php _e( 'Review Alger on WordPress', 'alger' ); ?></h4><p><?php _e( 'We are grateful that you have chose our theme. If you like Alger, please take 1 minitue to post your review on Wordpress. Few words of ppreciation also motivates the development team.', 'alger' ); ?></p><p><a class="button" target="_blank" href="https://wordpress.org/support/theme/alger/reviews/#new-post"> <?php _e( 'Post Your Review', 'alger' ); ?> </a></p></div>
    <div class="alger-message"><p><?php _e( 'More info could be found at the manual.', 'alger' ); ?></p><p><a class="button" target="_blank" href="https://lqthemes.com/alger-documentation/"><?php _e( 'Step-by-step Manual', 'alger' ); ?></a></p></div>
    <div class="alger-message"><p><?php _e( 'If you have checked the documentation and still having an issue, please post in the support thread.', 'alger' ); ?></p><p><a class="button" target="_blank" href="https://wordpress.org/support/theme/alger"><?php _e( 'Support Thread', 'alger' ); ?></a></p></div>
    <div class="alger-message">
      <h4><?php _e( 'FAQ', 'alger' ); ?></h4>
      <p><a class="" target="_blank" href="https://lqthemes.com/faq/#1"><?php _e( 'How to Create Child Theme?', 'alger' ); ?></a></p>
      <p><a class="" target="_blank" href="https://lqthemes.com/faq/#2"><?php _e( 'How to Add Custom CSS to Your Website?', 'alger' ); ?></a></p>
      <p><a class="" target="_blank" href="https://lqthemes.com/faq/#3"><?php _e( 'How to Translate the Theme?', 'alger' ); ?></a></p>
      <p><a class="" target="_blank" href="https://lqthemes.com/faq/#4"><?php _e( 'How to Make Your Site Multilingual?', 'alger' ); ?></a></p>
      <p><a class="" target="_blank" href="https://lqthemes.com/faq/#5"><?php _e( 'How to Make Your Site Multilingual?', 'alger' ); ?>x</a></p>
    </div>
  </div>
</div>
    <?php	
}