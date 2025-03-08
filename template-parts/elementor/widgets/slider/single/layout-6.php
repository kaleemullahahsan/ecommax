<?php
/**
 * RisingBambooTheme package
 *
 * @package RisingBambooTheme
 */

use Elementor\Icons_Manager;
use RisingBambooCore\Helper\Helper as CoreHelper;
use RisingBambooCore\Helper\Elementor as RisingBambooElementorHelper;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\App\App;
use RisingBambooCore\Helper\Helper;

$modal_effect    = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT);
$outside         = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE);
$backdrop_filter = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER);
$classes         = [];
$classes[]       = ( true === $backdrop_filter ) ? 'backdrop' : 'backdrop-none';
$classes[]       = ( false === $outside ) ? 'outside-modal' : '';
$class_string    = implode(' ', array_filter($classes));

if ( $sliders ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb-elementor-slider overflow-hidden <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($layout); ?>">
		<div class="flex rbb-slick-carousel slick-carousel slick-carousel-center load-item" data-speed="<?php echo esc_attr($autoplay_speed); ?>" data-slick='{
			"arrows": true,
			"pauseOnHover": false,
			"pauseOnFocus": false,
			"appendArrows" : "#<?php echo esc_attr($id); ?> .dots_custom",
			"prevArrow": "#<?php echo esc_attr($id); ?> .dots_custom .prev_custom",
			"nextArrow": "#<?php echo esc_attr($id); ?> .dots_custom .next_custom",
			"dots": false,
			"autoplay": <?php echo esc_attr($autoplay); ?>,
			"fade": true,
			"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>
		}'>
			<?php
			foreach ( $sliders as $slider ) {
				$slider_title     = $slider[ $slick->get_name_setting('title') ] ?? null;
				$slider_sub_title = $slider[ $slick->get_name_setting('subtitle') ] ?? null;
				$description      = $slider[ $slick->get_name_setting('description') ] ?? null;
				$button_1         = $slider[ $slick->get_name_setting('button_1') ] ?? null;
				$button_2         = $slider[ $slick->get_name_setting('button_2') ] ?? null;
				?>
				<div class="w-full item elementor-repeater-item-<?php echo esc_attr($slider['_id']); ?>">
					<div class="item-content relative">
						<div class="absolute py-0 top-0 w-full h-full">
							<div class="container m-auto relative h-full">
								<?php
								if ( $slider_title || $slider_sub_title || $description || $button_1 || $button_2 ) {
									$horizontal_align = $slider[ $slick->get_name_setting('horizontal_align') ] ?? 'start';
									switch ( $horizontal_align ) {
										case 'end':
											$horizontal_align_class = 'right-0 md:text-right text-center';
											break;
										case 'center':
											$horizontal_align_class = 'left-1/2 -translate-x-1/2 text-center';
											break;
										default:
											$horizontal_align_class = 'lg:left-[55px] md:left-[20px] md:text-left text-center';
									}

									$vertical_align = $slider[ $slick->get_name_setting('vertical_align') ] ?? 'top';
									switch ( $vertical_align ) {
										case 'bottom':
											$vertical_align_class = 'md:bottom-1/4';
											break;
										case 'middle':
											$vertical_align_class = 'md:top-1/2 transform md:-translate-y-1/2';
											break;
										default:
											$vertical_align_class = 'md:top-1/4';
									}
									?>
									<div class="md:absolute info-wap lg:w-[45%] md:w-1/2 z-50  mt-14 md:mt-0 <?php echo esc_attr($horizontal_align_class); ?> <?php echo esc_attr($vertical_align_class); ?>">
										<div class="info-inner md:px-[15px]">
											<?php
											if ( $slider_title ) {
												$title_animation       = ! empty($slider[ $slick->get_name_setting('title_animation') ]) ? $slider[ $slick->get_name_setting('title_animation') ] . ' ' . ( $slider[ $slick->get_name_setting('title_animation_duration') ] ?? '' ) : '';
												$title_animation_delay = ! empty($slider[ $slick->get_name_setting('title_animation_delay') ]) ? $slider[ $slick->get_name_setting('title_animation_delay') ] . 'ms"' : '';
												$title_visibility      = ! empty($title_animation) ? 'invisible' : 'visible';
												?>
												<h2 data-visibility-start="<?php echo esc_attr($title_visibility); ?>"
													<?php echo ! empty($title_animation) ? 'data-animation="' . esc_attr($title_animation) . '"' : ''; ?>
													<?php echo ! empty($title_animation_delay) ? 'data-animation-delay="' . esc_attr($title_animation_delay) . '"' : ''; ?>
													class="title md:text-lg text-base md:mb-4 mb-2 <?php echo esc_attr($title_visibility); ?>"
												>
													<?php echo wp_kses_post($slider_title); ?>
												</h2>
											<?php } ?>
											<?php
											if ( $slider_sub_title ) {
												$subtitle_animation       = ! empty($slider[ $slick->get_name_setting('subtitle_animation') ]) ? $slider[ $slick->get_name_setting('subtitle_animation') ] . ' ' . ( $slider[ $slick->get_name_setting('subtitle_animation_duration') ] ?? '' ) : '';
												$subtitle_animation_delay = ! empty($slider[ $slick->get_name_setting('subtitle_animation_delay') ]) ? $slider[ $slick->get_name_setting('subtitle_animation_delay') ] . 'ms"' : '';
												$subtitle_visibility      = ! empty($subtitle_animation) ? 'invisible' : 'visible';
												?>
												<h3 data-visibility-start="<?php echo esc_attr($subtitle_visibility); ?>"
													<?php echo ! empty($subtitle_animation) ? 'data-animation="' . esc_attr($subtitle_animation) . '"' : ''; ?>
													<?php echo ! empty($subtitle_animation_delay) ? 'data-animation-delay="' . esc_attr($subtitle_animation_delay) . '"' : ''; ?>
													class="sub-title md:text-4xl text-2xl md:mb-7 mb-3 <?php echo esc_attr($subtitle_visibility); ?>"
												>
													<?php echo wp_kses_post($slider_sub_title); ?>
												</h3>
											<?php } ?>
											<?php
											if ( $description ) {
												$description_animation       = ! empty($slider[ $slick->get_name_setting('description_animation') ]) ? $slider[ $slick->get_name_setting('description_animation') ] . ' ' . ( $slider[ $slick->get_name_setting('description_animation_duration') ] ?? '' ) : '';
												$description_animation_delay = ! empty($slider[ $slick->get_name_setting('description_animation_delay') ]) ? $slider[ $slick->get_name_setting('description_animation_delay') ] . 'ms"' : '';
												$description_visibility      = ! empty($description_animation) ? 'invisible' : 'visible';
												?>
												<div data-visibility-start="<?php echo esc_attr($description_visibility); ?>"
													<?php echo ! empty($description_animation) ? 'data-animation="' . esc_attr($description_animation) . '"' : ''; ?>
													<?php echo ! empty($description_animation_delay) ? 'data-animation-delay="' . esc_attr($description_animation_delay) . '"' : ''; ?>
													class="description md:text-sm text-xs md:mb-9 mb-6 <?php echo esc_attr($description_visibility); ?>"
												>
													<?php echo wp_kses_post($description); ?>
												</div>
											<?php } ?>
											<?php
											$horizontal_align_center = $slider[ $slick->get_name_setting('horizontal_align') ] ?? 'center';
											?>

											<div class="button-group inline-flex justify-center items-center flex-col md:flex-row">
												<?php
													$countdown          = $slider[ $slick->get_name_setting('countdown_due_date') ];
													$countdown_position = $slider[ $slick->get_name_setting('countdown_position') ] ?? 'absolute';
												if ( ! empty($countdown) && ( time() < strtotime($countdown) ) ) {
													?>
														<div class="rbb-countdown flex justify-self-end invisible <?php echo esc_attr($countdown_position); ?>" data-visibility-start="invisible" data-countdown-date="<?php echo esc_attr($countdown); ?>"
														data-animation="
														<?php
														if ( $button_1 ) {
															$button_1_animations = ! empty($slider[ $slick->get_name_setting('button_1_animation') ]) ? $slider[ $slick->get_name_setting('button_1_animation') ] . ' ' . ( $slider[ $slick->get_name_setting('button_1_animation_duration') ] ?? '' ) : '';
															echo esc_html($button_1_animations);
														}
														?>
														" data-animation-delay="500ms">
															<div class="item-time days"><span class="data-number">%D</span><span class="name-time"><?php echo esc_html__('Day%!H', 'ecommax'); ?></span>
															</div>
															<div class="item-time"><span class="data-number">%H</span><span class="name-time"><?php echo esc_html__('Hour%!H', 'ecommax'); ?></span>
															</div>
															<div class="item-time"><span class="data-number">%M</span><span class="name-time"><?php echo esc_html__('Min%!H', 'ecommax'); ?></span>
															</div>
															<div class="item-time"><span class="data-number">%S</span><span class="name-time"><?php echo esc_html__('Secs', 'ecommax'); ?></span>
															</div>
														</div>
														<?php
												}
												?>
												<?php
												if ( $button_1 ) {
													$button_1_type             = $slider[ $slick->get_name_setting('button_1_type') ] ?? null;
													$button_1_url              = isset($slider[ $slick->get_name_setting('button_1_url') ]) ? $slider[ $slick->get_name_setting('button_1_url') ]['url'] : '#';
													$button_1_url_target       = isset($slider[ $slick->get_name_setting('button_1_url') ]['is_external']) && 'on' === $slider[ $slick->get_name_setting('button_1_url') ]['is_external'] ? '_blank' : '';
													$button_1_url_nofollow     = isset($slider[ $slick->get_name_setting('button_1_url') ]['nofollow']) && 'on' === $slider[ $slick->get_name_setting('button_1_url') ]['nofollow'] ? 'nofollow' : '';
													$button_1_icon             = ! empty($slider[ $slick->get_name_setting('button_1_icon') ]['value']) ? $slider[ $slick->get_name_setting('button_1_icon') ] : null;
													$button_1_animation        = ! empty($slider[ $slick->get_name_setting('button_1_animation') ]) ? $slider[ $slick->get_name_setting('button_1_animation') ] . ' ' . ( $slider[ $slick->get_name_setting('button_1_animation_duration') ] ?? '' ) : '';
													$button_1_animation_delay  = ! empty($slider[ $slick->get_name_setting('button_1_animation_delay') ]) ? $slider[ $slick->get_name_setting('button_1_animation_delay') ] . 'ms"' : '';
													$button_1_visibility       = ! empty($button_1_animation) ? 'invisible' : 'visible';
													$button_1_custom_attribute = isset($slider[ $slick->get_name_setting('button_1_url') ]['custom_attributes']) ? RisingBambooElementorHelper::get_custom_attributes($slider[ $slick->get_name_setting('button_1_url') ]['custom_attributes']) : [];
													?>
													<a <?php echo ( 'url' !== $button_1_type ) ? 'onclick="RisingBambooModal.modal(\'#rbb-modal-button-01-' . esc_attr($slider['_id']) . '\', event)"' : ''; ?>
														data-visibility-start="<?php echo esc_attr($button_1_visibility); ?>"
														href="<?php echo esc_url($button_1_url); ?>"
														<?php echo ! empty($button_1_animation) ? 'data-animation="' . esc_attr($button_1_animation) . '"' : ''; ?>
														<?php echo ! empty($button_1_animation_delay) ? 'data-animation-delay="' . esc_attr($button_1_animation_delay) . '"' : ''; ?>
														<?php echo ! empty($button_1_url_target) ? 'target="' . esc_attr($button_1_url_target) . '"' : ''; ?>
														<?php echo ! empty($button_1_url_nofollow) ? 'rel="' . esc_attr($button_1_url_nofollow) . '"' : ''; ?>
														class="rbb-slick-button button-1 inline-block transition duration-300 ease-in-out transform px-6 py-3 <?php echo esc_attr($button_1_visibility); ?>"
														<?php
														foreach ( $button_1_custom_attribute as $attr => $val ) {
															echo esc_attr($attr) . " = '" . esc_attr($val) . "' ";
														}
														?>
													>
														<span class="button-text inline-block align-middle"><?php echo wp_kses_post($button_1); ?></span>
														<?php
														if ( $button_1_icon ) {
															?>
															<span class="button-icon inline-block align-middle ml-[10px] xl:w-[42px] xl:h-[42px] xl:leading-10 w-8 h-8 leading-8 rounded-full">
															<?php
															Icons_Manager::render_icon($button_1_icon, [ 'aria-hidden' => 'true' ]);
															?>
															</span>
														<?php } ?>
													</a>
													<?php
													if ( 'url' !== $button_1_type ) {
														?>
														<div id="rbb-modal-button-01-<?php echo esc_attr($slider['_id']); ?>" class="rbb-modal <?php echo esc_attr($class_string); ?>" data-modal-animation="<?php echo esc_attr($modal_effect); ?>">
															<div class="rbb-modal-dialog">
																<header class="rbb-modal-header">
																	<button class="rbb-close-modal"
																			aria-label="close modal">
																	</button>
																</header>
																<div class="rbb-modal-body">
																	<?php
																	if ( 'video' === $button_1_type ) {
																		$button_1_video_url = $slider[ $slick->get_name_setting('button_1_video') ]['url'];
																		?>
																		<video width="640" height="360" controls>
																			<source src="<?php echo esc_url($button_1_video_url); ?>">
																			<?php echo esc_html__('Your browser does not support the video tag.', 'ecommax'); ?>
																		</video>
																		<?php
																	} elseif ( 'youtube' === $button_1_type ) {
																		$button_1_video_url = CoreHelper::get_youtube_embed($slider[ $slick->get_name_setting('button_1_youtube') ]);
																		?>
																		<iframe width="640" height="360"
																				src="<?php echo esc_url($button_1_video_url); ?>"
																				title="YouTube video player"
																				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
																				allowfullscreen></iframe>
																		<?php
																	} elseif ( 'vimeo' === $button_1_type ) {
																		$button_1_video_url = CoreHelper::get_vimeo_embed($slider[ $slick->get_name_setting('button_1_vimeo') ]);
																		?>
																		<iframe width="640" height="360"
																				src="<?php echo esc_url($button_1_video_url); ?>"
																				allow="autoplay; fullscreen; picture-in-picture"
																				allowfullscreen></iframe>
																		<?php
																	} elseif ( 'dailymotion' === $button_1_type ) {
																		$button_1_video_url = CoreHelper::get_dailymotion_embed($slider[ $slick->get_name_setting('button_1_dailymotion') ]);
																		?>
																		<iframe width="640" height="360"
																				type="text/html"
																				src="<?php echo esc_url($button_1_video_url); ?>"
																				allowfullscreen
																				allow="autoplay"></iframe>
																	<?php } ?>
																</div>
															</div>
														</div>
													<?php } ?>
												<?php } ?>
												<?php
												if ( $button_2 ) {
													$button_2_type             = $slider[ $slick->get_name_setting('button_2_type') ] ?? null;
													$button_2_url              = isset($slider[ $slick->get_name_setting('button_2_url') ]) ? $slider[ $slick->get_name_setting('button_2_url') ]['url'] : '#';
													$button_2_url_target       = isset($slider[ $slick->get_name_setting('button_2_url') ]['is_external']) && 'on' === $slider[ $slick->get_name_setting('button_2_url') ]['is_external'] ? '_blank' : '';
													$button_2_url_nofollow     = isset($slider[ $slick->get_name_setting('button_2_url') ]['nofollow']) && 'on' === $slider[ $slick->get_name_setting('button_2_url') ]['nofollow'] ? 'nofollow' : '';
													$button_2_icon             = ! empty($slider[ $slick->get_name_setting('button_2_icon') ]['value']) ? $slider[ $slick->get_name_setting('button_2_icon') ] : null;
													$button_2_animation        = ! empty($slider[ $slick->get_name_setting('button_2_animation') ]) ? $slider[ $slick->get_name_setting('button_2_animation') ] . ' ' . ( $slider[ $slick->get_name_setting('button_2_animation_duration') ] ?? '' ) : '';
													$button_2_animation_delay  = ! empty($slider[ $slick->get_name_setting('button_2_animation_delay') ]) ? $slider[ $slick->get_name_setting('button_2_animation_delay') ] . 'ms"' : '';
													$button_2_visibility       = ! empty($button_2_animation) ? 'invisible' : 'visible';
													$button_2_custom_attribute = isset($slider[ $slick->get_name_setting('button_2_url') ]['custom_attributes']) ? RisingBambooElementorHelper::get_custom_attributes($slider[ $slick->get_name_setting('button_2_url') ]['custom_attributes']) : [];
													?>
													<a <?php echo ( 'url' !== $button_2_type ) ? 'onclick="RisingBambooModal.modal(\'#rbb-modal-button-02-' . esc_attr($slider['_id']) . '\', event)"' : ''; ?>
															data-visibility-start="<?php echo esc_attr($button_2_visibility); ?>"
															href="<?php echo esc_url($button_2_url); ?>"
															<?php echo ! empty($button_2_animation) ? 'data-animation="' . esc_attr($button_2_animation) . '"' : ''; ?>
															<?php echo ! empty($button_2_animation_delay) ? 'data-animation-delay="' . esc_attr($button_2_animation_delay) . '"' : ''; ?>
															<?php echo ! empty($button_2_url_target) ? 'target="' . esc_attr($button_2_url_target) . '"' : ''; ?>
															<?php echo ! empty($button_2_url_nofollow) ? 'rel="' . esc_attr($button_2_url_nofollow) . '"' : ''; ?>
															class="rbb-slick-button button-2 md:ml-2 lg:ml-5 inline-block transition duration-300 ease-in-out transform <?php echo esc_attr($button_2_visibility); ?>"
															<?php
															foreach ( $button_2_custom_attribute as $attr => $val ) {
																echo esc_attr($attr) . " = '" . esc_attr($val) . "' ";
															}
															?>
													>
													<span class="button-icon xl:w-14 xl:h-14 w-10 h-10 rounded-full text-center inline-block align-middle">
														<span class="w-full h-full bg-white xl:p-2 rounded-full inline-block">
															<?php
															if ( $button_2_icon ) {
																Icons_Manager::render_icon($button_2_icon, [ 'aria-hidden' => 'true' ]);
																?>
															<?php } else { ?>
																<i class="rbb-icon-direction-74 leading-6 text-[18px] inline-block"></i>
															<?php } ?>
														</span>
													</span>
													</a>
													<?php
													if ( 'url' !== $button_2_type ) {
														?>
														<div id="rbb-modal-button-02-<?php echo esc_attr($slider['_id']); ?>" class="rbb-modal <?php echo ( false === Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE) ) ? 'outside-modal' : ''; ?>" data-modal-animation="<?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT)); ?>">
															<div class="rbb-modal-dialog">
																<header class="rbb-modal-header">
																	<button class="rbb-close-modal"
																			aria-label="close modal">
																	</button>
																</header>
																<div class="rbb-modal-body">
																	<?php
																	if ( 'video' === $button_2_type ) {
																		$button_2_video_url = $slider[ $slick->get_name_setting('button_2_video') ]['url'];
																		?>
																		<video width="640" height="360" controls>
																			<source src="<?php echo esc_url($button_2_video_url); ?>">
																			<?php echo esc_html__('Your browser does not support the video tag.', 'ecommax'); ?>
																		</video>
																		<?php
																	} elseif ( 'youtube' === $button_2_type ) {
																		$button_2_video_url = RisingBambooCore\Helper\Helper::get_youtube_embed($slider[ $slick->get_name_setting('button_2_youtube') ]);
																		?>
																		<iframe width="640" height="360"
																				src="<?php echo esc_url($button_2_video_url); ?>"
																				title="YouTube video player"
																				allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
																				allowfullscreen></iframe>
																		<?php
																	} elseif ( 'vimeo' === $button_2_type ) {
																		$button_2_video_url = RisingBambooCore\Helper\Helper::get_vimeo_embed($slider[ $slick->get_name_setting('button_2_vimeo') ]);
																		?>
																		<iframe width="640" height="360"
																				src="<?php echo esc_url($button_2_video_url); ?>"
																				allow="autoplay; fullscreen; picture-in-picture"
																				allowfullscreen></iframe>
																		<?php
																	} elseif ( 'dailymotion' === $button_2_type ) {
																		$button_2_video_url = RisingBambooCore\Helper\Helper::get_dailymotion_embed($slider[ $slick->get_name_setting('button_2_dailymotion') ]);
																		?>
																		<iframe width="640" height="360"
																				type="text/html"
																				src="<?php echo esc_url($button_2_video_url); ?>"
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
								<div class="content-image">
									<?php
									for ( $i = 1; $i <= $slick->images_per_slider; $i++ ) {
										$position = $slider[ $slick->get_name_setting('image_' . $i . '_position') ] ?? 'absolute';
										$index    = $slider[ $slick->get_name_setting('image_' . $i . '_z_index') ] ?? null;
										$z_index  = '';
										if ( null !== $index ) {
											$z_index = 'z-' . $index . '0';
										}
										$animation       = ! empty($slider[ $slick->get_name_setting('image_' . $i . '_animation') ]) ? $slider[ $slick->get_name_setting('image_' . $i . '_animation') ] . ' ' . ( $slider[ $slick->get_name_setting('image_' . $i . '_animation_duration') ] ?? '' ) : '';
										$animation_delay = ! empty($slider[ $slick->get_name_setting('image_' . $i . '_animation_delay') ]) ? $slider[ $slick->get_name_setting('image_' . $i . '_animation_delay') ] . 'ms' : '';
										$visibility      = ! empty($animation) ? 'invisible' : 'visible';
										if ( $slider[ $slick->get_name_setting('image_' . $i) ] && $slider[ $slick->get_name_setting('image_' . $i) ]['url'] ) {
											?>
											<img
													data-depth="0.<?php echo esc_attr($index); ?>"
													data-visibility-start="<?php echo esc_attr($visibility); ?>"
													<?php echo ! empty($animation) ? 'data-animation="' . esc_attr($animation) . '"' : ''; ?>
													<?php echo ! empty($animation_delay) ? 'data-animation-delay="' . esc_attr($animation_delay) . '"' : ''; ?>
													class="<?php echo esc_attr(( 'absolute' === $position ) ? '!absolute' : '!relative'); ?>
													<?php
													if ( $parallax && 1 !== $i ) {
														echo 'layer'; }
													?>
													image_<?php echo esc_attr($i); ?> <?php echo esc_attr($z_index); ?> <?php echo esc_attr($visibility); ?>
													"
													src="<?php echo esc_url($slider[ $slick->get_name_setting('image_' . $i) ]['url']); ?>"
													alt="<?php echo esc_attr__('Image Slider ', 'ecommax') . esc_attr($i); ?>"
											>
											<?php
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
		<div class="group-custom-button">
		<div class="dots_custom flex items-center font-bold justify-center mx-auto w-full shadow-[3px_0_6px_0_rgba(0,0,0,0.08)] rounded-[45px]">
			<div class="prev_custom"><i class="rbb-icon-direction-36"></i></div>
			<div class="slideshow-dot flex justify-center">
			<?php
				$i = 0;
			foreach ( $sliders as $slider ) {
				?>
				<div class="content-dots relative h-6 w-6 cursor-pointer mx-[2px] <?php echo ( 0 === $i ) ? 'active' : ''; ?>" data-index="<?php echo esc_attr($i); ?>">
				</div>

					<?php $i++; ?>
				<?php } ?>
			</div>
			<div class="next_custom"><i class="rbb-icon-direction-39"></i></div>
			<div class="play-pause relative">
			<svg><circle cx="18" cy="18" r="16" fill="none" stroke-width="2" class="animating"></circle></svg>
			<div class="button-action pause position-relative">
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi-pause" viewBox="0 0 16 16">
				<path d="M6 3.5a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5m4 0a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4a.5.5 0 0 1 .5-.5"></path>
				</svg>
				<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi-play" viewBox="0 0 16 16">
				<path d="M10.804 8 5 4.633v6.734zm.792-.696a.802.802 0 0 1 0 1.392l-6.363 3.692C4.713 12.69 4 12.345 4 11.692V4.308c0-.653.713-.998 1.233-.696z"></path>
				</svg>
			</div>
			</div>
		</div>
	</div>
	</div>
<?php } ?>
