<?php
/**
 * RisingBambooTheme
 *
 * @package RisingBambooTheme.
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Setting;

global $post;
$categories   = get_the_category($post->ID);
$category_ids = [];
foreach ( $categories as $category ) {
	$category_ids[] = $category->term_id;
}
$category_ids = implode(',', $category_ids);
if ( strlen($category_ids) > 0 ) {
	$arg = [
		'post_type'    => $post->post_type,
		'cat'          => $category_ids,
		'post__not_in' => [ $post->ID ],
	];
} else {
	$arg = [
		'post_type'    => $post->post_type,
		'post__not_in' => [ $post->ID ],
	];
}

/* Remove the quote post format */

//phpcs:ignore
$arg['tax_query'] = [
	[
		'taxonomy' => 'post_format',
		'field'    => 'slug',
		'terms'    => [ 'post-format-quote' ],
		'operator' => 'NOT IN',
	],
];
$related_posts    = new WP_Query($arg);
if ( $related_posts->have_posts() ) {
	$is_slider = true;
	if ( isset($related_posts->post_count) && $related_posts->post_count <= 1 ) {
		$is_slider = false;
	}
	$show_arrows     = Setting::get(RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_SHOW_NAVIGATION);
	$show_pagination = Setting::get(RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_SHOW_PAGINATION);
	$autoplay        = Setting::get(RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_AUTO_PLAY);
	$autoplay_speed  = Setting::get(RISING_BAMBOO_KIRKI_FIELD_BLOG_RELATED_POST_AUTO_PLAY_SPEED);
	?>
	<div class="related-posts overflow-hidden bg-[#f2f2f2]">
		<div class="content container mx-auto pt-[110px] pb-[120px] px-[15px] xl:px-0">
			<div class="block_heading flex items-center justify-between mb-8 px-[15px]">
				<div class="block_title flex justify-center items-center">
						<h3 class="title uppercase"><?php esc_html_e('Related Posts', 'ecommax'); ?></h3>
				</div>
				<div class="block_title_tab flex items-center">
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
			<div class="rbb-related-posts rbb-slick-el slick-carousel slick-carousel-center" data-slick='{
				"arrows": <?php echo esc_attr(( $show_arrows ) ? 'true' : 'false'); ?>,
				"appendArrows" : ".related-posts .arrow-custom",
				"prevArrow": ".related-posts .arrow-custom .prev_custom",
				"nextArrow": ".related-posts .arrow-custom .next_custom",
				"dots": <?php echo esc_attr(( $show_pagination ) ? 'true' : 'false'); ?>,
				"autoplay": <?php echo esc_attr(( $autoplay ) ? 'true' : 'false'); ?>,
				"autoplaySpeed": <?php echo esc_attr($autoplay_speed); ?>,
				"pauseOnFocus": <?php echo esc_attr(( $autoplay_speed ) ? 'true' : 'false'); ?>,
				"pauseOnHover": <?php echo esc_attr(( $autoplay_speed ) ? 'true' : 'false'); ?>,
				"rows": 1,
				"slidesToScroll":1,
				"slidesToShow" : 4,
				"responsive": [
					{
						"breakpoint": 1024,
						"settings": {
							"slidesToShow": 2
						}
					},
					{
						"breakpoint": 767,
						"settings": {
							"slidesToShow": 2
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
				while ( $related_posts->have_posts() ) :
					$related_posts->the_post();

					$post_format = get_post_format();
					if ( $is_slider && 'gallery' === $post_format ) {
						$post_format = false;
					}
					?>
					<div class="item md:p-[15px] p-2 basis-0">
						<div class="blog_item transition duration-700 shadow-[6px_6px_12px_0px_rgba(0,0,0,0.1)] group overflow-hidden rounded-[10px] bg-white">
							<div class="post-img blog_image rounded-tl-[10px] rounded-tr-[10px] overflow-hidden mb-3 relative">
							<a href="<?php echo esc_url(get_permalink($post)); ?>" class="w-full">
								<?php
								if ( has_post_thumbnail($post) ) {
									echo get_the_post_thumbnail(
										$post,
										'custom-size',
										[
											'class' => 'w-full transition duration-500 ease-in-out transform scale-100 group-hover:scale-105',
											'alt'   => get_the_title($post),
										]
									);
								} else {
									?>
									<img class="transition duration-500 ease-in-out transform scale-100 group-hover:scale-105"
										src="<?php echo esc_url(get_stylesheet_directory_uri() . '/dist/images/default-thumbnail.png'); ?>"
										alt="<?php echo esc_attr__('Default post thumbnail', 'ecommax'); ?>">
									<?php
								}
								?>
							</a>
							<div class="block_category absolute left-5 bottom-5">
								<?php
									$categories = get_the_category($post->ID);
								if ( ! empty($categories) ) {
									$category      = $categories[0];
									$category_link = get_category_link($category->term_id);
									echo '<a class="flex items-center justify-center px-5 py-[5px] text-white text-[0.625rem] uppercase leading-5 bg-[color:var(--rbb-general-link-hover-color)] rounded-[30px] font-bold transition duration-300 ease-in-out transform" href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';
								}
								?>
							</div>
							</div>
							<div class="blog_info pl-5 pr-[10px] pb-[10px]">
								<a href="<?php echo esc_url(get_permalink($post)); ?>" class="blog_title font-semibold text-base mb-7 block leading-[26px]"><span class="blog_title line-clamp-2"><?php echo get_the_title($post); ?></span></a>
								<div class="flex items-center justify-between">
									<div class="blog_meta text-[0.625rem] flex items-center uppercase">

									<div class="blog_author pr-2">
										<span class="font-normal"><?php echo esc_html__('By ', 'ecommax'); ?></span><span class="text-[color:var(--rbb-general-heading-color)] font-bold"><?php echo esc_html(get_the_author_meta('display_name', $post->post_author)); ?></span>
									</div>
									<div class="blog_date pl-5">
										<span class="relative"><?php echo get_the_date('dS M Y', $post); ?></span>
									</div>
								</div>
								<a href="<?php echo esc_url(get_permalink($post)); ?>" class="flex items-center justify-center blog_readmore font-semibold rounded-full bg-[#ececec] hover:bg-[color:var(--rbb-general-link-hover-color)] hover:text-white w-[42px] h-[42px] transition duration-300 ease-in-out transform">
									<i class="rbb-icon-direction-711 text-lg"></i></a>
								</div>
							</div>
						</div>
					</div>
				<?php endwhile; ?>
			</div>
		</div>
	</div>
	<?php
	wp_reset_postdata();
}
?>
