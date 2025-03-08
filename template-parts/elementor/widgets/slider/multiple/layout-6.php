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
		<div class="mx-auto content-slide">
			<div class="block_title flex justify-start items-start">
				<?php if ( $widget_title || $widget_sub_title ) { ?>
					<div class="title_block inline-block mb-[19px]">
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
						<div class="rbb-slick-grid grid grid-cols-2 gap-[10px] load-item-<?php echo esc_attr($sliders_to_show_default); ?>">
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
								<div class="block__content relative duration-300 bg-white text-center">
									<?php if ( $slider[ $slick->get_name_setting('multiple_content_image') ]['url'] ) { ?>
										<img class="pb-5 !inline-block image-content" src="<?php echo esc_url($slider[ $slick->get_name_setting('multiple_content_image') ]['url']); ?>" alt="<?php echo esc_attr($slider[ $slick->get_name_setting('multiple_content_title') ]); ?>">
									<?php } ?>
									<?php if ( $slider[ $slick->get_name_setting('multiple_content_title') ] ) { ?>
										<h4 class="text-xs pt-2 font-semibold pb-2.5 text-[color:var(--rbb-general-heading-color)] mt-2">
											<?php
											if ( 'url' === $button_type || $content_link_attr_string ) {
												?>
												<a <?php echo ! empty($content_link_attr_string) ? $content_link_attr_string : 'href="' . esc_url($button_url) . '"'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
													<?php echo esc_attr($slider[ $slick->get_name_setting('multiple_content_title') ]); ?>
												</a>
												<?php
											} else {
												echo esc_attr($slider[ $slick->get_name_setting('multiple_content_title') ]);
											}
											?>
										</h4>
									<?php } ?>
									<?php if ( $slider[ $slick->get_name_setting('multiple_content_description') ] ) { ?>
										<p class="text-xs font-normal text-center mb-4 text-[color:var(--rbb-general-body-text-color)]"><?php echo esc_html($slider[ $slick->get_name_setting('multiple_content_description') ]); ?></p>
									<?php } ?>
									<?php
									if ( $button ) {
										$button_url_target   = isset($slider[ $slick->get_name_setting('multiple_content_button_url') ]['is_external']) && 'on' === $slider[ $slick->get_name_setting('multiple_content_button_url') ]['is_external'] ? 'target="_blank"' : '';
										$button_url_nofollow = isset($slider[ $slick->get_name_setting('multiple_content_button_url') ]['nofollow']) && 'on' === $slider[ $slick->get_name_setting('multiple_content_button_url') ]['nofollow'] ? 'rel="nofollow"' : '';
										?>
										<a <?php echo ( 'url' !== $button_type ) ? 'onclick="RisingBambooModal.modal(\'#rbb-modal-multiple-button\', event)"' : ''; ?>
										href="<?php echo esc_url($button_url); ?>" <?php echo esc_attr($button_url_target); ?> <?php echo esc_attr($button_url_nofollow); ?>
										class="rbb-slick-button w-[50px] h-[50px] btn_view-all duration-300 rounded-full inline-flex justify-center items-center">
										<span class="rounded-full w-[50px] h-[50px] text-[15px] text-white inline-flex justify-center items-center bg-[color:var(--rbb-general-secondary-color)]">
											<?php
											if ( $button_icon['value'] ) {
												Icons_Manager::render_icon($button_icon, [ 'aria-hidden' => 'true' ]);
												?>
											<?php } else { ?>
												<i class="rbb-icon-store-16"></i>
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
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
