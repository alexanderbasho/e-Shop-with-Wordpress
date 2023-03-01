<?php

/**
 * Get option
 */
function alger_option($name){
	
	global $alger_options, $alger_default_options;
		
	if(function_exists('is_customize_preview') && is_customize_preview()){
		$options = get_option(ALGER_TEXTDOMAIN);

		if( isset($options[$name]) )
			return $options[$name];
	}
	if( isset($alger_options[$name]) )
		return $alger_options[$name];
	elseif(isset($alger_default_options[$name]))
		return $alger_default_options[$name];
	else
		return '';
	}

/**
 * Get option saved in database
 */
function alger_option_saved($name){
	
	$alger_options = get_option(ALGER_TEXTDOMAIN);
	
	if( isset($alger_options[$name]) )
		return $alger_options[$name];
	else
		return '';
	}

/**
 * Selective Refresh
 */
function alger_register_partials( WP_Customize_Manager $wp_customize ) {
	
	  global $alger_customizer_options;

	// Abort if selective refresh is not available.
		if ( ! isset( $wp_customize->selective_refresh ) ) {
			return;
		}

		// Bail early if we don't have any options.
		if ( empty( $alger_customizer_options ) ) {
			return;
		}
	
	$wp_customize->selective_refresh->add_partial( 'copyright_selective', array(
		'selector' => '.copyright_selective',
		'settings' => array( 'alger[copyright]' ),
		'render_callback' => 'alger_copyright',
	) );
	
	$wp_customize->selective_refresh->add_partial( 'header_site_title', array(
		'selector' => '.site-name',
		'settings' => array( 'blogname' ),
		'render_callback' => 'alger_header_site_title',
		
	) );
	
	$wp_customize->selective_refresh->add_partial( 'header_site_description', array(
		'selector' => '.site-tagline',
		'settings' => array( 'blogdescription' ),
		'render_callback' => 'alger_header_site_descriptione',
		
	) );
	
	$wp_customize->get_section ('title_tagline')->panel = 'panel-header';
	$wp_customize->get_section ('header_image')->panel = 'panel-header';
	
}
add_action( 'customize_register', 'alger_register_partials' );

/**
 * Footer copyright information
 */

function alger_copyright(){
	
	$alger_options = get_option(ALGER_TEXTDOMAIN);
	if( isset($alger_options['copyright']) )
		return $alger_options['copyright'];
		
	}

function alger_header_site_title(){
	return get_bloginfo( 'name' );
	}

function alger_header_site_descriptione(){
	return get_bloginfo( 'description' );
	}

function alger_ajax_get_image_url(){
	
	$id = $_POST['id'];
	$image = $id;
	if (is_numeric($id)) {
			$image_attributes = wp_get_attachment_image_src($id, 'full');
			$image   = $image_attributes[0];
		  }
	echo esc_url( $image );
	exit(0);
	
	}
	
add_action('wp_ajax_alger_ajax_get_image_url', 'alger_ajax_get_image_url');
add_action('wp_ajax_nopriv_alger_ajax_get_image_url', 'alger_ajax_get_image_url');

/**
 * Include the TGM_Plugin_Activation class.
 */
if ( !class_exists( 'TGM_Plugin_Activation' ) ) 
	load_template( trailingslashit( get_template_directory() ) . 'inc/class-tgm-plugin-activation.php' );

add_action( 'tgmpa_register', 'alger_theme_register_required_plugins' );

/**
 * Register the required plugins for this theme.
 *
 */
