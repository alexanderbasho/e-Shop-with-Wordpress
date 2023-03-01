<?php

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/**
 * Defines customizer options
 */

function alger_customizer_library_options() {
	
	global $alger_default_options, $alger_customizer_options, $wp_version;

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;
	
	$imagepath = get_template_directory_uri().'/assets/images/';
	
	$menus = array( esc_html__( 'Default', 'alger' ) );
		  $get_menus 	= get_terms( 'nav_menu', array( 'hide_empty' => true ) );
		  foreach ( $get_menus as $menu) {
			  $menus[$menu->slug] = $menu->name;
	}
	
	$templates = array( 0 => esc_html__( 'Select a Template', 'alger' ) );
	$get_templates = get_posts( array( 'post_type' => 'lq_template_part', 'numberposts' => -1, 'post_status' => 'publish' ) );

	if ( ! empty ( $get_templates ) ) {
		foreach ( $get_templates as $template ) {
			$templates[ $template->ID ] = $template->post_title;
		}
	}
	
	
	$target = array(
		'_blank' => __( 'Blank', 'alger' ),
		'_self'  => __( 'Self', 'alger' )
	);
	
	$transport = 'refresh';
	
	// General Options
	$panel = 'alger-general-options';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'Alger: General Options', 'alger' ),
		'priority' => '1'
	);
	
	$section = 'general-settings';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'General Settings', 'alger' ),
		'priority' => '1',
		'panel' => $panel
	);

	$options['body_layout'] = array(
			'settings' => 'body_layout',
			'label'   => __( 'Layout', 'alger' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
				'wide'=> __( 'Wide', 'alger' ),
				'boxed'=> __( 'Boxed', 'alger' ),
				),
			'transport' => $transport,
			'default' => 'wide',
			'description'   => __( 'Body layout.', 'alger' ),
			
		);
	
	$options['box_width'] = array(
			'settings' => 'box_width',
			'label'   => __( 'Box Width', 'alger' ),
			'section' => $section,
			'type'    => 'text',
			'transport' => $transport,
			'default' => '1200px',
			'description'   => '',
			'active_callback'   => array(
				  array(
					'setting'  		=> 'body_layout',
					'operator' 		=> '==',
					'value'    		=> 'boxed',
				  ),
				),
			
		);
	
	$options['container_width'] = array(
			'settings' => 'container_width',
			'label'   => __( 'Container Width', 'alger' ),
			'section' => $section,
			'type'    => 'text',
			'transport' => $transport,
			'default' => '1140px',
			'description'   => '',
			'output'      => array(
				  array(
					  'element' => '.lq-container,.lq-top-bar,.lq-main-header,.lq-mobile-main-header',
					  'property' => 'width' 
				  ),
			  ),
			
		);
	
	$options['body_background'] = array(
		'settings' => 'body_background',
		'label'   => __( 'Body Background', 'alger' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'background',
		'transport' => $transport,
		'default' => array( 'background-color' => '#ffffff' ),
		'output'      => array(
			array(
				'element' => 'body',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$options['content_wrapper_background'] = array(
		'settings' => 'content_wrapper_background',
		'label'   => __( 'Content Wrapper Background', 'alger' ),
		'priority' => '2',
		'section' => $section,
		'type'    => 'background',
		'transport' => $transport,
		'default' => array( 'background-color' => '#ffffff' ),
		'output'      => array(
			array(
				'element' => 'body > .wrapper',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
		'active_callback'   => array(
				  array(
					'setting'  		=> 'body_layout',
					'operator' 		=> '==',
					'value'    		=> 'boxed',
				  ),
				),
	);
	
	$options['primary_color'] = array(
		'settings' => 'primary_color',
		'label'   => __( 'Primary Color', 'alger' ),
		'priority' => '2',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#00dfb8',
	);
	
	$options['body_font_color'] = array(
		'settings' => 'body_font_color',
		'label'   => __( 'Body Font Color', 'alger' ),
		'priority' => '3',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => 'html, body',
				'property' => 'color'
			),
		)
	);
	
	$options['link_color'] = array(
		'settings' => 'link_color',
		'label'   => __( 'Link Color', 'alger' ),
		'priority' => '3',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#a0a0a0',
		'output'      => array(
			array(
				'element' => 'a',
				'property' => 'color'
			),
		)
	);
	
	$options['link_hover_color'] = array(
		'settings' => 'link_hover_color',
		'label'   => __( 'Link Hover Color', 'alger' ),
		'priority' => '3',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => 'a:hover, .entry-meta a:hover, a:active,.lq-header .lq-main-nav > li > a:hover,
.lq-header .lq-main-nav > li.active > a,.woocommerce nav.woocommerce-pagination ul li a:focus,
.woocommerce nav.woocommerce-pagination ul li a:hover',
				'property' => 'color'
			),
		)
	);
	
	$options['h1_font_color'] = array(
		'settings' => 'h1_font_color',
		'label'   => __( 'H1 Font Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => 'h1',
				'property' => 'color'
			),
		)
	);
	
	$options['h2_font_color'] = array(
		'settings' => 'h2_font_color',
		'label'   => __( 'H2 Font Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => 'h2',
				'property' => 'color'
			),
		)
	);
	
	$options['h3_font_color'] = array(
		'settings' => 'h3_font_color',
		'label'   => __( 'H3 Font Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => 'h3',
				'property' => 'color'
			),
		)
	);
	
	$options['h4_font_color'] = array(
		'settings' => 'h4_font_color',
		'label'   => __( 'H4 Font Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => 'h4',
				'property' => 'color'
			),
		)
	);
	
	$options['h5_font_color'] = array(
		'settings' => 'h5_font_color',
		'label'   => __( 'H5 Font Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => 'h5',
				'property' => 'color'
			),
		)
	);
	
	$options['h6_font_color'] = array(
		'settings' => 'h6_font_color',
		'label'   => __( 'H6 Font Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => 'h6',
				'property' => 'color'
			),
		)
	);
	
	// section title bar
	$section = 'alger-section-title-bar';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Page Title Bar', 'alger' ),
		'priority' => '2',
		'panel' => $panel
	);
	
	$options['display_titlebar'] = array(
			'settings' => 'display_titlebar',
			'label'   => __( 'Display Title Bar', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			'transport' => $transport,
		);
	
	$options['display_breadcrumb'] = array(
			'settings' => 'display_breadcrumb',
			'label'   => __( 'Display Breadcrumb', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			'transport' => $transport,
			'active_callback'   => array(
				  array(
					'setting'  		=> 'display_titlebar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
		);
		
	$options['title_bar_layout'] = array(
			'settings' => 'title_bar_layout',
			'label'   => __( 'Title Bar Layout', 'alger' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
				'title-left'=> __( 'Left Title, right breadcrumbs', 'alger' ),
				'title-right'=> __( 'Right Title, left breadcrumbs', 'alger' ),
				'title-center'=> __( 'Center', 'alger' ),
				'title-left2'=> __( 'Left', 'alger' ),
				'title-right2'=> __( 'Right', 'alger' )
				),
			'transport' => $transport,
			'default' => 'title-left',
			'description'   => __( 'Title only works on pages.', 'alger' ),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'display_titlebar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
			
		);
	
	$options['page_title_bar_background1'] = array(
		'settings' => 'page_title_bar_background1',
		'label'   => __( 'Page Title Bar Background', 'alger' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'background',
		'transport' => $transport,
		'default' => array( 'background-color' => '#f5f5f5' ),
		'output'      => array(
			array(
				'element' => '.page-title-bar',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$options['title_bar_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'title_bar_padding',
		'label'       => esc_attr__( 'Padding', 'alger' ),
		'description' => '',
		'section'     => $section,
		'default'     => array(
			'padding-top'    => '30px',
			'padding-bottom' => '30px',
			'padding-left'   => '0',
			'padding-right'  => '0',
		),
		'output'      => array(
			array(
				'element' => '.page-title-bar',
			),
		),
		'active_callback'   => array(
				  array(
					'setting'  		=> 'display_titlebar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
	);
	
	
	$options['page_title_font_color'] = array(
		'settings' => 'page_title_font_color',
		'label'   => __( 'Font Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.page-title, .page-title-bar-inner .page-title h1, .page-title-bar-inner .page-title h2, body .page-title-bar a, .page-title-bar span,.page-title-bar i,.page-title-bar div',
				'property' => 'color'
			),
		)
	);
	
	$options['title_bar_link_color'] = array(
		'settings' => 'title_bar_link_color',
		'label'   => __( 'Link Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.page-title-bar-inner a',
				'property' => 'color'
			),
		)
	);
	
	$options['title_bar_link_hover_color'] = array(
		'settings' => 'title_bar_link_hover_color',
		'label'   => __( 'Link Hover Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.page-title-bar-inner a:hover',
				'property' => 'color'
			),
		)
	);


	$section = 'section-sidebar-options';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Sidebar', 'alger' ),
		'priority' => '11',
		'panel' => $panel
	);
	// Sidebar
	
	$options['sidebar_width'] = array(
			'settings' => 'sidebar_width',
			'label'   => __( 'Sidebar Width( in % )', 'alger' ),
			'section' => $section,
			'type'    => 'slider',
			'transport' => $transport,
			'default' => '25',
			'description'   => '',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 100,
				'step'   => 1,
				'suffix' => '%',
  			),
			
		);
	
	$options['page_sidebar_layout'] = array(
		'settings' => 'page_sidebar_layout',
		'label'   => __( 'Sidebar: Pages', 'alger' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'right',
		'choices' => array(
				'no'=> $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
	
	$options['blog_sidebar_layout'] = array(
		'settings' => 'blog_sidebar_layout',
		'label'   => __( 'Sidebar: Single Post', 'alger' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'right',

		'choices' => array(
				'no'=>  $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
	
	$options['blog_archives_sidebar_layout'] = array(
		'settings' => 'blog_archives_sidebar_layout',
		'label'   => __( 'Sidebar: Posts Archive', 'alger' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'right',
		'choices' => array( 'no' =>__( 'No Sidebar', 'alger' ),'left'=>__( 'Left Sidebar', 'alger' ),'right'=>__( 'Right Sidebar', 'alger' ) ),
		'choices' => array(
				'no'=> $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
		
	$options['woo_single_sidebar_layout'] = array(
		'settings' => 'woo_single_sidebar_layout',
		'label'   => __( 'Sidebar: WooCommerce Single Product', 'alger' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'no',
		'choices' => array('no' =>__( 'No Sidebar', 'alger' ),'left'=>__( 'Left Sidebar', 'alger' ),'right'=>__( 'Right Sidebar', 'alger' )),
		'choices' => array(
				'no'=> $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
		
	$options['woo_archives_sidebar_layout'] = array(
		'settings' => 'woo_archives_sidebar_layout',
		'label'   => __( 'Sidebar: WooCommerce Archive', 'alger' ),
		'section' => $section,
		'type'    => 'radio-image',
		'default' => 'no',
		'choices' => array('no' =>__( 'No Sidebar', 'alger' ),'left'=>__( 'Left Sidebar', 'alger' ),'right'=>__( 'Right Sidebar', 'alger' )),
		'choices' => array(
				'no'=> $imagepath.'customize/sidebar-none.png',
				'left'=> $imagepath.'customize/sidebar-left.png',
				'right'=> $imagepath.'customize/sidebar-right.png',
				),
		);
	
	$options['widgets_title_color'] = array(
		'settings' => 'widgets_title_color',
		'label'   => __( 'Widgets Title Color', 'alger' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.widget-area .widget-title',
				'property' => 'color'
			),
		)
	);
	
	$options['widgets_text_color'] = array(
		'settings' => 'widgets_text_color',
		'label'   => __( 'Text Color', 'alger' ),
		'priority' => '2',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.widget-area .widget-box, .widget-area div, .widget-area p, .widget-area span',
				'property' => 'color'
			),
		)
	);
	
	$options['widgets_link_color'] = array(
		'settings' => 'widgets_link_color',
		'label'   => __( 'Link Color', 'alger' ),
		'priority' => '3',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.widget-area .widget-box a',
				'property' => 'color'
			),
		)
	);
	
	$options['widgets_link_hover_color'] = array(
		'settings' => 'widgets_link_hover_color',
		'label'   => __( 'Link Hover Color', 'alger' ),
		'priority' => '4',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => '.widget-area .widget-box a:hover',
				'property' => 'color'
			),
		)
	);
	
	$section = 'stylling-back-to-top';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Back to Top', 'alger' ),
		'priority' => '3',
		'panel' => $panel
	);
	
	$options['back_to_top_icon_color'] = array(
		'settings' => 'back_to_top_icon_color',
		'label'   => __( 'Icon Color', 'alger' ),
		'priority' => '3',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#cccccc',
		'output'      => array(
			array(
				'element' => '.back-to-top',
				'property' => 'color'
			),
			array(
				'element' => '.back-to-top:before',
				'property' => 'border-color'
			),
		)
	);
	
	$options['back_to_top_icon_background_color'] = array(
		'settings' => 'back_to_top_icon_background_color',
		'label'   => __( 'Icon Background Color', 'alger' ),
		'priority' => '3',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => 'rgba(50,50,50,.8)',
		'output'      => array(
			array(
				'element' => '.back-to-top',
				'property' => 'background-color'
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$options['back_to_top_icon_hover_color'] = array(
		'settings' => 'back_to_top_icon_hover_color',
		'label'   => __( 'Icon Hover Color', 'alger' ),
		'priority' => '3',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#cccccc',
		'output'      => array(
			array(
				'element' => '.back-to-top:hover',
				'property' => 'color'
			),
			array(
				'element' => '.back-to-top:hover:before',
				'property' => 'border-color'
			),
		)
	);
	
	$options['back_to_top_icon_background_hover_color'] = array(
		'settings' => 'back_to_top_icon_background_hover_color',
		'label'   => __( 'Icon Background Color', 'alger' ),
		'priority' => '3',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => 'rgba(50,50,50,.8)',
		'output'      => array(
			array(
				'element' => '.back-to-top:hover',
				'property' => 'background-color'
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$options['back_to_top_broder_radius'] = array(
			'settings' => 'back_to_top_broder_radius',
			'label'   => __( 'Broder Radius', 'alger' ),
			'priority' => '5',
			'section' => $section,
			'type' => 'slider',
			'transport' => $transport,
			'default' => '5',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 50,
				'step'   => 1,
				'suffix' => 'px',
  			),
			'output'      => array(
			array(
				'element' => '.back-to-top',
				'property' => 'border-radius',
				'units' => 'px',
			),
		),
		);
	
	$options['display_scroll_to_top'] = array(
			'settings' => 'display_scroll_to_top',
			'label'   => __( 'Enable Scroll to Top Button', 'alger' ),
			'section' => $section,
			'priority' => '10',
			'type'    => 'checkbox',
			'transport' => $transport, 
			'default' => '1',
		);
		
	$options['scroll_btn_position'] = array(
			'settings' => 'scroll_btn_position',
			'label'   => __( 'Button Position', 'alger' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
				'left'=> __( 'Left', 'alger' ),
				'right'=> __( 'Right', 'alger' ),
				),
			'transport' => $transport,
			'default' => 'right',
			'description'   => '',
			'active_callback'   => array(
				  array(
					'setting'  		=> 'display_scroll_to_top',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
		);
	
	$section = 'section-forms-options';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Forms', 'alger' ),
		'priority' => '11',
		'panel' => $panel
	);
	
	$options['form_border_style'] = array(
			'settings' => 'form_border_style',
			'label'   => __( 'Form Border Style', 'alger' ),
			'section' => $section,
			'priority' => '2',
			'type'    => 'select',
			'transport' => $transport,
			'default' => 'solid',
			'choices' => array(
				'none'    => __( 'None', 'alger' ),
				'hidden'    => __( 'Hidden', 'alger' ),
				'dotted'    => __( 'Dotted', 'alger' ),
				'dashed'    => __( 'Dashed', 'alger' ),
				'solid'    => __( 'Solid', 'alger' ),
				'double'    => __( 'Double', 'alger' ),
				'groove'    => __( 'Groove', 'alger' ),
				'ridge'    => __( 'Ridge', 'alger' ),
				'inset'    => __( 'Inset', 'alger' ),
				'outset'    => __( 'Outset', 'alger' ),
  			),
		);
		
	$options['form_border_width'] = array(
			'settings' => 'form_border_width',
			'label'   => __( 'Form Border Width', 'alger' ),
			'priority' => '3',
			'section' => $section,
			'type' => 'slider',
			'transport' => $transport,
			'default' => '1',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 10,
				'step'   => 1,
				'suffix' => 'px',
  			),
		);
		
		$options['form_border_color'] = array(
			'settings' => 'form_border_color',
			'label'   => __( 'Form Border Color', 'alger' ),
			'priority' => '4',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '#dddddd',
		);
		
		$options['form_background_color'] = array(
			'settings' => 'form_background_color',
			'label'   => __( 'Form Background Color', 'alger' ),
			'priority' => '4',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '#ffffff',
			'output'      => array(
			array(
				'element' => '.form-control, select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
			
		);
		
		$options['form_broder_radius'] = array(
			'settings' => 'form_broder_radius',
			'label'   => __( 'Form Broder Radius', 'alger' ),
			'priority' => '5',
			'section' => $section,
			'type' => 'slider',
			'transport' => $transport,
			'default' => '0',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 20,
				'step'   => 1,
				'suffix' => 'px',
  			),
			
		);
		
		$options['form_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'form_padding',
		'label'       => esc_attr__( 'Form Padding', 'alger' ),
		'description' => '',
		'section'     => $section,
		'priority' => '5',
		'default'     => array(
			'padding-top'    => '10px',
			'padding-bottom' => '10px',
			'padding-left'   => '20px',
			'padding-right'  => '20px',
		),
		'output'      => array(
			array(
				'element' => '.form-control, select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input',
			),
		),
	);
	
	$section = 'stylling-buttons';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Buttons', 'alger' ),
		'priority' => '3',
		'panel' => $panel
	);
	
	$options['button_font_size'] = array(
			'settings' => 'button_font_size',
			'label'   => __( 'Form Font Size', 'alger' ),
			'priority' => '5',
			'section' => $section,
			'default' => '12',
			'input_attrs' => array(
				'min'    => 9,
				'max'    => 30,
				'step'   => 1,
				'suffix' => 'px',
  			),
		);
		
		$options['button_color'] = array(
			'settings' => 'button_color',
			'label'   => __( 'Button Text Color', 'alger' ),
			'priority' => '5',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '#ffffff',
		);
		
		$options['button_text_transform'] = array(
			'settings' => 'button_text_transform',
			'label'   => __( 'Button Text-transform', 'alger' ),
			'section' => $section,
			'priority' => '5',
			'type'    => 'select',
			'transport' => $transport,
			'default' => 'uppercase',
			'choices' => array(
				'none'    => __( 'None', 'alger' ),
				'capitalize'    => __( 'Capitalize', 'alger' ),
				'uppercase'    => __( 'Uppercase', 'alger' ),
				'lowercase'    => __( 'lowercase', 'alger' ),

  			),
		);
		
		$options['button_broder_radius'] = array(
			'settings' => 'button_broder_radius',
			'label'   => __( 'Button Broder Radius', 'alger' ),
			'priority' => '5',
			'section' => $section,
			'type' => 'slider',
			'transport' => $transport,
			'default' => '0',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 20,
				'step'   => 1,
				'suffix' => 'px',
  			),

		);
		
		$options['button_border_color'] = array(
			'settings' => 'button_border_color',
			'label'   => __( 'Button Border Color', 'alger' ),
			'priority' => '5',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '',
		'output'      => array(
			array(
				'element' => 'button, input[type="submit"], .cactus-btn, .alger-btn, btn-normal, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button',
				'property' => 'border-color',
			),
		),
		);

		$options['button_background_color'] = array(
			'settings' => 'button_background_color',
			'label'   => __( 'Button Background Color', 'alger' ),
			'priority' => '5',
			'section' => $section,
			'type'    => 'color',
			'transport' => $transport,
			'default' => '',
			'choices'     => array(
			'alpha' => true,
		),
		'output'      => array(
			array(
				'element' => 'button, input[type="submit"], .alger-btn, .btn-normal',
				'property' => 'background-color',
			),
		),
		);
		
		$options['button_border_style'] = array(
			'settings' => 'button_border_style',
			'label'   => __( 'Button Border Style', 'alger' ),
			'section' => $section,
			'priority' => '5',
			'type'    => 'select',
			'transport' => $transport,
			'default' => 'solid',
			'choices' => array(
				'none'    => __( 'None', 'alger' ),
				'hidden'    => __( 'Hidden', 'alger' ),
				'dotted'    => __( 'Dotted', 'alger' ),
				'dashed'    => __( 'Dashed', 'alger' ),
				'solid'    => __( 'Solid', 'alger' ),
				'double'    => __( 'Double', 'alger' ),
				'groove'    => __( 'Groove', 'alger' ),
				'ridge'    => __( 'Ridge', 'alger' ),
				'inset'    => __( 'Inset', 'alger' ),
				'outset'    => __( 'Outset', 'alger' ),
  			),
		);
	
	$options['button_border_width'] = array(
			'settings' => 'button_border_width',
			'label'   => __( 'Button Border Width', 'alger' ),
			'priority' => '5',
			'section' => $section,
			'default' => '0',
			'type' => 'slider',
			'input_attrs' => array(
				'min'    => 0,
				'max'    => 5,
				'step'   => 1,
				'suffix' => 'px',
  			),
		);
		
	$options['button_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'button_padding',
		'label'       => esc_attr__( 'Button Padding', 'alger' ),
		'description' => '',
		'section'     => $section,
		'priority' => '5',
		'default'     => array(
			'padding-top'    => '10px',
			'padding-bottom' => '10px',
			'padding-left'   => '20px',
			'padding-right'  => '20px',
		),
		'output'      => array(
			array(
				'element' => 'body button,body input[type="submit"],body .alger-btn, lq-btn,.btn-normal',
			),
		),
	);
	
	$section = 'section-404-Page-options';
	$sections[] = array(
		'settings' => $section,
		'title' => __( '404 Page', 'alger' ),
		'priority' => '11',
		'panel' => $panel
	);
	
	$options['page_404'] = array(
		'type'        => 'dropdown-pages',
		'settings'    => 'page_404',
		'label'       => esc_attr__( '404 Page content', 'alger' ),
		'section'     => $section,
		'default'     => '0',
		'priority'    => 10,
     );
	
	 // Panel Header
	
	$panel = 'panel-header';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'Alger: Header', 'alger' ),
		'priority' => '2'
	);
	
	$section = 'section-header-general-options';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'General Options', 'alger' ),
		'priority' => '1',
		'panel' => $panel
	);
	
	$options['header_full_width'] = array(
			'settings' => 'header_full_width',
			'label'   => __( 'Full-width Header', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '',
		);
	$options['header_background_color'] = array(
			'settings' => 'header_background_color',
			'label'   => __( 'Main Header Background Color', 'alger' ),
			'section' => $section,
			'type'    => 'color',
			'default' => 'rgba(255,255,255,1)',
			'transport' => $transport,
			'output' => array(
				array( 
				'element' => '.header-wrap,.lq-header,.lq-fixed-header-wrap',
				'function' => 'css',
				'property' => 'background-color',
				'choice' => 'background-color'
				)
			),
			'choices'     => array(
				'alpha' => true,
			),
			'js_vars' => array(
				array( 
				'element' => '.header-wrap,.lq-header',
				'function' => 'css',
				'property' => 'background-color',
				'choice' => 'background-color'
				)
			)
		);

	$section = 'section-header-topbar';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Top Bar', 'alger' ),
		'priority' => '2',
		'panel' => $panel
	);
	
	$options['display_topbar'] = array(
			'settings' => 'display_topbar',
			'label'   => __( 'Display Top Bar', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '',
			'priority' => '1',
		);
	
	$options['topbar_visibility'] = array(
			'settings' => 'topbar_visibility',
			'label'   => __( 'Top Bar Visibility', 'alger' ),
			'section' => $section,
			'priority' => '',
			'type'    => 'radio',
			'transport' => $transport,
			'default' => '0',
			'priority' => '2',
			'choices' => array(
				'0'    => __( 'Show on all devices', 'alger' ),
				'1'    => __( 'Hide on Mobile', 'alger' ),
				'2'    => __( 'Hide on Mobile&Tablet', 'alger' ),

  			),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
		);
	
	$options['topbar_left'] = array(
			'settings' => 'topbar_left',
			'label'   => __( 'Top Bar Left', 'alger' ),
			'section' => $section,
			'type'    => 'repeater',
			'choices' => array('limit' => '6'),
			'transport' => $transport,
			'priority' => '4',
			'row_label' => array(
						'type' => 'field',
						'value' => esc_attr__('Item', 'alger' ),
						'field' => 'text',),
			'fields' => array(
				'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'alger' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
				'text'=>array('type'=>'text','default'=>'','label'=> __( 'Text', 'alger' )),
				'link'=>array('type'=>'link','default'=>'','label'=> __( 'Link', 'alger' )),
				'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'alger' )),
			),
			'default' =>  array(
				
				),
			
			'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
				
			);
		
	$options['topbar_menu'] = array(
				'settings' => 'topbar_menu',
				'label'   => __( 'Menu', 'alger' ),
				'section' => $section,
				'type'    => 'select',
				'default' => '',
				'choices' => $menus,
				'priority' => '5',
				'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
			);
		
	$options['topbar_icons'] = array(
				'settings' => 'topbar_icons',
				'label'   => __( 'Top Bar Icons', 'alger' ),
				'section' => $section,
				'type'    => 'repeater',
				'choices' => array('limit' => '6'),
				'transport' => $transport,
				'priority' => '6',
				'row_label' => array(
							'type' => 'field',
							'value' => esc_attr__('Icon', 'alger' ),
							'field' => 'icon',),
				'fields' => array(
					'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'alger' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
					'link'=>array('type'=>'link','default'=>'','label'=> __( 'Link', 'alger' )),
					'target'=>array('type'=>'select','default'=>'', 'choices'=> $target, 'label'=> __( 'Target', 'alger' )),
				),
				'default' =>  array(
					
					),
				'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
				);
	
	
	
	$options['topbar_template_part'] = array(
		'settings' => 'topbar_template_part',
		'label'   => __( 'Select Template Part', 'alger' ),
		'description' => __( 'Choose a template part created in LQThemes > Template Parts.', 'alger' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $templates,
		'default' => '0',
		'priority' => '6',
		'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
		);
		
	
	$options['topbar_style'] = array(
			'settings' => 'topbar_style',
			'label'   => __( 'Top Bar Style', 'alger' ),
			'section' => $section,
			'priority' => '7',
			'type'    => 'radio',
			'transport' => $transport,
			'default' => '0',
			'choices' => array(
				'0' => __( 'Solid Background', 'alger' ), // .lq-style-solid-bg
				'1' => __( 'Bottom Line', 'alger' ), // .lq-style-bottom-line
				'2' => __( 'Bottom Line Full', 'alger' ), // .lq-style-bottom-line-full

  			),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
		);
	
	$options['topbar_background_color'] = array(
		'settings' => 'topbar_background_color',
		'label'   => __( 'Top Bar Background Color', 'alger' ),
		'priority' => '7',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#ffffff',
		'output'      => array(
			array(
				'element' => '.lq-top-bar,.lq-top-bar.lq-style-solid-bg:before',
				'property' => 'background-color',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
		'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				  array(
					'setting'  		=> 'topbar_style',
					'operator' 		=> '==',
					'value'    		=> '0',
				  ),
				),
	);
	
	$options['topbar_border_color'] = array(
		'settings' => 'topbar_border_color',
		'label'   => __( 'Top Bar Border Color', 'alger' ),
		'priority' => '7',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#ffffff',
		'output'      => array(
			array(
				'element' => '.lq-top-bar:before',
				'property' => 'border-color',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
		'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				  array(
					'setting'  		=> 'topbar_style',
					'operator' 		=> 'in',
					'value'    		=> array('1', '2'),
				  ),
				),
	);
	
	$options['topbar_font_color'] = array(
		'settings' => 'topbar_font_color',
		'label'   => __( 'Topbar Font Color', 'alger' ),
		'priority' => '7',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#666',
		'output'      => array(
			array(
				'element' => '.lq-top-bar .lq-microwidget, .lq-top-bar .lq-microwidget a,.lq-top-bar .lq-microwidget',
				'property' => 'color'
			),
		),
		'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
	);
	
	$options['topbar_link_color'] = array(
		'settings' => 'topbar_link_color',
		'label'   => __( 'Link Color', 'alger' ),
		'priority' => '7',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.lq-top-bar a,.lq-top-bar .lq-microwidget a, .lq-top-bar .lq-microwidget a span',
				'property' => 'color'
			),
		),
		'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
	);
	
	$options['topbar_link_hover_color'] = array(
		'settings' => 'topbar_link_hover_color',
		'label'   => __( 'Link Hover Color', 'alger' ),
		'priority' => '8',
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => '.lq-top-bar a:hover,.lq-top-bar .lq-microwidget a:hover, .lq-top-bar .lq-microwidget a:hover span',
				'property' => 'color'
			),
		),
		'active_callback'   => array(
				  array(
					'setting'  		=> 'display_topbar',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
	);

	$section = 'section-main-header';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Main Header-Layout', 'alger' ),
		'priority' => '2',
		'panel' => $panel
	);
	
	$options['header_style'] = array(
			'settings' => 'header_style',
			'label'   => __( 'Layout', 'alger' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
				'inline'=> __( 'Inline', 'alger' ), // Classic
				'classic'=> __( 'Classic', 'alger' ),
				'center'=> __( 'Center', 'alger' ),
				'split'=> __( 'Split', 'alger' ),
				),
			'default' => 'inline',
			
		);
	
	/* Inline Header Options */
	$options['inline_header_menu_position'] = array(
			'settings' => 'inline_header_menu_position',
			'label'   => __( 'Menu Position', 'alger' ),
			'section' => $section,
			'type'    => 'radio-image',
			'transport' => $transport,
			'choices' => array(
				'left'=> $imagepath.'customize/header-inline-menuleft.png',
				'right'=> $imagepath.'customize/header-inline-menuright.png',
				'center'=> $imagepath.'customize/header-inline-menucenter.png',
				'justify'=> $imagepath.'customize/header-inline-menujustify.png',
				),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'header_style',
					'operator' 		=> '==',
					'value'    		=> 'inline',
				  ),
				),
			'default' => 'right',
		);
	
	/* Classic Header Options */
	$options['classic_header_promo'] = array(
			'settings' => 'classic_header_promo',
			'label'   => __( 'Header Text', 'alger' ),
			'section' => $section,
			'type'    => 'textarea',
			'transport' => $transport,
			'default' => '<a href="#"><img src="'.$imagepath.'banner-promo-black.png" alt="" /></a>',
			'active_callback'   => array(
				  array(
					'setting'  		=> 'header_style',
					'operator' 		=> '==',
					'value'    		=> 'classic',
				  ),
				),
		);
	
	$options['classic_header_logo_position'] = array(
			'settings' => 'classic_header_logo_position',
			'label'   => __( 'Logo Position', 'alger' ),
			'section' => $section,
			'type'    => 'radio-image',
			'transport' => $transport,
			'choices' => array(
				'left'=> $imagepath.'customize/header-classic-logoleft.png',
				'center'=> $imagepath.'customize/header-classic-logocenter.png',
				),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'header_style',
					'operator' 		=> '==',
					'value'    		=> 'classic',
				  ),
				),
			'default' => 'left',
		);
	
	$options['classic_header_menu_position'] = array(
			'settings' => 'classic_header_menu_position',
			'label'   => __( 'Menu Position', 'alger' ),
			'section' => $section,
			'type'    => 'radio-image',
			'transport' => $transport,
			'choices' => array(
				'left'=> $imagepath.'customize/header-classic-menuleft.png',
				'center'=> $imagepath.'customize/header-classic-menucenter.png',
				),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'header_style',
					'operator' 		=> '==',
					'value'    		=> 'classic',
				  ),
				),
			'default' => 'left',
		);
			
	$options['split_header_menu_position'] = array(
			'settings' => 'split_header_menu_position',
			'label'   => __( 'Menu Position', 'alger' ),
			'section' => $section,
			'type'    => 'radio-image',
			'transport' => $transport,
			'choices' => array(
				'justify'=> $imagepath.'customize/header-split-justify.png',
				'inside'=> $imagepath.'customize/header-split-inside.png',
				'outside'=> $imagepath.'customize/header-split-outside.png',
				),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'header_style',
					'operator' 		=> '==',
					'value'    		=> 'split',
				  ),
				),
			'default' => 'outside',
		);
		
	$options['sticky_header'] = array(
		'settings' => 'sticky_header',
		'label'   => __( 'Enable Sticky Main Header?', 'alger' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '1',
		'transport' => $transport,
	);
	
	$options['sticky_header_mobile'] = array(
		'settings' => 'sticky_header_mobile',
		'label'   => __( 'Sticky Header Visibility on Mobile Devices?', 'alger' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '',
		'transport' => $transport,
		'active_callback'   => array(
				  array(
					'setting'  		=> 'sticky_header',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
	);
	
		
	$options['display_shopping_cart_icon'] = array(
			'settings' => 'display_shopping_cart_icon',
			'label'   => __( 'Display Shopping Cart Icon', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '',
			'transport' => $transport,
		);

	$options['display_search_icon'] = array(
			'settings' => 'display_search_icon',
			'label'   => __( 'Display Search Icon', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '1',
			'transport' => $transport,
		);
	
	$options['display_random_icon'] = array(
			'settings' => 'display_random_icon',
			'label'   => __( 'Display Random Icon', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'default' => '',
			'transport' => $transport,
		);
	
	$options['link_hover_effect'] = array(
			'settings' => 'link_hover_effect',
			'label'   => __( 'Link Hover Effect', 'alger' ),
			'section' => $section,
			'type'    => 'radio',
			'choices' => array(
				'1'=> __( 'From Center', 'alger' ), // .hoverline-fromcenter
				'2'=> __( 'Left to Right', 'alger' ), // .hoverline-lefttoright
				'3'=> __( 'Upwards', 'alger' ), // .hoverline-upwards
				'4'=> __( 'Downwards', 'alger' ), // .hoverline-downwards
				),
			'default' => '1',
			
		);
		
		
	$options['navigation_height'] = array(
			'settings' => 'navigation_height',
			'label'   => __( 'Navigation Height', 'alger' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '',
			'transport' => $transport,
			'active_callback'   => array(
				  array(
					'setting'  		=> 'header_style',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				)
		);	
	
	
	
	/*$options['navigation_background'] = array(
		'settings' => 'navigation_background',
		'label'   => __( 'Background', 'alger' ),
		'section' => $section,
		'type'    => 'background',
		'transport' => $transport,
		'default' => array( 'background-color' => '#ffffff' ),
		'output'      => array(
			array(
				'element' => '.lq-main-header-wrap',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);*/
	
	$options['site_title_font_color'] = array(
		'settings' => 'site_title_font_color',
		'label'   => __( 'Site Title Font Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.site-name',
				'property' => 'color'
			),
		)
	);
	
	$options['site_title_hover_font_color'] = array(
		'settings' => 'site_title_hover_font_color',
		'label'   => __( 'Site Title Hover Font Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => '.site-name:hover',
				'property' => 'color'
			),
		)
	);
	
	$options['toggle_font_color'] = array(
		'settings' => 'toggle_font_color',
		'label'   => __( 'Menu Toggle Color for Mobile Devices', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.lq-toggle-icon:before, .lq-toggle-icon:after,.lq-toggle-icon .lq-line',
				'property' => 'background-color'
			),
		)
	);
	
	$options['toggle_hover_font_color'] = array(
		'settings' => 'toggle_hover_font_color',
		'label'   => __( 'Menu Toggle Hover Color for Mobile Devices', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => '.lq-menu-toggle:hover .lq-toggle-icon:before, .lq-menu-toggle:hover  .lq-toggle-icon:after,.lq-menu-toggle:hover  .lq-toggle-icon .lq-line',
				'property' => 'background-color'
			),
		)
	);
	
	$options['main_menu_font_color'] = array(
		'settings' => 'main_menu_font_color',
		'label'   => __( 'Menu Item Font Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => 'body .lq-header .lq-main-nav > li > a, body .lq-header .lq-microwidget a,body .lq-header .lq-search-label,body .lq-header .lq-shopping-cart-label',
				'property' => 'color'
			),
		)
	);
	
	$options['main_menu_hover_font_color'] = array(
		'settings' => 'main_menu_hover_font_color',
		'label'   => __( 'Menu Item Hover Font Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => '.lq-header .lq-main-nav > li > a:hover, .lq-header .lq-microwidget a:hover',
				'property' => 'color'
			),
			array(
				'element' => '.lq-header.transparent .hoverline-lefttoright > li > a > span:before,.lq-header.transparent .hoverline-upwards > li > a > span:before,.lq-header.transparent .hoverline-downwards > li > a > span:before',
				'property' => 'background-color'
			),
		)
	);
	
	$options['menu_item_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'menu_item_padding',
		'label'       => esc_attr__( 'Menu Item Padding', 'alger' ),
		'description' => '',
		'section'     => $section,
		'default'     => array(
			'padding-top'    => '4px',
			'padding-bottom' => '4px',
			'padding-left'   => '0',
			'padding-right'  => '0',
		),
		'output'      => array(
			array(
				'element' => '.lq-header .lq-main-nav > li > a',
			),
		),

	);
	
	$options['menu_item_margin'] = array(
		'type'        => 'dimensions',
		'settings'    => 'menu_item_margin',
		'label'       => esc_attr__( 'Menu Item Margin', 'alger' ),
		'description' => '',
		'section'     => $section,
		'default'     => array(
			'margin-top'    => '18px',
			'margin-bottom' => '18px',
			'margin-left'   => '20px',
			'margin-right'  => '20px',
		),
		'output'      => array(
			array(
				'element' => '.lq-header .lq-main-nav > li > a',
			),
		),

	);
	
	/*$options['navigation_style'] = array(
			'settings' => 'navigation_style',
			'label'   => __( 'Navigation Style', 'alger' ),
			'section' => $section,
			'type'    => 'radio',
			'transport' => $transport,
			'default' => '0',
			'choices' => array(
				'0' => __( 'Solid Background', 'alger' ), // .lq-style-solid-bg
				'1' => __( 'Bottom Line', 'alger' ), // .lq-style-bottom-line
				'2' => __( 'Bottom Line Full', 'alger' ), // .lq-style-bottom-line-full

  			),
			'active_callback'   => array(
				 
				  array(
					'setting'  		=> 'header_style',
					'operator' 		=> 'in',
					'value'    		=> array('classic','center'),
				  ),
				),
			
			
		);
	
	$options['navigation_background_color'] = array(
		'settings' => 'navigation_background_color',
		'label'   => __( 'Navigation Background Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => 'transparent',
		'output'      => array(
			array(
				'element' => 'body .lq-navigation, body .lq-navigation:before',
				'property' => 'background-color',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
		'active_callback'   => array(
				 
				  array(
					'setting'  		=> 'navigation_style',
					'operator' 		=> '==',
					'value'    		=> '0',
				  ),
				  array(
					'setting'  		=> 'header_style',
					'operator' 		=> 'in',
					'value'    		=> array('split','center'),
				  ),
				),
				
				
	);
	
	$options['navigation_border_color'] = array(
		'settings' => 'navigation_border_color',
		'label'   => __( 'Navigation Border Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#ffffff',
		'output'      => array(
			array(
				'element' => '.lq-navigation:before',
				'property' => 'border-color',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
		'active_callback'   => array(
	
				  array(
					'setting'  		=> 'navigation_style',
					'operator' 		=> 'in',
					'value'    		=> array('1', '2'),
				  ),
				),
	);
	*/
	
	$section = 'section-transparent-header';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Transparent Header', 'alger' ),
		'priority' => '3',
		'panel' => $panel
	);
	
	$options['header_transparent'] = array(
			'settings' => 'header_transparent',
			'label'   => __( 'Transparent Header', 'alger' ),
			'description'   => __( 'Display transparent header in default?', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '',
		);
	
	$options['header_transparent_background'] = array(
		'settings' => 'header_transparent_background',
		'label'   => __( 'Background color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => 'rgba(0,0,0,0)',
		'output'      => array(
			array(
				'element' => '.lq-header.transparent',
				'property' => 'background-color'
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$options['transparent_site_title_font_color'] = array(
		'settings' => 'transparent_site_title_font_color',
		'label'   => __( 'Site Title Font Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#ffffff',
		'output'      => array(
			array(
				'element' => '.lq-header.transparent .site-name',
				'property' => 'color'
			),
		)
	);
	
	$options['transparent_site_title_hover_font_color'] = array(
		'settings' => 'transparent_site_title_hover_font_color',
		'label'   => __( 'Site Title Hover Font Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => '.lq-header.transparent .site-name:hover',
				'property' => 'color'
			),
		)
	);
	
	$options['transparent_toggle_font_color'] = array(
		'settings' => 'transparent_toggle_font_color',
		'label'   => __( 'Menu Toggle Color for Mobile Devices', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.lq-header.transparent .lq-toggle-icon:before, .lq-header.transparent .lq-toggle-icon:after, .lq-header.transparent .lq-toggle-icon .lq-line',
				'property' => 'background-color'
			),
		)
	);
	
	$options['transparent_toggle_hover_font_color'] = array(
		'settings' => 'transparent_toggle_hover_font_color',
		'label'   => __( 'Menu Toggle Hover Color for Mobile Devices', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => '.lq-header.transparent .lq-menu-toggle:hover .lq-toggle-icon:before, .lq-header.transparent .lq-menu-toggle:hover  .lq-toggle-icon:after, .lq-header.transparent .lq-menu-toggle:hover  .lq-toggle-icon .lq-line',
				'property' => 'background-color'
			),
		)
	);
	
	$options['transparent_main_menu_font_color'] = array(
		'settings' => 'transparent_main_menu_font_color',
		'label'   => __( 'Menu Item Font Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#ffffff',
		'output'      => array(
			array(
				'element' => 'body .lq-header.transparent .lq-main-nav > li > a, body .lq-header.transparent .lq-microwidget a, body .lq-header.transparent .lq-search-label, body .lq-header.transparent .lq-shopping-cart-label',
				'property' => 'color'
			),
		)
	);
	
	$options['transparent_main_menu_hover_font_color'] = array(
		'settings' => 'transparent_main_menu_hover_font_color',
		'label'   => __( 'Menu Item Hover Font Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => 'body .lq-header.transparent .lq-main-nav > li > a:hover,body .lq-header.transparent .lq-microwidget a:hover,body .lq-header.transparent .lq-search-label:hover, body .lq-header.transparent .lq-shopping-cart-label:hover',
				'property' => 'color'
			),
			array(
				'element' => 'body .lq-header .hoverline-lefttoright > li > a > span:before, body .lq-header .hoverline-upwards > li > a > span:before,body .lq-header .hoverline-downwards > li > a > span:before',
				'property' => 'background-color'
			),
		)
	);
	
	
	$section = 'section-logo';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Logo', 'alger' ),
		'priority' => '3',
		'panel' => $panel
	);
	
	
	$options['enable_transparent_logo'] = array(
			'settings' => 'enable_transparent_logo',
			'label'   => __( 'Diffenet logo for transparent header?', 'alger' ),
			'description'   => '',
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '',
		);
		
	$options['transparent_header_logo'] = array(
			'settings' => 'transparent_header_logo',
			'label'   => __( 'Transparent Header Logo', 'alger' ),
			'section' => $section,
			'type'    => 'image',
			'default' => '',
			'transport' => $transport,
			'active_callback'   => array(
	
				  array(
					'setting'  		=> 'enable_transparent_logo',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
		);
	
	
	$section = 'section-dropdown-menu';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Dropdown Menu', 'alger' ),
		'priority' => '3',
		'panel' => $panel
	);

	$options['dropdown_menu_width'] = array(
			'settings' => 'dropdown_menu_width',
			'label'   => __( 'Width', 'alger' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '240px',
			'transport' => $transport,
			'output'      => array(
				  array(
					  'element' => '.sub-menu, .lq-mega-menu-wrap',
					  'property' => 'width' 
				  ),
			  ),
			
		);
	
	$options['dropdown_menu_item_background_color'] = array(
		'settings' => 'dropdown_menu_item_background_color',
		'label'   => __( 'Dropdown Menu Item Background Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#ffffff',
		'output'      => array(
			array(
				'element' => '.lq-header .sub-menu',
				'property' => 'background-color'
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$options['dropdown_menu_item_color'] = array(
		'settings' => 'dropdown_menu_item_color',
		'label'   => __( 'Dropdown Menu Item Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333333',
		'output'      => array(
			array(
				'element' => '.sub-menu li a, .sub-menu li a span',
				'property' => 'color'
			),
		)
	);
	
	$options['dropdown_menu_item_hover_color'] = array(
		'settings' => 'dropdown_menu_item_hover_color',
		'label'   => __( 'Dropdown Menu Item Hover Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => '.sub-menu li a:hover, .sub-menu li a:hover span',
				'property' => 'color'
			),
		)
	);


	$section = 'section-mobile-header';

	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Mobile Header', 'alger' ),
		'priority' => '3',
		'panel' => $panel
	);
	
	$options['breakpoint'] = array(
			'settings' => 'breakpoint',
			'label'   => __( 'Breakpoint', 'alger' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '768px',
			'transport' => $transport,
		);
	
	$options['mobile_header_height'] = array(
			'settings' => 'mobile_header_height',
			'label'   => __( 'Height', 'alger' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '90px',
			'transport' => $transport,
			'output'      => array(
				  array(
					  'element' => '.lq-mobile-main-header',
					  'property' => 'min-height'
				  ),
			  ),
		);
	
	$options['menu_text'] = array(
			'settings' => 'menu_text',
			'label'   => __( 'Menu Text', 'alger' ),
			'section' => $section,
			'type'    => 'text',
			'default' => '',
			'transport' => $transport,
		);
	 
	 // Panel Footer
	
	$section = 'section-footer';
	
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Alger: Footer', 'alger' ),
		'priority' => '3',
		'panel' => '',
	);
	
	$options['footer_fullwidth'] = array(
		'settings' => 'footer_fullwidth',
		'label'   => __( 'Fullwidth', 'alger' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '',
	);
	
	$options['display_footer_widgets'] = array(
		'settings' => 'display_footer_widgets',
		'label'   => __( 'Display Widget area?', 'alger' ),
		'priority' => '1',
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '',
	);
	
	$options['footer_template_part'] = array(
		'settings' => 'footer_template_part',
		'label'   => __( 'Select Template Part', 'alger' ),
		'description' => __( 'Choose a template part created in LQThemes > Template Parts.', 'alger' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $templates,
		'default' => '0',
		'priority' => '2',
		'active_callback'   => array(
				  array(
					'setting'  		=> 'display_footer_widgets',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
		);
	
	$options['foonter_widgets_visibility'] = array(
			'settings' => 'foonter_widgets_visibility',
			'label'   => __( 'Visibility', 'alger' ),
			'priority' => '4',
			'section' => $section,
			'type'    => 'radio',
			'transport' => $transport,
			'choices' => array(
				'0'    => __( 'Show on all devices', 'alger' ),
				'1'    => __( 'Hide on Mobile', 'alger' ),
				'2'    => __( 'Hide on Mobile&Tablet', 'alger' ),

  			),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'display_footer_widgets',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
			'default' => '0',
		);
	
	$options['footer_columns'] = array(
		'settings' => 'footer_columns',
		'label'   => __( 'Footer Columns', 'alger' ),
		'priority' => '6',
		'section' => $section,
		'type'    => 'radio',
		'default' => '4',
		'choices' => array( '1' => __( '1 Column', 'alger' ), '2' => __( '2 Columns', 'alger' ), '3' => __( '3 Columns', 'alger' ), '4' => __( '4 Columns', 'alger' ), ),
		'active_callback'   => array(
			array(
			  'setting'  		=> 'display_footer_widgets',
			  'operator' 		=> '==',
			  'value'    		=> '1'
			),
		  ),
	);
	
	$options['footer_widgets_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'footer_widgets_padding',
		'label'       => esc_attr__( 'Footer Widgets Area Padding', 'alger' ),
		'priority' => '6',
		'description' => '',
		'section'     => $section,
		'default'     => array(
			'padding-top'    => '60px',
			'padding-bottom' => '40px',
		),
		'output'      => array(
			array(
				'element' => '.footer-widget-area',
			),
		),
		'active_callback'   => array(
			array(
			  'setting'  		=> 'display_footer_widgets',
			  'operator' 		=> '==',
			  'value'    		=> '1'
			),
		  ),
	);
	
	$options['footer_bottom_padding'] = array(
		'type'        => 'dimensions',
		'settings'    => 'footer_bottom_padding',
		'label'       => esc_attr__( 'Footer Bottom Padding', 'alger' ),
		'description' => '',
		'section'     => $section,
		'default'     => array(
			'padding-top'    => '20px',
			'padding-bottom' => '20px',

		),
		'output'      => array(
			array(
				'element' => '.footer-info-area',
			),
		),
	);
	

	$options['display_footer_icons'] = array(
		'settings' => 'display_footer_icons',
		'label'   => __( 'Display Footer Bottom Icons', 'alger' ),
		'section' => $section,
		'type'    => 'checkbox',
		'default' => '',
	);
	
	$options['footer_icons'] = array(
		'settings' => 'footer_icons',
		'label'   => __( 'Footer Bottom Icons', 'alger' ),
		'section' => $section,
		'type'    => 'repeater',
		'choices' => array('limit' => '6'),
		'transport' => $transport,
		'row_label' => array(
					'type' => 'field',
					'value' => esc_attr__('Icon', 'alger' ),
					'field' => 'title',),
		'fields' => array(
			'icon'=>array('type'=>'text','default'=>'','label'=> sprintf(__( 'Font-awesome Icon. <a href="%s" target="_blank">Get Icon String</a>', 'alger' ),esc_url('https://fontawesome.com/v4.7.0/icons/') )),
			'title'=>array('type'=>'text','default'=>'','label'=> __( 'Title', 'alger' )),
			'link'=>array('type'=>'link','default'=> '','label'=> __( 'Link', 'alger' )),
		
		),
		'default' =>  array(
			
			),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'display_footer_icons',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
		);
	
	$options['copyright'] = array(
		'settings' => 'copyright',
		'label'   => __( 'Copyright', 'alger' ),
		'section' => $section,
		'type'    => 'editor',
		'default' => 'Designed by <a href="'.esc_url('https://lqthemes.com/').'" target="_blank">LQ Themes</a>. All Rights Reserved.'
		);
		
	
	$options['footer_menu'] = array(
		'settings' => 'footer_menu',
		'label'   => __( 'Footer Bottom Menu', 'alger' ),
		'section' => $section,
		'type'    => 'select',
		'default' => '',
		'choices' => $menus
	);
	
	$options['footer_bottom_layout'] = array(
		'settings' => 'footer_bottom_layout',
		'label'   => __( 'Footer Bottom Layout', 'alger' ),
		'section' => $section,
		'type'    => 'radio',
		'default' => 'inline',
		'choices' => array( 'inline' => __( 'Inline', 'alger' ), 'center' => __( 'Center', 'alger' ) )
	);
	
	$options['footer_bottom_style'] = array(
			'settings' => 'footer_bottom_style',
			'label'   => __( 'Footer Bottom Style', 'alger' ),
			'section' => $section,
			'type'    => 'radio',
			'transport' => $transport,
			'default' => '1',
			'choices' => array(
				'1'    => __( 'Solid Background', 'alger' ), // .lq-style-solid-bg
				'2'    => __( 'Bottom Line', 'alger' ), // .lq-style-bottom-line
				'3'    => __( 'Bottom Line Full', 'alger' ), // .lq-style-bottom-line-full

  			),
			'active_callback'   => array(
				  array(
					'setting'  		=> 'display_footer_widgets',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
		);
	
	$options['footer_bottom_background'] = array(
		'settings' => 'footer_bottom_background',
		'label'   => __( 'Footer Bottom Background Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#333',
		'output'      => array(
			array(
				'element' => '.footer-info-area.lq-style-solid-bg:before',
				'property' => 'background-color'
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
		'active_callback'   => array(
				  array(
					'setting'  		=> 'footer_bottom_style',
					'operator' 		=> '==',
					'value'    		=> '1',
				  ),
				),
	);
	
	$options['footer_bottom_border_color'] = array(
		'settings' => 'footer_bottom_border_color',
		'label'   => __( 'Footer Bottom Border Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#fff',
		'output'      => array(
			array(
				'element' => '.footer-info-area.lq-style-top-line:before, .footer-info-area.lq-style-top-line-full:before',
				'property' => 'background-color'
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
		'active_callback'   => array(
				  array(
					'setting'  		=> 'footer_bottom_style',
					'operator' 		=> 'in',
					'value'    		=> array('2','3'),
				  ),
				),
	);
	
	$options['footer_widget_area_background'] = array(
		'settings' => 'footer_widget_area_background',
		'label'   => __( 'Footer Background', 'alger' ),
		'section' => $section,
		'type'    => 'background',
		'transport' => $transport,
		'default' => array('background-color' => '#636363'),
		'output'      => array(
			array(
				'element' => '.site-footer',
			),
		),
		'choices'     => array(
			'alpha' => true,
		),
	);
	
	$options['footer_widget_title_color'] = array(
		'settings' => 'footer_widget_title_color',
		'label'   => __( 'Title Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#fff',
		'output'      => array(
			array(
				'element' => 'footer .widget-title',
				'property' => 'color'
			),
		)
	);
	
	$options['footer_text_color'] = array(
		'settings' => 'footer_text_color',
		'label'   => __( 'Text Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#fff',
		'output'      => array(
			array(
				'element' => '.site-footer .widget-box, .site-footer div, .site-footer, .copyright_selective',
				'property' => 'color'
			),
		)
	);
	
	$options['footer_link_color'] = array(
		'settings' => 'footer_link_color',
		'label'   => __( 'Link Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '#fff',
		'output'      => array(
			array(
				'element' => 'body .site-footer a, .site-footer .widget-box a',
				'property' => 'color'
			),
		)
	);
	
	$options['footer_link_hover_color'] = array(
		'settings' => 'footer_link_hover_color',
		'label'   => __( 'Link Hover Color', 'alger' ),
		'section' => $section,
		'type'    => 'color',
		'transport' => $transport,
		'default' => '',
		'output'      => array(
			array(
				'element' => 'footer a:hover, body .site-footer a:hover, .site-footer .widget-box a:hover',
				'property' => 'color'
			),
		)
	);

	
	
	
	
	// Panel Pages & Posts Options
	$panel = 'panel-pages-posts-options';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'Alger: Blog Options', 'alger' ),
		'priority' => '4'
	);
		
	$section = 'section-posts-archive';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Posts archive', 'alger' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['blog_list_style'] = array(
		'settings' => 'blog_list_style',
		'label'   => __( 'List Style', 'alger' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => array(
				'1'=> __( 'Top Image', 'alger' ),
				'2'=> __( 'Aside Image', 'alger' ),
				'3'=> __( 'Grid', 'alger' ),
				),
		'default' => '1'
	);
	
	
	$options['header_custom_text'] = array(
			'settings' => 'header_custom_text',
			'label'   => __( 'Header Custom Text', 'alger' ),
			'section' => $section,
			'type'    => 'text',
			'transport' => $transport,
			'default' => 'Blog',
		);
	
	//Display: Full Post/Excerpt
	//Display Feature Image/Display Category/Display Author/Dispaly Date
	$options['excerpt_style'] = array(
		'settings' => 'excerpt_style',
		'label'   => __( 'Excerpt', 'alger' ),
		'section' => $section,
		'type'    => 'radio',
		'choices' => array(
				'0'=> __( 'Excerpt', 'alger' ),
				'1'=> __( 'Full Post', 'alger' ),
				),
		'default' => '0'
	);
	
	$options['excerpt_display_feature_image'] = array(
			'settings' => 'excerpt_display_feature_image',
			'label'   => __( 'Display Feature Image', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
		
	$options['excerpt_display_category'] = array(
			'settings' => 'excerpt_display_category',
			'label'   => __( 'Display Category', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
		
	$options['excerpt_display_author'] = array(
			'settings' => 'excerpt_display_author',
			'label'   => __( 'Display Author', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	$options['excerpt_display_date'] = array(
			'settings' => 'excerpt_display_date',
			'label'   => __( 'Display Date', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	
	$section = 'section-posts-single';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Single Post', 'alger' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['header_custom_text'] = array(
			'settings' => 'header_custom_text',
			'label'   => __( 'Header Custom Text', 'alger' ),
			'section' => $section,
			'type'    => 'text',
			'transport' => $transport,
			'default' => 'Blog',
		);
		
	//Display Feature Image/Display Category/Display Author/Dispaly Date
	
	$options['display_feature_image'] = array(
			'settings' => 'display_feature_image',
			'label'   => __( 'Display Feature Image', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
		
	$options['display_category'] = array(
			'settings' => 'display_category',
			'label'   => __( 'Display Category', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	$options['display_author'] = array(
			'settings' => 'display_author',
			'label'   => __( 'Display Author', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	$options['display_date'] = array(
			'settings' => 'display_date',
			'label'   => __( 'Display Date', 'alger' ),
			'section' => $section,
			'type'    => 'checkbox',
			'transport' => $transport,
			'default' => '1',
		);
	
	// Panel Typography
	$panel = 'panel-typography';
	
	$panels[] = array(
		'settings' => $panel,
		'title' => __( 'Alger: Typography', 'alger' ),
		'priority' => '10'
	);
	
	$section = 'base-typorgraphy';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Base Typorgraphy', 'alger' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['body_typography'] = array(
		'type'        => 'typography',
		'settings'    => 'body_typography',
		'label'       => esc_attr__( 'Body Typography', 'alger' ),
		'section'     => $section,
		'default'     => array(
			'font-family'    => 'Lato',
			'variant'        => 'regular',
			'font-size'      => '14px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			//'color'          => '#333',
			'text-transform' => 'none',
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'html, body',
			),
	));
	
	$options['heading_font'] = array(
		'type'        => 'typography',
		'settings'    => 'heading_font',
		'label'       => esc_attr__( 'Heading Font', 'alger' ),
		'section'     => $section,
		'transport' => $transport,
		'default'     => array(
			'font-family'    => 'Lato',
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'h1,h2,h3,h4,h5,h6',
			),
			
	),
	 'js_vars' => array(
        array(
            'element' => 'h1',
        ))
		);
	
	$options['h1_typography'] = array(
		'type'        => 'typography',
		'settings'    => 'h1_typography',
		'label'       => esc_attr__( 'H1', 'alger' ),
		'section'     => $section,
		'transport' => $transport,
		'default'     => array(

			'font-size'      => '36px',
			'line-height'    => '1.1',
			'letter-spacing' => '0',
			//'color'          => '#333',
			'text-transform' => 'none',
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'h1',
			),
			
	),
	 'js_vars' => array(
        array(
            'element' => 'h1',
        ))
		);
	
	$options['h2_typography'] = array(
		'type'        => 'typography',
		'settings'    => 'h2_typography',
		'label'       => esc_attr__( 'H2', 'alger' ),
		'section'     => $section,
		'default'     => array(
			'font-size'      => '30px',
			'line-height'    => '1.1',
			'letter-spacing' => '0',
			//'color'          => '#333',
			'text-transform' => 'none',
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'h2',
			),
	));
	
	
	$options['h3_typography'] = array(
		'type'        => 'typography',
		'settings'    => 'h3_typography',
		'label'       => esc_attr__( 'H3', 'alger' ),
		'section'     => $section,
		'default'     => array(
			'font-size'      => '24px',
			'line-height'    => '1.1',
			'letter-spacing' => '0',
			//'color'          => '#333',
			'text-transform' => 'none',
		),
		'priority'    => 10,
		'output'      => array(
			array(
				'element' => 'h3',
			),
	));

		
	$options['h4_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'h4_typography',
			'label'       => esc_attr__( 'H4', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-size'      => '20px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => 'h4',
				),
		));
	
	$options['h5_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'h5_typography',
			'label'       => esc_attr__( 'H5', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-size'      => '18px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'none',
			),
			'choices'     => array(
				'alpha' => true,
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => 'h5',
				),
		));
		
	$options['h6_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'h6_typography',
			'label'       => esc_attr__( 'H6', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-size'      => '16px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => 'h6',
				),
		));
	
	$section = 'top-bar-typorgraphy';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Top Bar', 'alger' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['topbar_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'topbar_typography',
			'label'       => esc_attr__( 'Content', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => 'regular',
				'font-size'      => '12px',
				'line-height'    => '18px',
				'letter-spacing' => '0.5px',
				//'color'          => '#666',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.lq-top-bar .lq-microwidget, .lq-top-bar .lq-microwidget a',
				),
		));
		
	$section = 'navigation-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Main Header', 'alger' ),
		'priority' => '10',
		'panel' => $panel
	);	
		
	$options['site_title_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'site_title_typography',
			'label'       => esc_attr__( 'Site Title', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => '700',
				'font-size'      => '24px',
				'line-height'    => '1',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.site-name',
				),
		));
	
	$options['main_menu_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'main_menu_typography',
			'label'       => esc_attr__( 'Main Menu', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => '400',
				'font-size'      => '12px',
				'line-height'    => '1',
				'letter-spacing' => '0.3px',
				//'color'          => '#333',
				'text-transform' => 'uppercase',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.lq-header .lq-main-nav > li > a',
				),
		));
	
	$options['sub_menu_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'sub_menu_typography',
			'label'       => esc_attr__( 'Sub Menu', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => 'regular',
				'font-size'      => '12px',
				'line-height'    => '1.8',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.sub-menu li a',
				),
		));
		
	$section = 'widget-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Widget', 'alger' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['widget_title_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'widget_title_typography',
			'label'       => esc_attr__( 'Widget Title', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => '400',
				'font-size'      => '16px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'uppercase',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.widget-title',
				),
		));
		
	$options['widget_content_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'widget_content_typography',
			'label'       => esc_attr__( 'Widget Content', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => '400',
				'font-size'      => '14px',
				'line-height'    => '1.8',
				'letter-spacing' => '0',
				//'color'          => '#a0a0a0',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.widget-box, .widget-box a',
				),
		));
		
	$section = 'footer-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Footer Info', 'alger' ),
		'priority' => '10',
		'panel' => $panel
	);
		
	$options['footer_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'footer_typography',
			'label'       => esc_attr__( 'Footer Content', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => '400',
				'font-size'      => '14px',
				'line-height'    => '1.8',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'none',
			),
			'transport'   => $transport,
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.footer-info-area',
				),

		));
		
	$section = 'page-title-bar-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Page Title Bar', 'alger' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['page_title_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'page_title_typography',
			'label'       => esc_attr__( 'Page Title', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => '400',
				'font-size'      => '20px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.page-title, .page-title-bar-inner .page-title h1, .page-title-bar-inner .page-title h2',
				),
		));
	
	$options['breadcrumb_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'breadcrumb_typography',
			'label'       => esc_attr__( 'Breadcrumb', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => '400',
				'font-size'      => '14px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => '.breadcrumb-nav, .breadcrumb-nav a',
				),
		));
	
	$section = 'blog-typography';
	$sections[] = array(
		'settings' => $section,
		'title' => __( 'Blog', 'alger' ),
		'priority' => '10',
		'panel' => $panel
	);
	
	$options['post_title_typography'] = array(
			'type'        => 'typography',
			'settings'    => 'post_title_typography',
			'label'       => esc_attr__( 'Post Title', 'alger' ),
			'section'     => $section,
			'default'     => array(
				'font-family'    => 'inherit',
				'variant'        => '700',
				'font-size'      => '22px',
				'line-height'    => '1.1',
				'letter-spacing' => '0',
				//'color'          => '#333',
				'text-transform' => 'none',
			),
			'priority'    => 10,
			'output'      => array(
				array(
					'element' => 'h1.entry-title',
				),
		));
	

	
	
	return array( 'options' => $options, 'panels' => $panels, 'sections' => $sections );

}

global $alger_default_options;

$options = alger_customizer_library_options();

Kirki::add_config(
	ALGER_TEXTDOMAIN, array(
		'capability'  => 'edit_theme_options',
		'option_type' => 'option',
		'option_name' => ALGER_TEXTDOMAIN,
	)
);

// add panels
if( is_array( $options['panels'] ) ){
	
	$p = 1;
	foreach(  $options['panels'] as $panel ){
		
		Kirki::add_panel( $panel['settings'], array(
		  'priority'    => $p,
		  'title'       => $panel['title'],
		  'description' => '',
		  ) );
		
		$p++;
		
		}
	
	}

// add sections
if( is_array( $options['sections'] ) ){
	
	$s = 1;
	foreach(  $options['sections'] as $section ){
		
		Kirki::add_section( $section['settings'], array(
		  'title'          => $section['title'],
		  'description'    => '',
		  'panel'          => $section['panel'], 
		  'priority'       => $s,
		  'capability'     => 'edit_theme_options',
		  'theme_supports' => '',
	  ) );
		
		$s++;
		
		}
	
	}

// add options
if( is_array( $options['options'] ) ){
	
	foreach(  $options['options'] as $key=>$option ){
		
		$default = array(
			'settings'         => '',
			'choices'         => '',
			'row_label'       => '',
			'fields'          => '',
			'active_callback' => '',
			'transport'       => 'refresh',
			'output'          => '',
			'js_vars'         => '',
			'partial_refresh' => '',
			'description'     => '',
			'priority'    => '',
		
		);
	
	if( isset( $option['default']) )
		$alger_default_options[$key] = $option['default'];
	//$option = array_merge($default, $option);
		
	if(isset($option['settings']))			
		Kirki::add_field( ALGER_TEXTDOMAIN, $option );
		
		}
	
	}

