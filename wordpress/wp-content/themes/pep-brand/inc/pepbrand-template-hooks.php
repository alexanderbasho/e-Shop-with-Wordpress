<?php
/**
 * pepbrand hooks
 *
 * @package pepbrand
 */



/**
 * Header
 * @see  storefront_skip_links()
 * @see  storefront_secondary_navigation()
 * @see  storefront_site_branding()
 * @see  storefront_primary_navigation()
 */

add_action ('pepbrand_secondary_navigation', 'storefront_secondary_navigation', 5 );
add_action( 'pepbrand_header', 'storefront_site_branding',			20 );
add_action( 'pepbrand_header', 'storefront_primary_navigation', 40 );




/**
 * Footer
 *
 * @see  storefront_footer_widgets()
 * @see  storefront_credit()
 */

add_action ('pepthemes_footer', 'storefront_footer_widgets',	10 );
add_action ('pepthemes_footer', 'storefront_credit', 20 );