function alger_theme_register_required_plugins() {

    $plugins = array(
		array(
			'name'     				=> __('LQThemes Companion','alger'), 
			'slug'     				=> 'lqthemes-companion',
			'source'   				=> '', 
			'required' 				=> false, 
			'version' 				=> '1.0.1', 
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '', 
		),

		array(
			'name'     				=> __('Elementor','alger'),
			'slug'     				=> 'elementor',
			'source'   				=> '',
			'required' 				=> false,
			'version' 				=> '1.0.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),

	);

    /**
     * Array of configuration settings. Amend each line as needed.
     */
    $config = array(
        'id'           => 'lqthemes-companion',
        'default_path' => '', 
        'menu'         => 'tgmpa-install-plugins', 
        'has_notices'  => true,
        'dismissable'  => true,
        'dismiss_msg'  => '',
        'is_automatic' => false,
        'message'      => '',
    );

    tgmpa( $plugins, $config );

}

/**
 * Convert Hex Code to RGB
 *
 */
 
function alger_hex2rgb( $hex ) {
	if ( strpos( $hex,'rgb' ) !== FALSE ) {

		$rgb_part = strstr( $hex, '(' );
		$rgb_part = trim($rgb_part, '(' );
		$rgb_part = rtrim($rgb_part, ')' );
		$rgb_part = explode( ',', $rgb_part );

		$rgb = array($rgb_part[0], $rgb_part[1], $rgb_part[2], $rgb_part[3]);

	} elseif( $hex == 'transparent' ) {
		$rgb = array( '255', '255', '255', '0' );
	} else {

		$hex = str_replace( '#', '', $hex );
		
		
		if( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
	}

	return $rgb;
}

/*
 * Get header widgets
 */
function alger_get_header_widgets( $key, $output = true ){
	
	$widgets = alger_option($key);
	$html = '';
	if(is_array($widgets) && !empty($widgets)):
		$html = "";
		foreach($widgets as $item):
			$html .= '<span class="alger-microwidget">';
			if($item['link']!=''){
				$html .= '<a href="'.esc_url($item['link']).'" target="'.esc_attr($item['target']).'">';
			}
			if($item['icon']!=''){
				
				$item['icon'] = str_replace('fa-','',$item['icon']);
				$item['icon'] = str_replace('fa','',$item['icon']);
				$item['icon'] = 'fa fa-'.$item['icon'];
				
				$html .= '<i class="'.esc_attr($item['icon']).'"></i>&nbsp;&nbsp;';
			}
			$html .= esc_attr($item['text']);
			if($item['link']!=''){
				$html .= '</a>';
			}
			$html .= '</span>';
		endforeach;
	endif;
	if( $output == true)
		echo $html;
	else
		return $html;
	
	}

/*
 * Get main menu hover style css class
 */
function alger_get_hover_style( $style = '1' ){
	
	switch($style){
		case '1':
			return 'hoverline-fromcenter';
		break;
		case '2':
			return 'hoverline-lefttoright';
		break;
		case '3':
			return 'hoverline-upwards';
		break;
		case '4':
			return 'hoverline-downwards';
		break;
		default:
			return 'hoverline-fromcenter';
		break;
		}
	
	}
	
/*
 * Get hover style css class
 */
 function alger_get_one_random_link(){
	 
	$post_type = new WP_Query( array(
       'post_type' => 'post',
       'orderby' => 'rand',
       'posts_per_page' => 1,
	   'ignore_sticky_posts' => 1
   ) );
 
 	$link = '';
   if ( $post_type->have_posts() ) {
		$post_type->the_post();   
		  
		$link = get_permalink();
   }
   
   
    wp_reset_postdata();
	return $link;
	
 }
 
 /*
 * Get top bar border style css class
 */
function alger_get_border_style( $style = '2' ){
	
	switch($style){
		case '1':
			return 'lq-style-solid-bg';
		break;
		case '2':
			return 'lq-style-bottom-line';
		break;
		case '3':
			return 'lq-style-bottom-line-full';
		break;
		default:
			return 'lq-style-solid-bg';
		break;
		}
	
	}
	
	 /*
 * Get footer border style css class
 */
function alger_get_footer_border_style( $style = '2' ){
	
	switch($style){
		case '1':
			return 'lq-style-solid-bg';
		break;
		case '2':
			return 'lq-style-top-line';
		break;
		case '3':
			return 'lq-style-top-line-full';
		break;
		default:
			return 'lq-style-solid-bg';
		break;
		}
	
	}

  /**
   * Custom header classes
  */
	function alger_header_classes( $classes ){
		
		$header_transparent = alger_option( 'header_transparent' );
		if( $header_transparent == '1' ){
			$classes .= ' transparent';
			}
		
		return $classes;
		
		}
	add_action('lqt_header_classes', 'alger_header_classes' );
	
  /**
   * Move customize sections
  */
  
	function alger_customize_register() {     
		global $wp_customize;
		$wp_customize->remove_section( 'colors' );
		$wp_customize->remove_section( 'background_image' );
		$wp_customize->get_control( 'custom_logo' )->section = 'section-logo';

		//$wp_customize->get_section ('background_image')->panel = 'panel-colors-background';
	  } 
	  
	  add_action( 'customize_register', 'alger_customize_register', 11 );
	 