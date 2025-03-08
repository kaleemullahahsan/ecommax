<?php
/**
 * Elementor widget : woo-product.
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;
	$product_images = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_SHOW);
	$effect_images  = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGE_EFFECT);
?>
<div class="item">
	<div class="item-product relative border rounded-[10px] bg-white flex justify-between items-center p-[5px]">
		<div class="thumbnail-container md:static relative
			<?php
				echo wp_kses_post($effect_images);
				echo ( true === $product_images ) && \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 600, 600 ]) ? ' hover-images ' : ' none-hover-images ';
			?>
			">
			<a class="relative block rounded-[10px] overflow-hidden" href="<?php echo esc_url($product->get_permalink()); ?>">
				<?php
					echo wp_kses(
						$product->get_image(
							[ 600, 600 ],
							[
								'class' => 'max-w-full w-full',
								'alt'   => esc_attr($product->get_name()),
							]
						),
						'rbb-kses'
					);
					if ( \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 600, 600 ]) ) {
						$second_image = \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 600, 600 ])[0];
						?>
						<img class="max-w-full image-cover absolute left-0 top-0 opacity-0" src="<?php echo esc_attr($second_image->src); ?>" alt="<?php echo esc_attr__('Second image of ', 'ecommax') . esc_attr($product->get_name()); ?>"/>
						<?php
					}
					?>
			</a>
	</div>
	<div class="px-5 py-4 product_info relative flex-grow">
		<?php if ( $show_rating ) { ?>
		<div class="product_ratting text-amber-400 flex items-center mb-1">
			<?php echo wc_get_rating_html($product->get_average_rating()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			<span class="ratting-count text-[#5e5e5e] font-medium ml-1 text-[10px]">(<?php echo esc_html($product->get_rating_count()); ?>)</span>
		</div>
		<?php } ?>
		<a href="<?php echo esc_url($product->get_permalink()); ?>" class="product_name text-xs font-semibold line-clamp-2 leading-6"><?php echo wp_kses_post($product->get_name()); ?></a>
	</div>
	<?php $class_price = $product->is_on_sale() ? 'product_onsale' : 'product_price_discount'; ?>
	<div class="product_price text-base font-bold <?php echo esc_html($class_price); ?>">
		<?php echo wp_kses($product->get_price_html(), 'rbb-kses'); ?>
	</div>
</div>
</div>
