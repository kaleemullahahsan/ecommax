<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 */

use RisingBambooCore\Core\View;
use RisingBambooCore\Helper\Elementor as RbbElementorHelper;
use RisingBambooTheme\App\App;

if ( count($posts['posts']) ) {
	?>
	<div id="<?php echo esc_attr($id); ?>" class="rbb_posts bg-cover <?php echo esc_attr($layout); ?>">
		<div class="block_slide 2xl:container px-[15px] mx-auto">
			<div class="block_heading flex items-center justify-between mb-8">
				<div class="block_title flex justify-center items-center">
						<h3 class="title uppercase"><?php echo wp_kses_post($posts['title']); ?></h3>
						<span class="sub-title block"><?php echo wp_kses_post($subtitle); ?></span>
				</div>
			</div>
			<div class="lg:flex w-full float-left main-blog">
				<div class="lg:w-1/2 main-blog-left">
					<?php
					$first_post = $posts['posts'][0];
					View::instance()->load(
						'elementor/widgets/posts/fragments/item-3',
						[
							'_post' => $first_post,
						]
					);
					?>
				</div>
				<div class="main-blog-right lg:mt-0 mt-[30px] lg:w-1/2">
				<?php
				$count = 0;
				foreach ( $posts['posts'] as $_post ) {
					if ( $count >= 1 ) {
						View::instance()->load(
							'elementor/widgets/posts/fragments/item-2',
							[
								'_post' => $_post,
							]
						);
					}
					$count++;
				}
				?>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>
