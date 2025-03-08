<?php
/**
 * Elementor widget : woo-product.
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;
	$product_images     = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_SHOW);
	$effect_images      = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGE_EFFECT);
	$product_categories = wc_get_product_terms($product->get_id(), 'product_cat', [ 'fields' => 'all' ]);
	$category_name      = '';
	$category_link      = '';
foreach ( $product_categories as $category ) {
	if ( 0 === $category->parent ) {
		$children_categories = get_terms(
			[
				'taxonomy'   => 'product_cat',
				'child_of'   => $category->term_id,
				'fields'     => 'ids',
				'hide_empty' => false,
			]
		);
		if ( ! empty($children_categories) ) {
				$first_child_category = get_term($children_categories[0], 'product_cat');
				$category_name        = $first_child_category->name;
				$category_link        = get_term_link($first_child_category);
		}
		break;
	}
}
if ( empty($category_name) && ! empty($product_categories) ) {
	$first_category = reset($product_categories);
	$category_name  = $first_category->name;
	$category_link  = get_term_link($first_category);
}
?>

<div class="item !flex justify-start h-auto">
	<div class="item-product w-full relative rounded-[10px] bg-white border border-[#e2e2e2] flex items-center shadow-[3px_3px_6px_rgba(0,0,0,0.08)]">
		<?php if ( $show_wishlist ) { ?>
			<div class="absolute md:top-5 z-10 top-3 md:right-5 right-3">
				<?php echo Tag::wish_list_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
		<?php } ?>
		<div class="product__content-left w-[47%] border-r-[1px] border-r-[#eaeaea]">
			<div class="thumbnail-container relative
			<?php
				echo wp_kses_post($effect_images);
				echo ( true === $product_images ) && \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 600, 600 ]) ? ' hover-images ' : ' none-hover-images ';
			?>
			">
				<a class="relative block overflow-hidden" href="<?php echo esc_url($product->get_permalink()); ?>">
					<?php
						echo wp_kses(
							$product->get_image(
								[ 640, 640 ],
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
					<?php if ( $product->is_featured() && 'instock' === $product->get_stock_status() ) { ?>
						<label class="bg-[#66ad53] text-white font-bold py-[5px] leading-[18px] px-[13px] text-[10px] h-[26px] rounded-[26px] block mb-[10px] uppercase text-center min-w-[66px]"><?php echo esc_html__('New', 'ecommax'); ?>
						</label>
					<?php } ?>
					<?php if ( 'instock' !== $product->get_stock_status() ) { ?>
						<label class="bg-[#66ad53] text-white font-bold py-[5px] px-[13px] leading-[18px] text-[10px] h-[26px] rounded-[26px] block mb-[10px] uppercase text-center min-w-[66px]"><?php echo esc_html__('Sold out', 'ecommax'); ?>
					</label>
					<?php } ?>
				</div>
			</div>
			<div class="product_info px-5">
				<div class="title-category uppercase font-bold pb-[6px]">
					<a class="text-xs duration-300 text-[#cdcdcd] hover:text-[color:var(--rbb-general-primary-color)]" href="<?php echo esc_url($category_link); ?>">
						<?php echo esc_html($category_name); ?>
					</a>
				</div>
				<a href="<?php echo esc_url($product->get_permalink()); ?>" class="product_name block font-semibold leading-[24px] mb-3"><?php echo wp_kses_post($product->get_name()); ?></a>
				<?php if ( $show_rating ) { ?>
					<div class="product_ratting text-amber-400 flex items-center mb-3">
						<?php echo wc_get_rating_html($product->get_average_rating()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<span class="ratting-count font-medium ml-1 text-xs text-[#3f4045]">(<?php echo wp_kses($product->get_rating_count(), 'rbb-kses'); ?>)</span>
					</div>
				<?php } ?>
				<?php $class_price = $product->is_on_sale() ? 'product_onsale' : 'product_price_discount'; ?>
				<div class="text-nowrap product_price text-base font-bold <?php echo esc_html($class_price); ?>">
					<?php echo wp_kses($product->get_price_html(), 'rbb-kses'); ?>
					<?php
					if ( $show_percentage_discount && $product->get_sale_price() ) {
						$regular_price   = $product->get_regular_price();
						$sale_price      = $product->get_sale_price();
						$sale_percentage = 100 - round(( $sale_price / $regular_price ) * 100);
						?>
						<label class="badge-sale align-top relative ml-[15px] min-w-[42px] text-white p-1 text-[0.625rem] rounded-[3px] leading-4 items-center h-[22px] justify-center bg-[#e55101] hidden sm:inline-flex">
							<?php echo '-' . esc_html($sale_percentage) . '%'; ?>
						</label>
					<?php } ?>
				</div>
			</div>
		</div>
		<div class="product__content-right w-[53%] px-[30px]">
			<div class="product_info-right">
				<div class="product_custom_field">
				<?php if ( $show_stock ) { ?>
					<div class="product_stock mb-3 text-xs">
						<?php
						if ( $product->get_stock_status() === 'instock' ) {
							if ( $product->get_stock_quantity() ) {
								?>
									<span class="stock in-stock">
									<?php
										// translators: 1: Product stock.
										echo sprintf(esc_html__(' %s Products in stock', 'ecommax'), esc_html($product->get_stock_quantity()));
									?>
									</span>
									<?php } else { ?>
										<span class="stock in-stock">
											<?php
												echo sprintf(esc_html__('In Stock', 'ecommax'));
											?>
										</span>
									<?php } ?>
						<?php } else { ?>
							<span class="stock out-of-stock"><?php echo esc_html__('Out of stock', 'ecommax'); ?></span>
						<?php } ?>
					</div>
				<?php } ?>
					<?php
					if ( $show_custom_field ) {
						if ( empty($custom_fields) ) {
							$custom_fields = get_post_custom_keys($product->get_id());
						}
						?>
						<div class="product_info_custom_field">
							<?php
							foreach ( $custom_fields as $custom_field ) {
								if ( in_array($custom_field, $custom_field_ignore, true) || strpos($custom_field, '_') === 0 ) {
									continue;
								}
								if ( $product->get_meta($custom_field) ) {
									?>
									<div class="data-item flex items-center ml-1">
								<span class="icon-checklist w-[12px] h-[12px] inline-flex"></span>
								<span class="block ml-4 text-xs font-normal leading-6 text-[color:var(--rbb-general-body-text-color)]">
										<?php echo esc_html($product->get_meta($custom_field)); ?>
								</span>
							</div>
									<?php
								}
							}
							?>
						</div>
						<?php
					}
					?>
				<?php
					$countdown_date_to = $product->get_date_on_sale_to();
				if ( $show_countdown && $countdown_date_to ) {
					$current_date         = new \WC_DateTime();
					$countdown_date_start = $product->get_date_on_sale_from() ?? $product->get_date_modified();
					if ( ( $current_date >= $countdown_date_start ) && ( $current_date <= $countdown_date_to ) ) {
						?>
							<div class="item-countdown !opacity-[1] sm:mt-[27px] mt-3">
								<div class="rbb-countdown flex relative ml-[-3px]" data-countdown-date="<?php echo esc_attr($countdown_date_to->format('Y/m/d')); ?>">
								<div class="item-time"><span class="data-number">%D</span><span class="name-time"><?php echo esc_html__('Day%!H', 'ecommax'); ?></span></div>
								<div class="item-time"><span class="data-number">%H</span><span class="name-time"><?php echo esc_html__('Hour%!H', 'ecommax'); ?></span></div>
								<div class="item-time"><span class="data-number">%M</span><span class="name-time"><?php echo esc_html__('Min%!H', 'ecommax'); ?></span></div>
								<div class="item-time"><span class="data-number">%S</span><span class="name-time"><?php echo esc_html__('Secs', 'ecommax'); ?></span></div>
								</div>
							</div>
							<?php
					}
				}
				?>
					<?php
					if ( true === $product->get_manage_stock() ) {
						$percent_sold           = ( $product->get_total_sales() / $product->get_stock_quantity() ) * 100;
						$percent_sold_formatted = number_format($percent_sold, 0, '', '');
						?>
					<div class="relative mt-[30px] h-2 rounded-[30px]" style="background-color: #e0e0e0">
						<div class="absolute h-2 rounded-[30px]" style="width: <?php echo esc_attr($percent_sold_formatted); ?>%;background: linear-gradient(90deg, rgba(255, 192, 0, 1), rgba(255, 0, 0, 1) 100%);"></div>
					</div>
					<div class="text-[#3f4045] text-[10px] font-bold mt-4 mb-2.5 uppercase">
						<span class="d-inline-block">
							<?php echo esc_html($percent_sold_formatted); ?><?php echo esc_html__('% Sold', 'ecommax'); ?>
						</span>
						<?php echo esc_html__(' - Available: ', 'ecommax'); ?><?php echo wp_kses_post($product->get_stock_quantity() - $product->get_total_sales()); ?>
					</div>
					<?php } ?>
				</div>
				<div class="product_group_button sm:mt-14 mt-7">
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
							$args['cart-icon'] = '<div class="add-to-cart-icon relative text-center" data-tooltips="' . $text_cart . '">' . $text_cart . '
							<i class="rbb-icon ' . $icon . '"></i></div>';
						}
						woocommerce_template_loop_add_to_cart($args);
					}
					?>
					<?php if ( ( $show_quickview || $show_compare ) ) { ?>
					<div class="product_group_button_bottom flex justify-between items-center pt-[10px]">
						<?php if ( $show_quickview ) { ?>
							<div class="quickview-icon">
								<?php echo Tag::quick_view_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						<?php } ?>
						<?php if ( $show_compare ) { ?>
							<div class="compare-icon">
								<?php echo Tag::compare_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						<?php } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>
