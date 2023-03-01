<?php


/**
 * Load the individual classes required by this theme
 */

 

 function  storefront_page_header()   {
 		?>
		<header class="entry-header">
			<?php
			storefront_post_thumbnail( 'full' );
			if( !is_front_page() && !is_page_template( 'template-homepage.php' ) ){
			the_title( '<h1 class="entry-title2">', '</h1>' );

			?>
		<?php } ?>
		</header><!-- .entry-header -->
		<?php
	}


if ( ! function_exists( 'storefront_credit' ) ) {
	/**
	 * Display the theme credit
	 *
	 * @since  1.0.0
	 * @return void
	 */
	function pepbrand_credit() {
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
			<?php if ( apply_filters( 'storefront_credit_link', true ) ) { ?>
			<br /> <?php printf( esc_attr__( '%1$s designed by %2$s.', 'storefront' ), 'Storefront', '<a href="http://www.woothemes.com" alt="Premium WordPress Themes & Plugins by WooThemes" title="Premium WordPress Themes & Plugins by WooThemes" rel="designer">WooThemes</a>' ); ?>
			<?php } ?>
		</div><!-- .site-info -->
		<?php
	}
}


	function storefront_site_branding() {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			the_custom_logo();
		} elseif ( function_exists( 'jetpack_has_site_logo' ) && jetpack_has_site_logo() ) {
			jetpack_the_site_logo();
		} else { ?>
			<div class="site-branding">
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php if ( '' != get_bloginfo( 'description' ) ) { ?>
					<p class="site-description"><?php echo bloginfo( 'description' ); ?></p>
				<?php } ?>
			</div>
		<?php }
	}

	function storefront_credit() {
		?>
		<div class="site-info">
			<?php echo esc_html( apply_filters( 'storefront_copyright_text', $content = '&copy; ' . get_bloginfo( 'name' ) . ' ' . date( 'Y' ) ) ); ?>
			<?php if ( apply_filters( 'storefront_credit_link', true ) ) { ?>
			<br /> <?php printf( esc_attr__( '%1$s designed by %2$s.', 'pepbrand' ), 'PepBrand', '<a href="http://pepthemes.com" alt="Premium Woocommerce themes" title="Premium Woocommerce themes" rel="designer" target="_blank">PepThemes</a>' ); ?>
			<?php } ?>
		</div><!-- .site-info -->
		<?php
	}

	function storefront_post_meta() {}
	function storefront_posted_on() {}
	

/**
 * Query WooCommerce activation
 */
function pepbrand_is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}


function pepbrand_customize_register() {     
global $wp_customize;
$wp_customize->remove_section( 'storefront_more' );  //Modify this line as needed  
} 

add_action( 'customize_register', 'pepbrand_customize_register', 11 );