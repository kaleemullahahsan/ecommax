<?php
/**
 * The default header.
 *
 * @package Rising_Bamboo
 */

use RisingBambooCore\Woocommerce\FreeShippingCalculator;
use RisingBambooCore\App\Admin\RbbIcons;
use RisingBambooTheme\App\App;
use RisingBambooTheme\App\Menu\Menu;
use RisingBambooTheme\Helper\Helper;
use RisingBambooTheme\Helper\Setting;
use RisingBambooTheme\Helper\Tag;
use RisingBambooTheme\Woocommerce\Woocommerce as RisingBambooWoo;

$modal_effect    = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_EFFECT);
$outside         = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_CLICK_OUTSIDE_CLOSE);
$backdrop_filter = Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_MODAL_BACKDROP_FILTER);
$classes         = [];
$classes[]       = ( true === $backdrop_filter ) ? 'backdrop' : 'backdrop-none';
$classes[]       = ( false === $outside ) ? 'outside-modal' : '';
$class_string    = implode(' ', array_filter($classes));
$menu_vertical   = Menu::vertical_menus();

?>
<header id="rbb-default-header" class="rbb-default-header header-1 gradient-animate">
	<div class="relative z-30 w-full">
		<div class="md:block hidden 2xl:container px-[15px] mx-auto ">
			<div class="header-inner mx-auto h-full">
				<div class="mx-auto rbb-header-top flex items-center justify-between">
					<div class="rbb-location-phone lg:flex items-center justify-start basis-1/3 hidden ">
						<?php if ( is_active_sidebar('header-location-1') ) { ?>
							<?php dynamic_sidebar('header-location-1'); ?>
						<?php } ?>
					</div>
					<div class="contentsticky_logo rbb-logo basis-1/3 flex items-center lg:justify-center justify-start w-full">
						<?php
						if ( Helper::show_logo() ) {
							?>
							<span class="toggle-megamenu w-[18px] h-[14px] relative mr-10 cursor-pointer lg:hidden">
								<i class="icon-directional"></i>
							</span>
							<div id="_desktop_logo" class="flex items-center">
									<?php
									$logo        = Tag::get_logo_uri();
									$logo_sticky = Tag::get_logo_uri('sticky');
									if ( $logo === $logo_sticky ) {
										?>
										<a class="inline-block" href="<?php echo esc_url(home_url()); ?>">
											<img class="sticky-logo w-[var(--rbb-logo-sticky-max-width)]" src="<?php echo esc_url($logo_sticky); ?>" alt="<?php echo esc_attr__('Sticky Logo', 'ecommax'); ?>">
										</a>
										<?php
									} else {
										?>
										<a class="inline-block" href="<?php echo esc_url(home_url()); ?>">
											<img class="logo w-[var(--rbb-logo-max-width)]" src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr__('logo', 'ecommax'); ?>">
										</a>
									<?php } ?>
							</div>
						<?php } ?>
					</div>
					<?php
					if ( Helper::show_login_form() || Helper::show_search_product_form() || Helper::show_mini_cart() || Helper::show_wishlist() ) {
						?>
					<div class="contentsticky_header_right basis-1/3 flex w-full">
						<div id="rbb-header-right" class=" rbb-header-right flex justify-end items-center w-full">

								<?php if ( Helper::show_wishlist() ) { ?>
									<div class="rbb-wishlist flex items-center justify-center mr-8">
										<a class="wishlist-icon-link duration-300  flex items-center justify-center " aria-label="wishlist" href="<?php echo esc_url(WPcleverWoosw::get_url()); ?>">
											<i class="<?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_WOOCOMMERCE_WISHLIST_ICON)); ?>"></i>
										</a>
										<span class="wishlist-count text-black rounded-full"><?php echo WPcleverWoosw::get_count(); // phpcs:ignore ?></span>
									</div>
								<?php } ?>
								<?php
								if ( Helper::show_mini_cart() ) {
									RisingBambooWoo::instance()->mini_cart();
								}
								?>
							<?php
							if ( Helper::show_login_form() && class_exists(RbbIcons::class) ) {
								if ( Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_POPUP) ) {
									?>
								<div class="rbb-account relative flex items-center justify-center ml-8 <?php echo is_user_logged_in() ? 'toggle-login' : 'popup-account'; ?> "<?php if ( false === is_user_logged_in() ) { ?>
								onclick="RisingBambooModal.modal('.account-form-popup', event)" <?php } ?>
								>
									<div class="rbb-account-icon-wrap relative duration-300 cursor-pointer flex items-center justify-center">
										<span class="rbb-account-icon tracking-normal <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_ICON)); ?>"></span>
									</div>
									<div class="rbb-account-content-wrap">
										<?php
										$content = '';
										if ( is_user_logged_in() ) {
											$welcome = __('Hi', 'ecommax') . ', ' . ucwords(wp_get_current_user()->get('display_name'));
											$content = Menu::account_menu();
										} else {
											$welcome = __('Account', 'ecommax');
											add_action(
												'wp_footer',
												function () use ( $modal_effect, $class_string ) {
													echo '<div class="account-form-popup rbb-modal invisible fixed inset-0 z-50 '. esc_attr($class_string) .'" data-modal-animation="' . esc_attr($modal_effect) . '">' . Tag::login_form() . '</div>';			// phpcs:ignore
												}
											);
										}
										?>
										<?php if ( ! empty($content) ) { ?>
											<div class="rbb-account-content duration-300 mt-14 absolute z-10 visibility invisible rounded-lg overflow-hidden opacity-0 top-full right-0 shadow-[6px_5px_11px_rgba(0,0,0,0.1)]">
												<div class="relative bg-white min-w-[220px] px-8 pt-3 pb-5">
													<?php echo wp_kses($content, 'rbb-kses'); ?>
												</div>
											</div>
										<?php } ?>
									</div>
								</div>
								<?php } else { ?>
								<div class="rbb-account relative flex items-center justify-center ml-8 canvas-account"
								onclick="RisingBambooModal.modal('.account-form-canvas', event)"
								>
									<div class="rbb-account-icon-wrap relative duration-300 cursor-pointer flex items-center justify-center">
										<span class="rbb-account-icon tracking-normal <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_ICON)); ?>"></span>
									</div>
									<div class="rbb-account-content-wrap">
										<?php
										$content = '';
										add_action(
											'wp_footer',
											function () use ( $modal_effect, $class_string ) {
															// phpcs:ignore
												echo '<div class="account-form-canvas rbb-modal invisible fixed inset-0 z-50 ' . esc_attr($class_string) .'">' . Tag::canvas_menu() . '</div>';
											}
										);
										$content = Tag::canvas_menu();
										?>
									</div>
								</div>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="rbb-header-center bg-black bg-opacity-40 <?php echo $menu_vertical ? '' : 'pt-2 pb-2'; ?>">
					<div class="mx-auto flex items-center justify-between">
						<?php
						if ( $menu_vertical ) {
							?>
						<div class="min-w-[300px] all-categories rissing_overlay_blur pt-2 pb-2" data-backdrop="<?php echo esc_attr($class_string); ?>" data-repond="1024">
							<div class="duration-300 cursor-pointer flex items-center text-white relative categories-text pl-5 pr-6">
								<i class="rbb-icon-menu-6 text-2xl text-white mr-6"></i>
								<span class="text-[12px] uppercase font-bold text-white"><?php echo esc_html__('Browse All Category', 'ecommax'); ?></span>
								<i class="rbb-icon-direction-42 text-[8px] text-white ml-auto font-bold icon-chevron-down"></i>
							</div>
							<div class="vertical-menu-main bg-white <?php echo esc_attr($class_string); ?> shadow-[0px_10px_15px_0_rgba(0,0,0,0.1)]">
								<div class="2xl:container px-[15px] mx-auto content-vertical-menu relative">
									<div id="desktop_vertical_menu">
								<?php echo Menu::vertical_menus(); // phpcs:ignore ?>
									</div>
								</div>
							</div>
						</div>
						<?php } ?>
						<div id="desktop_menu" class="contentsticky_menu hidden lg:block">
							<button class="rbb-close-canvas-menu w-12  h-12 rounded-full bg-white text-xl flex items-center justify-center cursor-pointer mx-auto mb-10 lg:hidden " aria-label="close modal" tabindex="0"></button>
							<?php if ( Helper::show_search_product_form_mobile() ) { ?>
								<div class="search_desktop animate-[500ms] lg:hidden"></div>
							<?php } ?>
							<div id="rbb-site-navigation" class="rbb-main-navigation screen">
								<nav id="menu-main" class="menu primary-menu h-full">
									<?php echo Menu::primary_menu(); // phpcs:ignore ?>
								</nav>
							</div>
							<div class="lg:hidden mobile_bottom flex justify-between flex-col items-start">
								<div class="flex mb-1.5 animate-[1500ms]">
									<span class="pr-1 font-bold"><?php echo esc_html__('Email:', 'ecommax'); ?> </span>
									<?php echo do_shortcode('[rbb_contact type="email"]'); ?>

								</div>
								<div class="flex mb-[25px] animate-[1600ms]">
									<span class="pr-1 font-bold"><?php echo esc_html__('Call Us:', 'ecommax'); ?></span>
									<?php echo do_shortcode('[rbb_contact type="phone"]'); ?>
								</div>
								<div class="animate-[1700ms] social_content mb-[30px]"></div>
							</div>
						</div>
						<?php if ( Helper::show_search_product_form() ) { ?>
							<?php if ( true === Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY) ) { ?>
								<div class="rbb-product-search relative flex items-center justify-center cursor-pointer mr-2 <?php echo $menu_vertical ? '' : 'rbb-product-search-zero'; ?>" onclick="RbbThemeSearch.openSearchForm(event)">
									<div class="rbb-product-search-icon-wrap justify-center items-center flex !bg-transparent <?php echo ( Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON_BORDER) > 0 ) ? 'h-[50px] w-[50px]' : ''; ?>">
										<span class="rbb-product-search-icon <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_ICON)); ?>"></span>
									</div>
									<div class="rbb-product-search-content">
										<?php Tag::search(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY)); // phpcs:ignore ?>
									</div>
								</div>
								<span class="search-mobile text-center w-[22px] py-3 mr-2 text-[#222] cursor-pointer text-[22px] md:hidden">
									<i class="rbb-icon-search-10"></i>
								</span>
							<?php } else { ?>
								<div class="rbb-product-search relative flex items-center justify-center cursor-pointer mr-2 <?php echo $menu_vertical ? '' : 'rbb-product-search-zero'; ?>">
									<div id="_desktop_search" class="rbb-product-search-content2">
										<?php Tag::search(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_SEARCH_OVERLAY)); // phpcs:ignore ?>
									</div>
								</div>
							<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="sticky_header">
		<div class="rbb-header-sticky relative z-50 opacity-0 invisible gradient-animate">
			<div class="flex flex-nowrap items-center justify-between w-full 2xl:container px-[15px] mx-auto h-full">
				<div class="flex-start">
					<div class="contentstickynew_logo"></div>
				</div>
				<div class="basis-1/2">
					<div class="contentstickynew_menu"></div>
				</div>
				<div class="flex-end">
					<div class="contentstickynew_header_right"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="header-mobile bgradient-animate px-[15px] md:hidden">
		<div class="flex items-center justify-between max-h-[60px]">
			<div class="menu-mobile flex items-center min-w-[60px] h-[60px]">
				<span class="toggle-megamenu w-[18px] h-[14px] relative mr-5 cursor-pointer">
					<i class="icon-directional"></i>
				</span>
				<?php if ( Helper::show_search_product_form() ) { ?>
					<div class="w-[22px] text-center">
						<span class="search-mobile text-center text-white w-[18px] h-[18px] flex justify-center items-center cursor-pointer text-[22px]">
							<i class="rbb-icon-search-10"></i>
						</span>
						<div id="_mobile_search" class="product-search-mobile bg-white absolute z-10 inset-x-0 top-full w-full opacity-0 invisible">
						</div>
					</div>
				<?php } ?>
			</div>
			<div id="_mobile_logo" class="px-5 flex items-center justify-center"></div>
			<div class="header-mobile-right min-w-[60px] flex items-center justify-end">
				<div id="_mobile_cart" class="rbb-mini-cart"></div>
				<?php
				if ( $menu_vertical ) {
					?>
				<div class="all-categories ml-5"><i class="rbb-icon-menu-4 text-white text-lg"></i></div>
				<?php } ?>

			</div>
		</div>
	</div>
</header><!-- #masthead -->
