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
		<div class="block_manufacture">
			<div class="block_title flex justify-center items-center">
				<?php if ( $widget_title || $widget_sub_title ) { ?>
					<div class="title_block inline-block mb-5">
						<?php if ( $widget_title ) { ?>
							<h4 class="main-title text-[color:var(--rbb-general-heading-color)] text-2xl pb-4 uppercase font-bold"><?php echo esc_html($widget_title); ?></h4>
																																			<?php
						}
						?>
						<?php if ( $widget_sub_title ) { ?>
							<p class="sub-title text-[color:var(--rbb-general-body-text-color)] text-base font-normal pb-4"><?php echo esc_html($widget_sub_title); ?></p>
						<?php } ?>

					</div>
				<?php } ?>
				</div>
				<div class="block_slide">
					<div class="rbb-slick-carousel slick-carousel slick-carousel-center" data-slick='{
						"arrows": <?php echo esc_attr($show_arrows); ?>,
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
						$button_url               = isset($slider[ $slick->get_name_setting('multiple_content_button_url') ]) ? $slider[ $slick->get_name_setting('multiple_content_button_url') ]['url'] : '#';
						$content_link             = $slider[ $slick->get_name_setting('multiple_content_link') ];
						$content_link_attr_string = false;
						?>
						<div class="item manufacture__item elementor-repeater-item-<?php echo esc_attr($slider['_id']); ?>">
							<div class="block__content relative duration-300 bg-white text-center rounded-[10px]">
								<?php if ( $slider[ $slick->get_name_setting('multiple_content_image') ]['url'] ) { ?>
									<a <?php echo ! empty($content_link_attr_string) ? esc_attr($content_link_attr_string) : 'href="' . esc_url($button_url) . '"'; ?> class="block w-full manufacture__link elementor-animation-pulse">
									<img class="!inline-block" src="<?php echo esc_url($slider[ $slick->get_name_setting('multiple_content_image') ]['url']); ?>" alt="<?php echo esc_attr($slider[ $slick->get_name_setting('multiple_content_title') ]); ?>">
									</a>
								<?php } else { ?>
									<img class="object-cover w-full" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/dist/images/default-thumbnail.png'); ?>" alt="<?php echo esc_attr__('thumbnail', 'ecommax'); ?>" >
								<?php } ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
