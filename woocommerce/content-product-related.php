<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

use RisingBambooTheme\Helper\Helper;
use RisingBambooCore\App\App;
use RisingBambooCore\Helper\Woocommerce as RbbCoreHelperWoocommerce;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;

$product_images = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGES_SHOW);
$effect_images  = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_PRODUCT_IMAGE_EFFECT);

defined('ABSPATH') || exit;

global $product;

// Ensure visibility.
if ( empty($product) || ! $product->is_visible() ) {
	return;
}
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

$show_wishlist       = Setting::get(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_WISHLIST);
$show_rating         = Setting::get(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_RATING);
$show_quick_view     = Setting::get(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_QUICK_VIEW);
$show_compare        = Setting::get(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_COMPARE);
$show_add_to_cart    = Setting::get(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_ADD_TO_CART);
$show_stock          = Setting::get(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_STOCK);
$show_custom_field   = Setting::get(RISING_BAMBOO_KIRKI_SECTION_WOOCOMMERCE_PRODUCT_CATALOG_PRODUCT_ITEM_SHOW_CUSTOM_FIELDS);
$custom_field_ignore = [ 'total_sales', 'woosw_count', 'woosw_add', 'woosw_remove' ];

?>
<div class="item h-auto">
<div class="item-product">
		<div class="relative rounded-[10px] z-10">
		<div class="thumbnail-container relative rounded-[10px]
			<?php
				echo wp_kses_post($effect_images);
				echo ( true === $product_images ) && \RisingBambooCore\Helper\Woocommerce::get_gallery_image($product, [ 600, 600 ]) ? ' hover-images ' : ' none-hover-images ';
			?>
			">

			<a class="relative block overflow-hidden rounded-[10px]" href="<?php echo esc_url($product->get_permalink()); ?>">
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
					if ( RbbCoreHelperWoocommerce::get_gallery_image($product, [ 600, 600 ]) ) {
						$second_image = RbbCoreHelperWoocommerce::get_gallery_image($product, [ 600, 600 ])[0];
						?>
				<img class="max-w-full image-cover absolute left-0 top-0 opacity-0" src="<?php echo esc_attr($second_image->src); ?>" alt="<?php echo esc_attr__('Second image of ', 'ecommax') . esc_attr($product->get_name()); ?>"/>
						<?php
					}
					?>
			</a>
			<div class="product_button absolute flex items-center justify-center w-full">
			<?php if ( $show_quick_view ) { ?>
				<div class="quickview-icon">
					<?php echo Tag::quick_view_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			<?php } ?>
			<?php if ( $show_wishlist ) { ?>
				<div class="wishlist-icon">
					<?php echo Tag::wish_list_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			<?php } ?>
			<?php if ( $show_compare ) { ?>
				<div class="compare-icon">
					<?php echo Tag::compare_button($product); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				</div>
			<?php } ?>
			</div>
		</div>
		<div class="product_info w-full px-5 pb-9 mt-6">
			<div class="title-category uppercase font-bold pb-[6px]">
			<a class="text-xs duration-300 text-[#cdcdcd] hover:text-[color:var(--rbb-general-primary-color)]" href="<?php echo esc_url($category_link); ?>">
				<?php echo esc_html($category_name); ?>
			</a>
			</div>
			<a href="<?php echo esc_url($product->get_permalink()); ?>" class="product_name line-clamp-2 xl:text-[0.875rem] text-[0.8125rem] font-semibold mb-2"><?php echo wp_kses_post($product->get_name()); ?></a>
			<?php if ( $show_rating ) { ?>
			<div class="product_ratting text-amber-400 flex items-center mb-3">
				<?php echo wc_get_rating_html($product->get_average_rating()); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
				<span class="ratting-count text-[#5e5e5e] font-medium ml-1 text-[10px]">(<?php echo esc_html($product->get_rating_count()); ?>)</span>
			</div>
			<?php } ?>
			<?php $class_price = $product->is_on_sale() ? 'product_onsale' : 'product_price'; ?>
			<div class="product_price text-base font-bold <?php echo esc_html($class_price); ?>">
			<?php echo wp_kses($product->get_price_html(), 'rbb-kses'); ?>
			</div>
		</div>
		<div class="product__bottom w-full relative pb-2 <?php echo esc_attr(( $show_stock || $show_custom_field ) ? 'pt-5' : 'border-top-0'); ?>">
			<?php if ( $show_stock || $show_custom_field ) { ?>
			<div class="product_custom_field px-5 pb-5">
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
					$custom_fields = [];
					if ( empty($custom_fields) ) {
						$custom_fields = get_post_custom_keys($product->get_id());
					}
					$popular_keywords = Helper::get_popular_keyword_custom_fields();
					if ( ! empty($popular_keywords) ) {
						$common_fields = array_intersect($custom_fields, $popular_keywords);
					} else {
						$common_fields = $custom_fields;
					}
					?>
					<div class="product_info_custom_field">
						<?php
						foreach ( $common_fields as $custom_field ) {
							if ( in_array($custom_field, $custom_field_ignore, true) || strpos($custom_field, '_') === 0 ) {
								continue;
							}
							$meta_value = $product->get_meta($custom_field);
							if ( $meta_value ) {
								?>
								<div class="data-item flex items-center ml-1">
									<span class="icon-checklist w-[12px] h-[12px] inline-flex"></span>
									<span class="block ml-4 text-xs font-normal leading-6 text-[color:var(--rbb-general-body-text-color)]">
											<?php echo esc_html($meta_value); ?>
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
			</div>
			<?php } ?>
			<?php
			if ( $show_add_to_cart ) {
				$args      = [];
				$text_cart = '';
				$icon      = Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_MINI_CART_ICON);
				if ( 'instock' !== $product->get_stock_status() ) {
					$text_cart = esc_html__('Out of stock', 'ecommax');
				} elseif ( $product instanceof WC_Product_Variable && $product->get_available_variations() ) {
					$text_cart = esc_html__('Select options', 'ecommax');
				} else {
					$text_cart = esc_html__('Add to Cart', 'ecommax');
				}
				if ( $icon ) {
					$args['cart-icon'] = '<div class="add-to-cart-icon relative text-center" data-tooltips="' . $text_cart . '">' . $text_cart . '
						<i class="rbb-icon ' . $icon . '"></i></div>';
				}
				woocommerce_template_loop_add_to_cart($args);
			}
			?>
		</div>
	</div>
	<div class="product__bottom-fade">
	</div>
</div>
</div>
