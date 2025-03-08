<?php
/**
 * Default template of Multiple Layout
 *
 * @package RisingBambooCore
 */

use Elementor\Icons_Manager;
use RisingBambooTheme\App\App;
use RisingBambooCore\Helper\Elementor as RisingBambooElementorHelper;
use RisingBambooCore\Helper\Helper;
use RisingBambooTheme\Helper\Setting;

$modal_effect    = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT);
$outside         = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE);
$backdrop_filter = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER);
$classes         = [];
$classes[]       = ( true === $backdrop_filter ) ? 'backdrop' : 'backdrop-none';
$classes[]       = ( false === $outside ) ? 'outside-modal' : '';
$class_string    = implode(' ', array_filter($classes));

if ( $sliders ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb-elementor-slider <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($layout); ?>">
		<?php if ( ! empty($surrounding_animation_image_01['url']) ) { ?>
			<div class="bg-left hidden wow fadeInLeft absolute top-[140px] left-[50px] z-10" data-wow-delay="0.4s">
				<img src="<?php echo esc_url($surrounding_animation_image_01['url']); ?>" alt="bg left" >
			</div>
		<?php } ?>
		<?php if ( ! empty($surrounding_animation_image_02['url']) ) { ?>
			<div class="bg-right hidden wow fadeInRight absolute top-[10px] right-[60px] z-10" data-wow-delay="0.4s">
				<img src="<?php echo esc_url($surrounding_animation_image_02['url']); ?>" alt="bg right" >
			</div>
		<?php } ?>
		<div class="2xl:container px-[15px] mx-auto">
			<div class="block_title text-center flex justify-center items-center">
				<?php if ( $widget_title || $widget_sub_title ) { ?>
					<div class="title_block inline-block mb-[14px]">
						<?php if ( $widget_sub_title ) { ?>
							<p class="sub-title text-[var(--rbb-general-heading-color)] text-2xl pb-3"><?php echo esc_html($widget_sub_title); ?></p>
						<?php } ?>
						<?php if ( $widget_title ) { ?>
							<h4 class="main-title text-[var(--rbb-general-heading-color)] text-xl uppercase"><?php echo esc_html($widget_title); ?></h4>
																														<?php
						}
						?>
					</div>
				<?php } ?>
				</div>
					<div class="block_slide">
						<div class="rbb-slick-carousel slick-carousel slick-carousel-center load-item-<?php echo esc_attr($sliders_to_show_default); ?>" data-slick='{
							"arrows": <?php echo esc_attr($show_arrows); ?>,
							"dots": <?php echo esc_attr($show_pagination); ?>,
							"autoplay": <?php echo esc_attr($autoplay); ?>,
							"infinite":true,
							"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
							"slidesToShow": <?php echo esc_attr($sliders_to_show_default); ?>,
							"slidesToScroll": 1,
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
											"slidesToScroll": 1
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
							$button                   = $slider[ $slick->get_name_setting('multiple_content_button') ] ?? null;
							$button_icon              = $slider[ $slick->get_name_setting('multiple_content_button_icon') ];
							$button_type              = $slider[ $slick->get_name_setting('multiple_content_button_type') ] ?? null;
							$button_url               = isset($slider[ $slick->get_name_setting('multiple_content_button_url') ]) ? $slider[ $slick->get_name_setting('multiple_content_button_url') ]['url'] : '#';
							$content_link             = $slider[ $slick->get_name_setting('multiple_content_link') ];
							$content_link_attr_string = false;
							if ( ! empty($content_link['url']) ) {
								$content_link_key = 'multiple_content_link_for_' . $slider['_id'];
								$slick->add_link_attributes($content_link_key, $content_link);
								$content_link_attr_string = $slick->get_render_attribute_string($content_link_key);
							}
							?>
							<div class="item elementor-repeater-item-<?php echo esc_attr($slider['_id']); ?>">
								<div class="block__content relative duration-300 text-center">

									<?php if ( $slider[ $slick->get_name_setting('multiple_content_image') ]['url'] ) { ?>
										<div class="block_image relative">
											<img class="!inline-block image-content w-full" src="<?php echo esc_url($slider[ $slick->get_name_setting('multiple_content_image') ]['url']); ?>" alt="<?php echo esc_attr($slider[ $slick->get_name_setting('multiple_content_title') ]); ?>">
										</div>
									<?php } ?>
									<div class="block_content_text relative pt-[26px] bg-white">
										<?php if ( $slider[ $slick->get_name_setting('multiple_content_title') ] ) { ?>
											<h4 class="text-sm font-bold text-[color:var(--rbb-general-heading-color)] uppercase mb-2">
												<?php echo esc_attr($slider[ $slick->get_name_setting('multiple_content_title') ]); ?>
											</h4>
										<?php } ?>
										<?php if ( $slider[ $slick->get_name_setting('multiple_content_description') ] ) { ?>
											<div class="description text-xs font-normal text-center mb-4 text-[color:var(--rbb-general-body-text-color)]"><?php echo wp_kses_post($slider[ $slick->get_name_setting('multiple_content_description') ]); ?></div>
										<?php } ?>
										<?php
										if ( $button ) {
											$button_url_target   = isset($slider[ $slick->get_name_setting('multiple_content_button_url') ]['is_external']) && 'on' === $slider[ $slick->get_name_setting('multiple_content_button_url') ]['is_external'] ? 'target="_blank"' : '';
											$button_url_nofollow = isset($slider[ $slick->get_name_setting('multiple_content_button_url') ]['nofollow']) && 'on' === $slider[ $slick->get_name_setting('multiple_content_button_url') ]['nofollow'] ? 'rel="nofollow"' : '';
											?>
											<a <?php echo ( 'url' !== $button_type ) ? 'onclick="RisingBambooModal.modal(\'#rbb-modal-multiple-button\', event)"' : ''; ?>
											href="<?php echo esc_url($button_url); ?>" <?php echo esc_attr($button_url_target); ?> <?php echo esc_attr($button_url_nofollow); ?>
											class="rbb-slick-button btn_view-all duration-300  inline-flex justify-center items-center pb-7">
											<span class="text-xs inline-flex font-semibold text-[color:var(--rbb-general-heading-color)] transition-all hover:text-[color:var(--rbb-general-primary-color)]">
												<?php echo esc_attr($button); ?>
												<?php
												if ( $button_icon['value'] ) {
													Icons_Manager::render_icon($button_icon, [ 'aria-hidden' => 'true' ]);
													?>
												<?php } ?>
											</span>
										</a>
											<?php
											if ( 'url' !== $button_type ) {
												?>
											<div id="rbb-modal-multiple-button" class="rbb-modal <?php echo esc_attr($class_string); ?>" data-modal-animation="<?php echo esc_attr($modal_effect); ?>">
												<div class="rbb-modal-dialog">
													<header class="rbb-modal-header">
														<button class="rbb-close-modal"
														aria-label="close modal">
													</button>
												</header>
												<div class="rbb-modal-body">
													<?php
													if ( 'video' === $button_type ) {
														$button_video_url = $slider[ $slick->get_name_setting('multiple_content_button_video') ]['url'];
														?>
														<video width="640" height="360" controls>
															<source src="<?php echo esc_attr($button_video_url); ?>">
																Your browser does not support the video tag.
															</video>

															<?php
													} elseif ( 'youtube' === $button_type ) {
														$button_video_url = Helper::get_youtube_embed($slider[ $slick->get_name_setting('multiple_content_button_youtube') ]);
														?>
															<iframe width="640" height="360"
															src="<?php echo esc_attr($button_video_url); ?>"
															title="YouTube video player"
															allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
															allowfullscreen></iframe>
														<?php
													} elseif ( 'vimeo' === $button_type ) {
														$button_video_url = Helper::get_vimeo_embed($slider[ $slick->get_name_setting('multiple_content_button_vimeo') ]);
														?>
															<iframe width="640" height="360"
															src="<?php echo esc_attr($button_video_url); ?>"
															allow="autoplay; fullscreen; picture-in-picture"
															allowfullscreen></iframe>
														<?php
													} elseif ( 'dailymotion' === $button_type ) {
														$button_video_url = Helper::get_dailymotion_embed($slider[ $slick->get_name_setting('multiple_content_button_dailymotion') ]);
														?>
															<iframe width="640" height="360"
															type="text/html"
															src="<?php echo esc_attr($button_video_url); ?>"
															allowfullscreen
															allow="autoplay"></iframe>
												<?php } ?>
													</div>
												</div>
											</div>
											<?php } ?>
									<?php } ?>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
