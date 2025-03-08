<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.9.0
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Setting;
$tabsproduct  = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_UP_CROSS_SELLS_LAYOUT);
$slidestoshow = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_RELATED_COLS);
if ( ! defined('ABSPATH') ) {
	exit;
}

if ( $related_products ) : ?>

	<section id="related-product" class="related rbb_woo_products relative<?php echo ( 'list' === $tabsproduct ) ? ' pb-[85px]' : ''; ?>">
		<?php if ( 'tabs' !== $tabsproduct ) { ?>
			<div class="flex items-center justify-between md:mb-[72px] mb-16 block_heading">
				<div class="rbb-title">
					<div class="text-[30px] font-bold"><?php echo esc_html__('Related Products', 'ecommax'); ?></div>
				</div>
				<div class="arrow-custom flex">
					<span class="prev_custom mr-5 text-center cursor-pointer"></span>
						<div class="button-collection flex items-center leading-none">
							<?php $shop_page_link = get_post_type_archive_link('product'); ?>
								<a class="flex items-center leading-none" href="<?php echo esc_url($shop_page_link); ?>"><span class="rbb-icon-view-grid-1"></span></a>
						</div>
					<span class="next_custom ml-5 text-center cursor-pointer"></span>
				</div>
			</div>
		<?php } ?>
		<div class="content_right slider_content">
			<div class="rbb-related-product rbb-slick-el slick-carousel slick-carousel-center rbb-product-content" data-slick='{
				"arrows": true,
				"appendArrows": "#related-product .arrow-custom",
				"prevArrow": "#related-product .arrow-custom .prev_custom",
				"nextArrow": "#related-product .arrow-custom .next_custom",
				"dots": true,
				"autoplay": false,
				"rows": 1,
				"slidesToScroll":1,
				"slidesToShow" : <?php echo esc_attr($slidestoshow); ?>,
				"responsive": [
					{
						"breakpoint": 1024,
						"settings": {
							"slidesToShow": 3
						}
					},
					{
						"breakpoint": 991,
						"settings": {
							"dots": false,
							"slidesToShow": 2
						}
					},
					{
						"breakpoint": 768,
						"settings": {
							"dots": false,
							"slidesToShow": 2
						}
					},
					{
						"breakpoint": 480,
						"settings": {
							"dots": false,
							"slidesToShow": 1
						}
					}
				]
			}'>
				<?php foreach ( $related_products as $related_product ) : ?>
					<?php
					$post_object = get_post($related_product->get_id());
                    //phpcs:ignore
					setup_postdata($GLOBALS['post'] =& $post_object);
					wc_get_template_part('content', 'product-related');
					?>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php
endif;

wp_reset_postdata();
