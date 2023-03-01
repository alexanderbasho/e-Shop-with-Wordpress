<?php
	$display_footer_widgets = alger_option('display_footer_widgets');
	$footer_fullwidth = alger_option('footer_fullwidth');
	$footer_columns = absint(alger_option('footer_columns'));
	
	if( $footer_columns == 0 )
		$footer_columns = 4;

	if( $display_footer_widgets == '1' ):
		$css_class = 'footer-widget-area';
	
	if($footer_fullwidth == '1'){
		$css_class .= ' container-fullwidth';
		
	}
	
?>
<div class="<?php echo $css_class; ?>">
<?php do_action( 'lqthemes_before_footer_widgets' );?>

<?php 
	$footer_template_part = alger_option('footer_template_part');
	if( $footer_template_part > 0 ):
	
	$elementor = get_post_meta( $footer_template_part, '_elementor_edit_mode', true );
	
	if(class_exists('Elementor\Plugin') && $elementor){
		$footer_template_part = Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $footer_template_part );
	}else{
		// Get Polylang Translation of template
		if ( function_exists( 'pll_get_post' ) ) {
			$footer_template_part = pll_get_post( $footer_template_part, pll_current_language() );
		}

		// Get template content
		if ( ! empty( $footer_template_part ) ) {

			$template = get_post( $footer_template_part );
			if ( $template && ! is_wp_error( $template ) ) {
				$footer_template_part = do_shortcode($template->post_content);
			}

		}
		}

?>
 <div class="lq-container"> 
  <?php echo $footer_template_part;?>
 </div>
 <?php endif;?>
 
     <ul class="lq-list-md-<?php echo $footer_columns;?>">
      <?php for ($i = 1; $i <= 4; $i++) : ?>
      <?php if (is_active_sidebar("footer-".$i)) : ?>
		<li>
        <?php dynamic_sidebar("footer-".$i); ?>
        </li>
        <?php endif; ?>
        <?php endfor; ?>
      </ul>
      <?php do_action( 'lqthemes_after_footer_widgets' );?>
    </div>

<?php endif; ?>