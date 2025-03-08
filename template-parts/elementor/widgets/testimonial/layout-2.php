<?php
/**
 * RisingBambooTheme package
 *
 * @package RisingBambooTheme
 */

if ( $testimonials ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb-elementor-slider rbb-testimonial pb-16 relative <?php echo esc_attr($layout); ?>">
		<div class="block_content_testimonial wow fadeInUp">
			<?php if ( $title ) { ?>
				<div class="block_heading mb-[42px] text-center">
					<h3 class="title mb-3 uppercase"><?php echo esc_html($title); ?></h3>
					<p class="sub_title"><?php echo esc_html($sub_title); ?></p>
				</div>
			<?php } ?>
			<div class="rbb-slick-carousel slick-carousel load-item-4" data-slick='{
				"arrows": <?php echo esc_attr($show_arrows); ?>,
				"dots": <?php echo esc_attr($show_pagination); ?>,
				"autoplay": <?php echo esc_attr($autoplay); ?>,
				"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
				"slidesToScroll":1,
				"infinite": false,
				"slidesToShow" : 4,
				"responsive": [
					{
						"breakpoint": 1280,
						"settings": {
							"slidesToShow": 3
						}
					},
					{
						"breakpoint": 991,
						"settings": {
							"slidesToShow": 2
						}
					},
					{
						"breakpoint": 768,
						"settings": {
							"slidesToShow": 1
						}
					},
					{
						"breakpoint": 480,
						"settings": {
							"slidesToShow": 1
						}
					}
				]
			}'>
			<?php
			foreach ( $testimonials as $testimonial ) {
				?>
				<div class="item item-<?php echo esc_attr($testimonial->ID); ?>">
					<div class="block_content">
						<div class="flex items-center testimonial_avartar justify-center relative">
							<div class="rounded-full overflow-hidden">
								<?php
								if ( has_post_thumbnail($testimonial) ) {
									echo get_the_post_thumbnail(
										$testimonial,
										'post-thumbnail',
										[
											'class' => 'w-full object-cover !w-[80px] !h-[80px]',
											'alt'   => get_the_title($testimonial),
										]
									);
								} else {
									?>
									<img class="object-cover !w-[80px] !h-[80px]" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/dist/images/default-thumbnail.png'); ?>" alt="<?php echo esc_html('Default post thumbnail'); ?>" >
								<?php } ?>
							</div>
						</div>
						<div class="block_content-text text-center mt-7">
							<div class="testimonial_ratings flex justify-center text-base text-[#ffa200] mb-4">
								<i class="rbb-icon-rating-start-filled-1"></i>
								<i class="rbb-icon-rating-start-filled-1"></i>
								<i class="rbb-icon-rating-start-filled-1"></i>
								<i class="rbb-icon-rating-start-filled-1"></i>
								<i class="rbb-icon-rating-start-filled-1"></i>
							</div>
							<div class="testimonial_text text-sm mb-6 line-clamp-5 relative leading-[23px]">
								<?php echo wp_kses_post($testimonial->post_content); ?>
							</div>
							<div class="block_content-name flex items-center justify-center">
								<div class="testimonial_info text-xs font-bold text-[#2d2d2d]"><?php echo esc_html($testimonial->post_title); ?> - </div>
								<div class="testimonial_excerpt text-xs text-[#cdcdcd] ml-1"><?php echo esc_html($testimonial->post_excerpt); ?></div>
							</div>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>
<?php } ?>
