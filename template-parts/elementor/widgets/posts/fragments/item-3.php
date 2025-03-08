<?php
/**
 * Elementor widget
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
?>
<div class="item basis-0">
	<div class="blog_item transition duration-700 shadow-[7px_7px_25px_0px_rgba(0,0,0,0.1)] group overflow-hidden rounded-[10px] bg-white">
		<div class="blog_image rounded-tl-[10px] rounded-tr-[10px] overflow-hidden mb-6 relative">
			<a href="<?php echo esc_url(get_permalink($_post)); ?>" class="w-full">
				<?php
				if ( has_post_thumbnail($_post) ) {
					echo get_the_post_thumbnail(
						$_post,
						'post-thumbnails',
						[
							'class' => 'w-full transition duration-500 ease-in-out transform scale-100 group-hover:scale-105 max-h-[720px]',
							'alt'   => get_the_title($_post),
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
					$categories = get_the_category($_post->ID);
				if ( ! empty($categories) ) {
					$category      = $categories[0];
					$category_link = get_category_link($category->term_id);
					echo '<a class="flex items-center justify-center px-5 py-[5px] text-[color:var(--rbb-general-heading-color] text-[0.625rem] uppercase leading-5 bg-[#f5f5f7] hover:bg-[color:var(--rbb-general-link-hover-color)] rounded-[30px] font-bold transition duration-300 ease-in-out transform hover:text-white" href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';
				}
				?>
			</div>
		</div>
		<div class="blog_info pl-5 pr-[10px] pb-[10px]">
			<a href="<?php echo esc_url(get_permalink($_post)); ?>" class="blog_title font-semibold text-lg mb-4 block"><span class="blog_title line-clamp-2"><?php echo get_the_title($_post); ?></span></a>
		<div class="content line-clamp-3 leading-[22px] mb-12">
				<?php echo esc_html(wp_trim_words(get_the_content(null, false, $_post->ID), 20, '...')); ?>
			</div>
			<div class="flex items-center justify-between">
				<div class="blog_meta text-[0.625rem] flex items-center uppercase">
				<?php if ( $show_author ) { ?>
					<div class="blog_author pr-2">
						<span class="font-normal"><?php echo esc_html__('By ', 'ecommax'); ?></span><span class="text-[color:var(--rbb-general-heading-color)] font-bold"><?php echo esc_html(get_the_author_meta('display_name', $_post->post_author)); ?></span>
					</div>
				<?php } ?>
				<?php if ( $show_date ) { ?>
					<div class="blog_date pl-5">
						<span class="relative"><?php echo get_the_date('dS M Y', $_post); ?></span>
					</div>
				<?php } ?>
			</div>
				<?php if ( $show_read_more ) { ?>
					<a href="<?php echo esc_url(get_permalink($_post)); ?>" class="flex items-center justify-center blog_readmore font-semibold rounded-full bg-[#ececec] hover:bg-[color:var(--rbb-general-link-hover-color)] hover:text-white w-[42px] h-[42px] transition duration-300 ease-in-out transform">
						<i class="rbb-icon-direction-711 text-lg"></i></a>
				<?php } ?>
			</div>
		</div>
	</div>
</div>
