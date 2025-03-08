<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 */

use RisingBambooCore\Core\View;
use RisingBambooCore\Helper\Elementor as RbbElementorHelper;
use RisingBambooTheme\App\App;

if ( count($posts['posts']) ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb_posts bg-cover <?php echo esc_attr($layout); ?>">
		<div class="block_slide 2xl:container px-[15px] mx-auto">
			<div class="block_heading flex items-center justify-between mb-12">
				<div class="block_title">
					<h3 class="title uppercase block "><?php echo wp_kses_post($posts['title']); ?></h3>
					<span class="sub-title block"><?php echo wp_kses_post($subtitle); ?></span>
				</div>
				<div class="block_title_tab flex items-center">
					<?php
					if ( isset($posts['type']) && 'category' === $posts['type'] && $show_filter ) {
						?>
						<?php
						$cat_count = count($posts['categories']);
						if ( 1 < $cat_count || ( $show_filter && 1 === $cat_count ) ) {
							?>
							<select class="appearance-none"
									data-class="relative inset-0 px-[30px] font-extrabold text-base uppercase cursor-pointer transition-all duration-200 ease-in border-2 rounded-3xl"
									data-ajax='{
									"action": "rbb_get_posts_by_category",
									"fragment": "item-2",
									"order_by" : "<?php echo esc_attr($order_by); ?>",
									"order" : "<?php echo esc_attr($order); ?>",
									"limit" : "<?php echo esc_attr($limit); ?>",
									"show_author" : "<?php echo esc_attr($show_author); ?>",
									"show_date" : "<?php echo esc_attr($show_date); ?>",
									"show_read_more" : "<?php echo esc_attr($show_read_more); ?>"
								}'
							>
								<?php foreach ( $posts['categories'] as $category_id => $category ) { ?>
									<option value="<?php echo esc_attr($category_id); ?>"><?php echo wp_kses_post($category); ?></option>
								<?php } ?>
							</select>
						<?php } ?>
						<?php
					}
					?>
					<?php if ( $show_arrows ) { ?>
						<div class="arrow-custom md:flex hidden ml-16">
							<span class="prev_custom mr-5 text-center cursor-pointer slick-arrow"></span>
								<div class="button-collection flex items-center leading-none">
									<?php $shop_page_link = get_post_type_archive_link('product'); ?>
										<a class="flex items-center leading-none" href="
										<?php
										if ( ! empty($posts['categories']) ) {
											foreach ( $posts['categories'] as $category_id => $category_name ) {
												$category_link = get_category_link($category_id);
												echo esc_url($category_link);
												break;
											}
										} else {
											echo '#';
										}
										?>
										"><span class="rbb-icon-view-grid-1"></span></a>
								</div>
							<span class="next_custom ml-5 text-center cursor-pointer slick-arrow"></span>
						</div>
					<?php } ?>
				</div>
			</div>
			<div class="block_content_posts">
				<div class="rbb-slick-carousel slick-carousel slick-carousel-center overflow-hidden" data-slick='{
					"dots": <?php echo esc_attr(( $show_pagination ) ? 'true' : 'false'); ?>,
					"arrows": <?php echo esc_attr(( $show_arrows ) ? 'true' : 'false'); ?>,
					"appendArrows" : "#<?php echo esc_attr($id); ?> .arrow-custom",
					"prevArrow": "#<?php echo esc_attr($id); ?> .arrow-custom .prev_custom",
					"nextArrow": "#<?php echo esc_attr($id); ?> .arrow-custom .next_custom",
					"autoplay": <?php echo esc_attr(( $autoplay ) ? 'true' : 'false'); ?>,
					"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
					"pauseOnFocus": <?php echo esc_attr(( $autoplay_pause ) ? 'true' : 'false'); ?>,
					"pauseOnHover": <?php echo esc_attr(( $autoplay_pause ) ? 'true' : 'false'); ?>,
					"rows": <?php echo esc_attr($row); ?>,
					"slidesToShow": <?php echo esc_attr($slides_per_row); ?>,
					<?php
						$i     = 1;
						$count = count($active_break_points);
					if ( $count ) {
						?>
						"responsive": [
						<?php
						foreach ( $active_break_points as $name => $break_point ) {
							$sliders_per_row_bp_val = $widget->get_value_setting('general_layout_slides_per_row_' . $name);
							$sliders_per_row_bp     = $sliders_per_row_bp_val ? ceil(abs($sliders_per_row_bp_val['size'])) : $slides_per_row;
							?>
									{
										"breakpoint": <?php echo esc_attr($break_point->get_value()); ?>,
										"settings": {
											"slidesToShow": <?php echo esc_attr($sliders_per_row_bp); ?>
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
					foreach ( $posts['posts'] as $_post ) {
						View::instance()->load(
							'elementor/widgets/posts/fragments/item-2',
							[
								'_post' => $_post,
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
