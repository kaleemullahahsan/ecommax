<?php
/**
 * RisingBambooTheme package
 *
 * @package RisingBambooTheme
 */

if ( $testimonials ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb-elementor-slider rbb-testimonial pt-10 pb-10 relative <?php echo esc_attr($layout); ?>">
		<div class="block_content_testimonial wow fadeInUp">
			<?php if ( $title ) { ?>
				<div class="block_heading mb-12">
					<h2 class="title mb-4"><?php echo esc_html($title); ?></h2>
					<p class="sub_title"><?php echo esc_html($sub_title); ?></p>
				</div>
			<?php } ?>
			<div class="rbb-slick-carousel slick-carousel load-item" data-slick='{
				"arrows": <?php echo esc_attr($show_arrows); ?>,
				"dots": <?php echo esc_attr($show_pagination); ?>,
				"autoplay": <?php echo esc_attr($autoplay); ?>,
				"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
				"slidesToScroll":1,
				"slidesToShow" : 3,
				"responsive": [
					{
						"breakpoint": 1330,
						"settings": {
							"slidesToShow": 3
						}
					},
					{
						"breakpoint": 1200,
						"settings": {
							"slidesToShow": 2
						}
					},
					{
						"breakpoint": 1025,
						"settings": {
							"slidesToShow": 2
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
					<div class="block_content flex">
						<div class="flex items-start testimonial_avartar justify-start relative">
							<div class="rounded-full overflow-hidden">
								<?php
								if ( has_post_thumbnail($testimonial) ) {
									echo get_the_post_thumbnail(
										$testimonial,
										'post-thumbnail',
										[
											'class' => 'w-full object-cover w-[100px] h-[100px] block',
											'alt'   => get_the_title($testimonial),
										]
									);
								} else {
									?>
									<img class="object-cover !w-[80px] !h-[80px]" src="<?php echo esc_url(get_stylesheet_directory_uri() . '/dist/images/default-thumbnail.png'); ?>" alt="<?php echo esc_html('Default post thumbnail'); ?>" >
								<?php } ?>
							</div>
						</div>
						<div class="block_content-text text-left">
							<div class="testimonial_ratings flex justify-start text-base text-[#ffa200] mb-4">
								<i class="rbb-icon-rating-start-filled-1"></i>
								<i class="rbb-icon-rating-start-filled-1"></i>
								<i class="rbb-icon-rating-start-filled-1"></i>
								<i class="rbb-icon-rating-start-filled-1"></i>
								<i class="rbb-icon-rating-start-filled-1"></i>
							</div>
							<div class="testimonial_text text-sm mb-5 line-clamp-8 relative leading-[22px] pr-5">
								<?php echo wp_kses_post($testimonial->post_content); ?>
							</div>
							<div class="block_content-name flex items-center justify-start pb-5">
								<div class="testimonial_info text-xs font-bold text-[#181818]"><?php echo esc_html($testimonial->post_title); ?> - </div>
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
