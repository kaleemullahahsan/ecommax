<?php
/**
 * RisingBambooTheme
 *
 * @package RisingBambooTheme.
 */

use RisingBambooTheme\App\App;
use RisingBambooCore\Helper\Helper;
use RisingBambooTheme\Helper\Setting;

$logout = wp_logout_url();
if ( is_user_logged_in() ) {
	?>
<div class="rbb-account-canvas-links flex items-start flex-col justify-start">
	<?php if ( Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_SHOW_BUTTON_EDIT) && Helper::woocommerce_activated() ) { ?>
		<div class="edit-account w-full ">
			<a class="flex items-center justify-between font-semibold whitespace-nowrap text-sm leading-8 " href="<?php echo esc_url(home_url('my-account/edit-account')); ?>">
				<?php echo esc_html__('Edit Account', 'ecommax'); ?>
				<span class="text-base <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_BUTTON_EDIT_ICON)); ?> text-[color:var(--rbb-account-button-edit-icon-color)]"></span>
			</a>
		</div>
	<?php } ?>
	<?php if ( Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_SHOW_BUTTON_LOGOUT) ) { ?>
		<div class="logout-account w-full">
			<a class="font-semibold flex items-center justify-between leading-8 text-sm text-[#181818] capitalize" href="<?php echo esc_url(wp_logout_url(get_permalink())); ?>">
				<?php echo esc_html__('Logout', 'ecommax'); ?>
				<span class="text-base <?php echo esc_attr(Setting::get(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_ACCOUNT_BUTTON_LOGOUT_ICON)); ?> text-[color:var(--rbb-account-button-logout-icon-color)]"></span>
			</a>
		</div>
	<?php } ?>

</div>
<?php } else { ?>
<div class="rbb-account-canvas-links flex items-start flex-col justify-start">
	<div class="register-account w-full">
		<a class="font-semibold flex items-center leading-8 text-sm text-[#181818] capitalize" href="<?php echo esc_url(home_url('my-account')); ?>">
			<?php echo esc_html__('Register', 'ecommax'); ?>
		</a>
	</div>
	<div class="login w-full">
		<a class="font-semibold flex items-center leading-8 text-sm text-[#181818] capitalize" href="<?php echo esc_url(home_url('my-account')); ?>">
			<?php echo esc_html__('Login', 'ecommax'); ?>
		</a>
	</div>
</div>
	<?php
}
