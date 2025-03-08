<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\App\App;
use RisingBambooTheme\Helper\Tag;
use RisingBambooCore\App\Admin\RbbIcons;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog-wrap blog_item transition duration-700 shadow-[4px_4px_12px_0px_rgba(0,0,0,0.1)] group overflow-hidden rounded-[10px] bg-white">
		<div class="blog_image rounded-tl-[10px] rounded-tr-[10px] overflow-hidden mb-3 relative">
			<?php Tag::post_thumbnail(); ?>
		</div>
		<div class="relative">
			<div class="entry-content blog_info pl-5 pr-[10px] pb-[10px]">
				<h3 class="entry-title text-[18px] pt-4 pb-2 leading-8">
					<a href="<?php echo esc_url(get_permalink()); ?>" class="blog_title font-semibold text-base mb-4 block leading-[26px]"><span class="blog_title line-clamp-2"><?php echo esc_html(the_title()); ?></span></a>
				</h3>
				<?php if ( Setting::get(RISING_BAMBOO_KIRKI_FIELD_BLOG_CATEGORY_SHOW_EXCERPT) ) { ?>
					<div>
						<?php echo esc_html(wp_trim_words(get_the_content(), 28, '...')); ?>
					</div>
				<?php } ?>
				<div class="flex items-center justify-between mt-5">
				<div class="blog_meta text-[0.625rem] flex items-center uppercase">

					<div class="blog_author pr-2">
						<span class="font-normal"><?php echo esc_html__('By ', 'ecommax'); ?></span><span class="text-[color:var(--rbb-general-heading-color)] font-bold"><?php echo get_the_author(); ?></span>
					</div>
					<div class="blog_date pl-5">
						<span class="relative"><?php echo get_the_date('dS M Y'); ?></span>
					</div>
			</div>
				<a href="<?php echo esc_url(get_permalink()); ?>" class="flex items-center justify-center blog_readmore font-semibold rounded-full bg-[#ececec] hover:bg-[color:var(--rbb-general-link-hover-color)] hover:text-white hover:fill-white w-[42px] h-[42px] transition duration-300 ease-in-out transform">
		<?php if ( class_exists(RbbIcons::class) ) { ?>
		<i class="rbb-icon-direction-711 text-lg"></i>
		<?php } else { ?>
			<svg xmlns="http://www.w3.org/2000/svg" height="12" viewBox="0 0 6.3499999 6.3500002" width="12"><g transform="translate(0 -290.65)"><path d="m.53383012 294.09009h4.64777838l-.8707478.87075c-.250114.25011.1250569.62528.375171.37517l.7930187-.79426.529381-.53021c.1025988-.10321.1025988-.26989 0-.3731l-1.3223997-1.32395c-.050312-.0517-.1195649-.0807-.1917197-.0801-.2381777.00003-.3550648.29011-.1834513.45527l.8728149.87075h-4.66353979c-.36681596.0182-.33942735.54794.0136943.52968z"></path></g></svg>
		<?php } ?>
		</a>
			</div>
			</div>
			<?php wp_link_pages(); ?>
		</div><!-- .entry-content -->
		<footer class="entry-footer hidden">
			<?php Tag::entry_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>
</article><!-- #post-<?php the_ID(); ?> -->
