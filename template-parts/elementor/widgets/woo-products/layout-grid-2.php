<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 */

use RisingBambooCore\Core\View;
use RisingBambooCore\Helper\Elementor as RbbElementorHelper;
use RisingBambooTheme\App\App;

/**
 * Use for woocommerce_template_loop_add_to_cart func.
 */
global $product;
if ( count($data['products']) ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb_woo_products <?php echo esc_attr($layout); ?>">
		<?php if ( ! empty($surrounding_animation_image_01['url']) ) { ?>
			<div class="absolute top-0 left-[3%] md:block hidden z-10 animate-[iconbanner_3s_linear_infinite]">
				<img class="xl:w-full w-1/2" src="<?php echo esc_url($surrounding_animation_image_01['url']); ?>" alt="bg right" >
			</div>
		<?php } ?>
		<?php if ( ! empty($surrounding_animation_image_02['url']) ) { ?>
			<div class="absolute top-0 right-[3%] md:block hidden z-10 animate-[iconbanner_3s_linear_infinite]">
				<img class="xl:w-full w-1/2" src="<?php echo esc_url($surrounding_animation_image_02); ?>" alt="bg right" >
			</div>
		<?php } ?>
		<div class="block_content">
		<div class="grid grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 rbb-product-content">

			<?php
			foreach ( $data['products'] as $product_id => $product ) {
				if ( 0 === $product_id ) {
					?>
				<div class="item col-span-2 product-text-center flex items-center justify-center">
					<div class="text-left px-10 py-10 flex items-start justify-center flex-col product-text-content">
						<?php if ( $show_title ) { ?>
						<h4 class="heading uppercase text-xs mb-2"><?php echo esc_html__('Best Selers', 'ecommax'); ?></h4>
						<h3 class="title uppercase mb-5"><?php echo wp_kses_post($data['title']); ?></h3>
						<span class="sub-title"><?php echo wp_kses_post($subtitle); ?></span>
						<?php } ?>
						<?php $shop_page_link = get_post_type_archive_link('product'); ?>
						<a class="button-collection flex items-center leading-[52px] rounded-[5px] mt-14 px-8 transition-all uppercase text-white text-xs font-bold" href="<?php echo esc_url($shop_page_link); ?>"><?php echo esc_html__('Shop more', 'ecommax'); ?></a>
					</div>
				</div>
					<?php
				}
				View::instance()->load(
					'elementor/widgets/woo-products/fragments/item-4',
					[
						'product'  => $product,
						'loadTiem' => esc_attr($slides_per_row),
					]
				);
			}
			?>
		</div>
		</div>
	</div>
	<?php
}
?>
