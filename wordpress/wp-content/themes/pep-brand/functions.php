<?php
/**
 * shopaholic pepbrand
 * @package pepbrand
 */

 /**
  * Assign the Storefront version to a var
  */

 
 $theme              = wp_get_theme( 'pepbrand' );
 $storefront_version = $theme['Version'];
 
 



 /**
  * Initialize all the things.
  */

require 'inc/pepbrand-template-hooks.php';
require 'inc/class-pepbrand-customizer.php';
require 'inc/pepbrand-functions.php';
require 'inc/pepbrand-customizer-misc.php';

if ( pepbrand_is_woocommerce_activated() ) {
 require 'inc/pepbrand-woocommerce-template-hooks.php';
}




/**
 * Note: Do not add any custom code here. Please use a custom plugin so that your customizations aren't lost during updates.
 * https://github.com/woothemes/theme-customisations
 */

