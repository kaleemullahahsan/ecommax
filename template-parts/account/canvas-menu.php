<?php
/**
 * RisingBambooTheme
 *
 * @package RisingBambooTheme.
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\App\Menu\Menu;
use RisingBambooTheme\Helper\Helper;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;
use RisingBambooTheme\Woocommerce\Woocommerce as RisingBambooWoo;
?>
<div class="canvas-menu md:w-[370px] fixed top-0 -right-[370px] bottom-0 bg-white z-30 shadow-[-10px_0_15px_0_rgba(0,0,0,0.1)]">
<div class="top-canvas-logo flex items-center justify-between pb-8 border-[#cdcdcd] border-b">
<?php
if ( Helper::show_logo() ) {
	?>
	<div class="flex items-center">
	<?php
		$logo      = Tag::get_logo_uri();
		$logo_dark = Setting::get(RISING_BAMBOO_KIRKI_FIELD_LOGO_DARK);
	if ( is_array($logo_dark) && isset($logo_dark['url']) ) {
		$logo_dark_url = $logo_dark['url'];
	} else {
		$logo_dark_url = Tag::get_logo_uri();
	}
	?>
		<a class="inline-block" href="<?php echo esc_url(home_url()); ?>">
		<img class="logo w-[var(--rbb-logo-sticky-max-width)]" src="<?php echo esc_url($logo_dark_url); ?>" alt="<?php echo esc_attr__('logo', 'ecommax'); ?>">
		</a>
	</div>
<?php } ?>
<button class="rbb-close-modal w-12  h-12 rounded-full bg-white text-xl flex items-center justify-center cursor-pointer" aria-label="close modal" tabindex="0"></button>
</div>
<div class="block-account-menu border-[#cdcdcd] border-b pb-7 pt-[23px]">
	<p class="uppercase font-bold text-[#cdcdcd] text-[12px]"><?php echo esc_html__('CUSTOMER ACCOUNT', 'ecommax'); ?></p>
	<?php
		$content = '';
		$content = Menu::customer_account_menu();
		echo wp_kses($content, 'rbb-kses');
	?>
</div>
<div class="block-account-menu block-care-menu pb-7 pt-[23px]">
	<p class="uppercase font-bold text-[#cdcdcd] text-[12px]"><?php echo esc_html__('CUSTOMER CARE', 'ecommax'); ?></p>
	<?php
		$content2 = '';
		$content2 = Menu::customer_care_menu();
		echo wp_kses($content2, 'rbb-kses');
	?>
</div>
</div>
