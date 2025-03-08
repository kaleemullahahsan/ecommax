<?php
/**
 * Product categories in product loop.
 *
 * @package RisingBambooTheme
 * @version 1.0.0
 * @since 1.0.0
 */

use RisingBambooCore\Helper\Woocommerce as RbbCoreWoocommerceHelper;
use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Setting;

$display_type       = woocommerce_get_loop_display_mode();
$categories         = woocommerce_get_product_subcategories(RbbCoreWoocommerceHelper::get_term_id());
$categories_per_row = Setting::get(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_CATEGORIES_PER_ROW);
?>
<div class="container mx-auto">
	<?php
	if ( 'subcategories' === $display_type ) {
		?>
		<div class="content-categories-loop -mx-[15px] pt-4">
			<?php foreach ( $categories as $category ) { ?>
				<div class="items lg_width_<?php echo esc_attr($categories_per_row); ?> md:w-1/3 w-1/2 md:px-[15px] px-2 mb-[25px] float-left">
					<div class="item-product-cat-content text-center group">
						<div class="img-cate overflow-hidden">
							<a href="<?php echo esc_url(get_term_link($category->term_id, 'product_cat')); ?>">
								<?php
								$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
								$image        = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large_custom_size') : wc_placeholder_img_src();
								?>
								<img class="w-full duration-300 max-h-[80px]" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>"/>
							</a>
						</div>
						<div class="content pt-[25px]">
							<h2 class="item-title text-base">
								<a href="<?php echo esc_url(get_term_link($category->term_id, 'product_cat')); ?>"><?php echo esc_html($category->name); ?></a>
							</h2>
							<div class="pt-[5px]"><?php echo esc_html($category->count) . esc_html__(' Products', 'ecommax'); ?></div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php
	} else {
		?>
		<div class="content-categories-top xl:px-28 lg:px-24 lg:-mt-[113px] md:mt-20 mt-16 relative overflow-hidden">
			<div class="content-categories flex rbb-slick-el
			<?php
			if ( count($categories) < $categories_per_row ) {
				echo 'items_center';}
			?>
			" data-slick='{
				"dots": false,
				"nav": true,
				"slidesToShow": <?php echo esc_attr($categories_per_row); ?>,
				"slidesToScroll": 1,
				"infinite": false,
				"responsive": [
					{
						"breakpoint": 1310,
						"settings": {
							"slidesToShow": 3
						}
					},
					{
						"breakpoint": 992,
						"settings": {
							"slidesToShow": 3
							}
						},
					{
						"breakpoint": 768,
						"settings": {
							"slidesToShow": 2
						}
					}
				]
			}'>
			<?php foreach ( $categories as $category ) { ?>
				<div class="items items-<?php echo esc_attr($categories_per_row); ?> px-[10px] py-[10px]">
					<div class="item-product-cat-content text-center bg-white">
						<div class="img-cate inline-block overflow-hidden pb-4">
							<a href="<?php echo esc_url(get_term_link($category->term_id, 'product_cat')); ?>">
								<?php
								$thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
								$image        = $thumbnail_id ? wp_get_attachment_image_url($thumbnail_id, 'large_custom_size') : wc_placeholder_img_src();
								?>
								<img class="w-full duration-300 max-h-[80px]" src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($category->name); ?>"/>
							</a>
						</div>
						<div class="content">
							<h4 class="item-title text-base">
								<a class="text-sm" href="<?php echo esc_url(get_term_link($category->term_id, 'product_cat')); ?>"><?php echo esc_html($category->name); ?></a>
							</h4>
							<div class="pt-[5px] text-sm"><?php echo esc_html($category->count) . esc_html__(' Products', 'ecommax'); ?></div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>
</div>
