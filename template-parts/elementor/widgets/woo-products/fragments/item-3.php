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
	<div class="item-product relative border rounded-[10px] bg-white flex justify-center items-center p-[5px]">
		<?php if ( $show_wishlist ) { ?>
			<div class="absolute md:top-5 z-10 top-3 md:right-5 right-3">
				<?php echo Tag::wish_list_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		<?php } ?>
		<div class="w-[42%] thumbnail-container md:static relative
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
			<div class="product-flags absolute md:left-4 left-3 md:top-5 top-3 z-10 font-semibold text-[11px] hidden sm:inline-flex">
				<?php if ( 'instock' === $product->get_stock_status() && $product->is_featured() ) { ?>
					<label class="bg-[#66ad53] text-white font-bold py-[5px] px-[13px] leading-[18px] text-[10px] h-[26px] rounded-[26px] block mb-2.5 uppercase text-center min-w-[66px]"><?php echo esc_html__('New', 'ecommax'); ?></label>
				<?php } ?>
				<?php if ( 'instock' !== $product->get_stock_status() ) { ?>
					<label class="bg-[#66ad53] text-white font-bold py-[5px] px-[13px] leading-[18px] text-[10px] h-[26px] rounded-[26px] block mb-2.5 uppercase text-center min-w-[66px]"><?php echo esc_html__('Sold out', 'ecommax'); ?>
					</label>
				<?php } ?>
			</div>
	</div>
	<div class="w-[58%] md:py-4 pt-4 pb-6 md:px-[15px] product_info relative">
		<div class="product_info-bottom bg-white pt-3 md:px-0 px-3">
			<?php if ( $show_rating ) { ?>
				<div class="product_ratting text-amber-400 flex items-center mb-3.5">
					<?php echo wc_get_rating_html($product->get_average_rating()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<span class="ratting-count text-[#5e5e5e] font-medium ml-1 text-[10px]">(<?php echo esc_html($product->get_rating_count()); ?>)</span>
				</div>
			<?php } ?>
			<a href="<?php echo esc_url($product->get_permalink()); ?>" class="product_name block md:text-base text-[0.8125rem] font-semibold md:mb-5 mb-2"><?php echo wp_kses_post($product->get_name()); ?></a>
			<?php $class_price = $product->is_on_sale() ? 'product_onsale' : 'product_price_discount'; ?>
			<div class="product_price text-base font-bold <?php echo esc_html($class_price); ?>">
					<?php echo wp_kses($product->get_price_html(), 'rbb-kses'); ?>
					<?php
					if ( $show_percentage_discount && $product->get_sale_price() ) {
						$regular_price   = $product->get_regular_price();
						$sale_price      = $product->get_sale_price();
						$sale_percentage = 100 - round(( $sale_price / $regular_price ) * 100);
						?>
						<label class="badge-sale align-top relative ml-[15px] min-w-[42px] text-white p-2 text-[0.625rem] rounded-[2px] leading-4 items-center h-[22px] justify-center bg-[#e55101] hidden sm:inline-flex">
							<?php echo '-' . esc_html($sale_percentage) . '%'; ?>
						</label>
					<?php } ?>
			</div>
		</div>
		<div class="product-groups bottom-0 opacity-0 absolute duration-300 left-[15px]">
			<div class="flex relative">
			<?php
			if ( $show_add_to_cart ) {
				$args      = [];
				$text_cart = '';
				$icon      = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON);
				if ( 'instock' !== $product->get_stock_status() ) {
					$text_cart = esc_html__('Out of stock', 'ecommax');
				} else {
					if ( $product instanceof \WC_Product_Variable && $product->get_available_variations() ) {
						$text_cart = esc_html__('Select options', 'ecommax');
					} else {
						$text_cart = esc_html__('Add to Cart', 'ecommax');
					}
				}
				if ( $icon ) {
					$args['cart-icon'] = '<div class="add-to-cart-icon relative text-center" data-tooltips="' . $text_cart . '">
					<i class="rbb-icon ' . $icon . '"></i>
					</div>';
				}
				woocommerce_template_loop_add_to_cart($args);
			}
			?>
			<?php
			if ( $show_compare ) {
				echo Tag::compare_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
			<?php
			if ( $show_quickview ) {
				echo Tag::quick_view_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
			?>
				</div>
			</div>
		</div>
	</div>
</div>
