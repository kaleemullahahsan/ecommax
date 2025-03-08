<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\Helper\Helper;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;

$modal_effect    = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT);
$backdrop_filter = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER);
$classes         = [];
$classes[]       = ( true === $backdrop_filter ) ? 'backdrop' : 'backdrop-none';
$class_string    = implode(' ', array_filter($classes));

if ( function_exists('elementor_theme_do_location') && elementor_theme_do_location('footer') ) {
	elementor_theme_do_location('footer');
} elseif ( Helper::elementor_activated() ) {
	$footer_post_id = Tag::get_footer();
	if ( ! Elementor\Plugin::instance()->preview->is_preview_mode() ) {
		if ( Helper::is_built_with_elementor($footer_post_id) ) {
		    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display($footer_post_id);
		} else {
			echo wp_kses_post(get_the_content(null, false, $footer_post_id));
		}
	}
} else {
	get_template_part('template-parts/footers/' . Tag::get_footer());
}
?>
</div><!-- #page -->
<div class="canvas-overlay absolute inset-0 opacity-0 duration-300 invisible <?php echo esc_attr($class_string); ?>">
	<?php if ( true === $backdrop_filter ) { ?>
		<div class="rbb-modal-backdrop"></div>
	<?php } ?>
</div>
<div class="canvas-overlay2 absolute inset-0 opacity-0 duration-300 invisible <?php echo esc_attr($class_string); ?>">
	<?php if ( true === $backdrop_filter ) { ?>
		<div class="rbb-modal-backdrop"></div>
	<?php } ?>
</div>
<div class="filter-overlay absolute inset-0 opacity-0 duration-300 invisible"></div>
<div id="mobile_menu" class="canvas-menu shadow-[10px_0_15px_0_rgba(0,0,0,0.1)]"></div>
<div id="mobile_vertical_menu" class="canvas-menu-verticalmenu shadow-[10px_0_15px_0_rgba(0,0,0,0.1)]">
	<button class="rbb-close-modal w-12  h-12 rounded-full mx-auto bg-white text-xl flex items-center justify-center relative mt-[74px] mb-[100px] text-center cursor-pointer" aria-label="close modal" tabindex="0"></button>
</div>
<?php wp_footer(); ?>
</body>
</html>
