<?php
get_header();

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );


add_action( 'woocommerce_before_shop_loop_item', 'alger_before_shop_loop_item', 10 );
add_action( 'woocommerce_after_shop_loop_item', 'alger_after_shop_loop_item', 5 );

add_action( 'woocommerce_before_shop_loop_item_title', 'alger_before_shop_loop_item_title', 10);

add_action( 'woocommerce_shop_loop_item_title', 'alger_template_loop_product_title', 10 );

add_action( 'alger_template_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10 );


add_action( 'alger_template_loop_price', 'woocommerce_template_loop_price', 10 );
add_action( 'alger_template_loop_rating', 'woocommerce_template_loop_rating', 5 );


function alger_woocommerce_show_page_title( ) {
    return false;
}
add_filter( 'woocommerce_show_page_title', 'alger_woocommerce_show_page_title' );


function alger_before_shop_loop_item() 
{
    $return = '<div class="product-inner">';
    echo $return;
}
	
function alger_after_shop_loop_item()
{
    $return = '</div>';
    echo $return;
}
	
function alger_product_single_add_to_cart_text()
{
    return '<i class="fa fa-shopping-cart"></i><i class="fa fa-check"></i>';
}

function alger_wcwl_add_wishlist_on_loop()
{
    echo do_shortcode('[yith_wcwl_add_to_wishlist]');
}
	
if (defined('YITH_WCWL')) {
    add_action( 'alger_add_to_wishlist', 'alger_wcwl_add_wishlist_on_loop', 15 );
}

function alger_before_shop_loop_item_title()
{
    global $post, $product, $woocommerce, $wishlists;

	$id               = get_the_ID();
	$size             = 'shop_catalog';
	$gallery          = get_post_meta($id, '_product_image_gallery', true);
	$attachment_image = '';

	if (!empty($gallery)) {
		$gallery          = explode( ',', $gallery );
		$first_image_id   = $gallery[0];
		$attachment_image = wp_get_attachment_image( $first_image_id, $size, false, array( 'class' => 'hover-image' ) );
	}
	
	if (has_post_thumbnail()) {
		$thumb = get_the_post_thumbnail(get_the_ID(), "shop_catalog"); 

		$product_image = $thumb.$attachment_image;
	} else {
		$product_image = '<img src="'. wc_placeholder_img_src() .'" alt="Placeholder" />';
	}
	
	$onsale = '';
	if ($product->is_on_sale()) : 
		$onsale = apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'alger' ) . '</span>', $post, $product ); 
	endif; 

	echo  '<a href="' . get_the_permalink() . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">'.$onsale.'
					  '.$product_image.'
					  <h2 class="woocommerce-loop-product__title">'.get_the_title().'</h2>';
											 do_action( 'alger_template_loop_rating' );
										//echo '<span class="price">';
                                              do_action( 'alger_template_loop_price' );
                                        //echo '</span>';
	
				 echo '</a>';
}
	
function alger_template_loop_product_title()
{
	
	global $post, $product, $woocommerce, $wishlists;
	
	$add_to_cart_link_class =  implode( ' ', array_filter( array(
					//	'product_type_' . $product->product_type,
						$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
						$product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
				) ) );
				
    do_action( 'alger_template_loop_add_to_cart',array('class'=> 'button '.$add_to_cart_link_class) );
    
}

?>
<?php
	if(is_archive()){
		$sidebar_layout = apply_filters('alger_woo_archive_sidebar_layout',alger_option('woo_archives_sidebar_layout'));
		$sidebar = 'woo-archives';
		}
	if(is_single()){
		$sidebar_layout = apply_filters('alger_woo_archive_sidebar_layout',alger_option('woo_single_sidebar_layout'));
		$sidebar = 'woo-single';
		}

		?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<?php echo apply_filters('alger_page_title_bar','','product');?>   

        
<?php alger_container_before_page( $sidebar_layout ); ?>
<div class="col-main">
 <section class="post-main" role="main" id="content">
	<?php woocommerce_content(); ?>
</section>
</div>     
<?php alger_container_after_page( $sidebar_layout );?>

</article>
<?php
get_footer();