<?php
/**
 * Default template of Multiple Layout
 *
 * @package RisingBambooCore
 */

use Elementor\Icons_Manager;
use RisingBambooCore\Helper\Helper;
use RisingBambooTheme\Helper\Setting;

if ( $sliders ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb-elementor-slider <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($layout); ?>">
		<div class="block_slide_content mx-auto">
			<div class="block_title text-center flex justify-center items-center">
				<?php if ( 'true' === $show_arrows ) { ?>
					<div class="slick-arrow-custom text-lg text-white">
						<span class="prev_custom mr-4 w-[40px] h-[40px] rounded-full bg-white text-black flex items-center justify-center cursor-pointer"></span>
					</div>
				<?php } ?>
				<?php if ( $widget_title || $widget_sub_title ) { ?>
					<div class="title_block inline-block">
						<?php
						if ( $widget_sub_title ) {
							?>
							<p class="sub-title text-2xl pb-3 mb-0"><?php echo esc_html($widget_sub_title); ?></p> <?php } ?>
							<?php
							if ( $widget_title ) {
								?>
								<h2 class="main-title"><?php echo esc_html($widget_title); ?></h2> <?php } ?>
							</div>
						<?php } ?>
						<?php if ( 'true' === $show_arrows ) { ?>
							<div class="slick-arrow-custom text-lg text-white">
								<span class="next_custom ml-4 w-[40px] h-[40px] rounded-full bg-white text-black flex items-center justify-center cursor-pointer"></span>
							</div>
						<?php } ?>
					</div>
					<div class="block_slide">
						<div class="rbb-slick-carousel slick-carousel slick-carousel-center" data-slick='{
							"arrows": <?php echo esc_attr($show_arrows); ?>,
							"appendArrows": "#<?php echo esc_attr($id); ?> .slick-arrow-custom",
							"prevArrow": "#<?php echo esc_attr($id); ?> .slick-arrow-custom .prev_custom",
							"nextArrow": "#<?php echo esc_attr($id); ?> .slick-arrow-custom .next_custom",
							"dots": <?php echo esc_attr($show_pagination); ?>,
							"autoplay": <?php echo esc_attr($autoplay); ?>,
							"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
							"slidesToShow": <?php echo esc_attr($sliders_to_show_default); ?>,
							"slidesToScroll": <?php echo esc_attr($sliders_to_show_default); ?>,
							<?php
							$i     = 1;
							$count = count($active_break_points);
							if ( $count ) {
								?>
								"responsive": [
								<?php
								foreach ( $active_break_points as $name => $break_point ) {
									$sliders_per_row_bp_val = $slick->get_value_setting('general_layout_multiple_sliders_to_show_' . $name);
									$sliders_per_row_bp     = $sliders_per_row_bp_val ? ceil(abs($sliders_per_row_bp_val['size'])) : $sliders_to_show_default;
									?>
									{
										"breakpoint": <?php echo esc_attr($break_point->get_value()); ?>,
										"settings": {
											"slidesToShow": <?php echo esc_attr($sliders_per_row_bp); ?>,
											"slidesToScroll": <?php echo esc_attr($sliders_per_row_bp); ?>
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
						}'>
						<?php
						foreach ( $sliders as $slider ) {
							$content_link             = $slider[ $slick->get_name_setting('multiple_content_link') ];
							$content_link_attr_string = false;
							if ( ! empty($content_link['url']) ) {
								$content_link_key = 'multiple_content_link_for_' . $slider['_id'];
								$slick->add_link_attributes($content_link_key, $content_link);
								$content_link_attr_string = $slick->get_render_attribute_string($content_link_key);
							}
							?>
							<div class="item elementor-repeater-item-<?php echo esc_attr($slider['_id']); ?>">
								<div class="block__content relative duration-300 bg-white md:shadow-[10px_10px_10px_0px_rgba(0,0,0,0.08)] shadow-[2px_2px_4px_0px_rgba(0,0,0,0.08)] rounded-[10px] overflow-hidden">
									<?php if ( $slider[ $slick->get_name_setting('multiple_content_image') ]['url'] ) { ?>
										<div class="block_image overflow-hidden rounded-t-[10px] transition-all">
											<img class="!inline-block" src="<?php echo esc_url($slider[ $slick->get_name_setting('multiple_content_image') ]['url']); ?>" alt="<?php echo esc_attr($slider[ $slick->get_name_setting('multiple_content_title') ]); ?>">
										</div>
										<?php
									}
									?>
									<div class="block_content flex justify-between items-center bg-white">
										<h5 class="text-sm font-semibold">
										<?php
											echo esc_attr($slider[ $slick->get_name_setting('multiple_content_title') ]);
										?>
										</h5>
										<div class="icon_slide_toggle cursor-pointer">
										</div>
									</div>
									<div class="block_content_toggle">
										<div class="text_content p-[30px]">
											<?php echo esc_attr($slider[ $slick->get_name_setting('multiple_content_description') ]); ?>
										</div>
									</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
