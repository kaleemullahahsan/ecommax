<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 */

use RisingBambooCore\Core\View;
use RisingBambooTheme\App\App;
/**
 * Use for woocommerce_template_loop_add_to_cart func.
 */
global $product;
if ( count($data['products']) ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb_woo_products <?php echo esc_attr($layout); ?>">
		<div class="2xl:container px-[15px] mx-auto relative">
			<div class="block_content">
				<div class="flex items-center justify-between md:mb-[37px] mb-7 block_heading">
					<?php if ( $show_title ) { ?>
					<div class="block_title flex justify-center items-center <?php echo esc_attr($show_filter) ? 'w-auto' : 'w-full'; ?>">
						<div class="mb-0">
						<?php if ( empty(trim($subtitle)) ) { ?>
							<h3 class="title uppercase"><?php echo wp_kses_post($data['title']); ?></h3>
						<?php } else { ?>
							<h3 class="title uppercase"><?php echo wp_kses_post($data['title']); ?></h3>
							<span class="sub-title block"><?php echo wp_kses_post($subtitle); ?></span>
						<?php } ?>
						</div>
					</div>
					<?php } ?>
					<?php
					if ( 'category' === $data['type'] && $show_filter ) {
						?>
					<div class="block_title_tab flex items-center">
						<?php
						$cat_count = count($data['categories']);
						if ( '1' < $cat_count || ( $show_filter && '1' === $cat_count ) ) {
							?>
									<select class="appearance-none"
											data-class="relative"
											data-ajax='{
												"action": "rbb_get_products_by_category",
												"fragment": "item-3",
												"order_by" : "<?php echo esc_attr($order_by); ?>",
												"order" : "<?php echo esc_attr($order); ?>",
												"limit" : "<?php echo esc_attr($limit); ?>",
												"show_wishlist" : <?php echo esc_attr(( $show_wishlist ) ? '1' : '0'); ?>,
												"show_rating" : <?php echo esc_attr(( $show_rating ) ? '1' : '0'); ?>,
												"show_quickview" : <?php echo esc_attr(( $show_quickview ) ? '1' : '0'); ?>,
												"show_compare" : <?php echo esc_attr(( $show_compare ) ? '1' : '0'); ?>,
												"show_countdown" : <?php echo esc_attr(( $show_countdown ) ? '1' : '0'); ?>,
												"show_percentage_discount" : <?php echo esc_attr(( $show_percentage_discount ) ? '1' : '0'); ?>,
												"show_add_to_cart" : <?php echo esc_attr(( $show_add_to_cart ) ? '1' : '0'); ?>,
												"show_stock" : <?php echo esc_attr(( $show_stock ) ? '1' : '0'); ?>,
												"show_custom_field" : <?php echo esc_attr(( $show_custom_field ) ? '1' : '0'); ?>,
												"custom_fields" : <?php echo wp_json_encode($custom_fields); ?>,
												"custom_field_ignore" : <?php echo wp_json_encode($custom_field_ignore); ?>
											}'
									>
								<?php foreach ( $data['categories'] as $category_id => $category ) { ?>
											<option value="<?php echo esc_attr($category_id); ?>"><?php echo wp_kses_post($category); ?></option>
										<?php } ?>
									</select>
								<?php } ?>

						<?php if ( $show_arrows ) { ?>
							<div class="arrow-custom flex md:ml-[52px]">
								<span class="prev_custom mr-5 text-center cursor-pointer"></span>
									<div class="button-collection flex items-center leading-none">
										<?php $shop_page_link = get_post_type_archive_link('product'); ?>
											<a class="flex items-center leading-none" href="<?php echo esc_url($shop_page_link); ?>"><span class="rbb-icon-view-grid-1"></span></a>
									</div>
								<span class="next_custom ml-5 text-center cursor-pointer"></span>
							</div>
								<?php
						}
						?>
					</div>
					<?php } ?>
				</div>
				<div class="rbb-slick-carousel slick-carousel slick-carousel-center !mb-4 load-item-<?php echo esc_attr($slides_per_row); ?>" data-slick='{
					"arrows": <?php echo esc_attr(( $show_arrows ) ? 'true' : 'false'); ?>,
					"appendArrows" : "#<?php echo esc_attr($id); ?> .arrow-custom",
					"prevArrow": "#<?php echo esc_attr($id); ?> .arrow-custom .prev_custom",
					"nextArrow": "#<?php echo esc_attr($id); ?> .arrow-custom .next_custom",
					"dots": <?php echo esc_attr(( $show_pagination ) ? 'true' : 'false'); ?>,
					"infinite": <?php echo esc_attr(( $autoplay ) ? 'true' : 'false'); ?>,
					"autoplay": <?php echo esc_attr(( $autoplay ) ? 'true' : 'false'); ?>,
					"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
					"rows": <?php echo esc_attr($row); ?>,
					"slidesPerRow" : <?php echo esc_attr($slides_per_row); ?>,
					<?php
						$i     = 1;
						$count = count($active_break_points);
					if ( $count ) {
						?>
							"responsive": [
							<?php
							foreach ( $active_break_points as $name => $break_point ) {
								$sliders_per_row_bp = ceil(abs($widget->get_value_setting('general_layout_slides_per_row_' . $name)['size'])) ?? $slides_per_row;
								?>
									{
										"breakpoint": <?php echo esc_attr($break_point->get_value()); ?>,
										"settings": {
											"slidesPerRow": <?php echo esc_attr($sliders_per_row_bp); ?>
										}
									}
									<?php
									if ( $i < $count ) {
										echo ',';
									}
									$i++;
							}
							?>
							]
						<?php } ?>
					}'
				>
					<?php
					foreach ( $data['products'] as $product ) {
						View::instance()->load(
							'elementor/widgets/woo-products/fragments/item-3',
							[
								'product' => $product,
							]
						);
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
