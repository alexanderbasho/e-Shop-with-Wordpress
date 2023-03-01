<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<?php
	do_action( 'storefront_before_header' ); 

	?>

	<?php 	do_action ('pepbrand_secondary_navigation'); ?>
	<header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">

		<div class="col-full">

			<div class="navigation-area">
				

				<?php
			/**
			 * Functions hooked into pepbrand_header action
			 *
			 * @hooked storefront_product_search		-	10
			 * @hooked storefront_site_branding			-	20
			 * @hooked storefront_header_chart 			-	30
			 * @hooked storefront_primary_navigation 	-	40
			 * @hooked storefront_secondary_navigation	-	50
			 */
			do_action( 'pepbrand_header' ); ?>


			</div>

		</div>
	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 */
	do_action( 'storefront_before_content' ); ?>

	<div id="content" class="site-content" tabindex="-1">
		<div class="col-full">

		<?php
		/**
		 * Functions hooked in to storefront_content_top
		 *
		 * @hooked woocommerce_breadcrumb - 10
		 */
		do_action( 'storefront_content_top' );
