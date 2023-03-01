<?php
/**
 * Register widget area.
 *
 */

function alger_widgets_init() {

	register_sidebar( array(

		'name'          => esc_html__( 'Sidebar', 'alger' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Page Sidebar', 'alger' ),
		'id'            => 'sidebar-page',
		'description'   => __( 'Add widgets here to appear in your pages sidebar.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Blog Sidebar', 'alger' ),
		'id'            => 'sidebar-blog',
		'description'   => esc_html__( 'Add widgets here to appear in your posts sidebar.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Archives', 'alger' ),
		'id'            => 'sidebar-archives',
		'description'   => esc_html__( 'Add widgets here to appear in your posts list sidebar.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'WooCommerce Single Product', 'alger' ),
		'id'            => 'sidebar-woo-single',
		'description'   => esc_html__( 'Add widgets here to appear in your products sidebar.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'WooCommerce Archives', 'alger' ),
		'id'            => 'sidebar-woo-archives',
		'description'   => esc_html__( 'Add widgets here to appear in your products list sidebar.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer 1', 'alger' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer 2', 'alger' ),
		'id'            => 'footer-2',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer 3', 'alger' ),
		'id'            => 'footer-3',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Footer 4', 'alger' ),
		'id'            => 'footer-4',
		'description'   => esc_html__( 'Add widgets here to appear in your footer.', 'alger' ),
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Custom Sidebar 1', 'alger' ),
		'id'            => 'custom-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Custom Sidebar 2', 'alger' ),
		'id'            => 'custom-2',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Custom Sidebar 3', 'alger' ),
		'id'            => 'custom-3',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

	register_sidebar( array(

		'name'          => esc_html__( 'Custom Sidebar 4', 'alger' ),
		'id'            => 'custom-4',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',

	) );

}

add_action( 'widgets_init', 'alger_widgets_init' );