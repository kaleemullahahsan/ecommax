<?php
/**
 * RisingBambooTheme package.
 *
 * @package RisingBambooTheme
 */

namespace RisingBambooTheme\App\Menu;

use RisingBambooTheme\App\App;
use RisingBambooTheme\Core\Singleton;
use RisingBambooTheme\Helper\Setting;

/**
 * Class Menu.
 *
 * @package RisingBambooTheme
 */
class Menu extends Singleton {
	/**
	 * Construct.
	 */
	public function __construct() {

		add_filter('nav_menu_link_attributes', [ $this, 'nav_menu_link_attributes' ], 10, 4);
		add_filter('rbb_theme_menu_item_image_size', [ $this, 'nav_menu_item_image_size' ]);
	}

	/**
	 * Primary Menu Location.
	 *
	 * @param array $args Args.
	 * @return false|string
	 */
	public static function primary_menu( array $args = [] ) {
		$class = 'menu-container';

		if ( is_rtl() ) {
			$class .= ' rtl-direction';
		}

		$defaults = [
			'theme_location' => 'primary',
			'container'      => 'ul',
			'menu_class'     => $class,
		];

		$args = wp_parse_args($args, $defaults);

		if ( defined('RBB_CORE_META_FIELD_MENU_PRIMARY') ) {
			$menu = get_post_meta(Setting::get_id(), RBB_CORE_META_FIELD_MENU_PRIMARY, true);
			if ( ! empty($menu) ) {
				$args['menu'] = $menu;
			}
		}

		ob_start();

		if ( class_exists(WalkerNavMenu::class) && ( has_nav_menu('primary') || isset($args['menu']) ) ) {
			$args['walker'] = new WalkerNavMenu();
			wp_nav_menu($args);
		} else {
			echo esc_html__('Please assign a menu to the primary location : Appearance > Menus > Manage Locations', 'ecommax');
		}

		return ob_get_clean();
	}

	/**
	 * Account Menu.
	 *
	 * @param array $args Args.
	 * @return false|string
	 */
	public static function account_menu( array $args = [] ) {
		$class = 'menu-container divide-y divide-gray-200';

		if ( is_rtl() ) {
			$class .= ' rtl-direction';
		}

		$defaults = [
			'theme_location' => 'account',
			'container'      => 'ul',
			'menu_class'     => $class,
			'depth'          => 1,
		];

		$args = wp_parse_args($args, $defaults);

		ob_start();

		if ( class_exists(WalkerNavMenu::class) && has_nav_menu('account') ) {
			$args['walker'] = new WalkerNavMenu();
			wp_nav_menu($args);
		} else {
			echo '<div class="notice whitespace-nowrap">' . esc_html__('Please assign a menu to the account location : Appearance > Menus > Manage Locations', 'ecommax') . '</div>';
		}

		get_template_part('template-parts/account/logout');

		return ob_get_clean();
	}

	/**
	 * Customer Account Menu.
	 *
	 * @param array $args Args.
	 * @return false|string
	 */
	public static function customer_account_menu( array $args = [] ) {
		$class = 'customer-account-menu customer-menu ';

		if ( is_rtl() ) {
			$class .= ' rtl-direction';
		}

		$defaults = [
			'theme_location' => 'customer_account',
			'container'      => 'ul',
			'menu_class'     => $class,
			'depth'          => 1,
		];

		$args = wp_parse_args($args, $defaults);

		ob_start();

		if ( class_exists(WalkerNavMenu::class) && has_nav_menu('customer_account') ) {
			$args['walker'] = new WalkerNavMenu();
			wp_nav_menu($args);
		} else {
			echo '<div class="notice whitespace-nowrap">' . esc_html__('Please assign a menu to the account location : Appearance > Menus > Manage Locations', 'ecommax') . '</div>';
		}

		get_template_part('template-parts/account/customer-account');

		return ob_get_clean();
	}

	/**
	 * Customer Care Menu.
	 *
	 * @param array $args Args.
	 * @return false|string
	 */
	public static function customer_care_menu( array $args = [] ) {
		$class = 'customer-care-menu customer-menu';

		if ( is_rtl() ) {
			$class .= ' rtl-direction';
		}

		$defaults = [
			'theme_location' => 'customer_care',
			'container'      => 'ul',
			'menu_class'     => $class,
			'depth'          => 1,
		];

		$args = wp_parse_args($args, $defaults);

		ob_start();

		if ( class_exists(WalkerNavMenu::class) && has_nav_menu('customer_care') ) {
			$args['walker'] = new WalkerNavMenu();
			wp_nav_menu($args);
		} else {
			echo '<div class="notice whitespace-nowrap">' . esc_html__('Please assign a menu to the account location : Appearance > Menus > Manage Locations', 'ecommax') . '</div>';
		}

		return ob_get_clean();
	}

	/**
	 * Vertical Menu Location.
	 *
	 * @param array $args Args.
	 * @return false|string
	 */
	public static function vertical_menus( array $args = [] ) {
		$class = 'menu-container vertical-menu-content';

		if ( is_rtl() ) {
			$class .= ' rtl-direction';
		}

		$defaults = [
			'theme_location' => 'vertical_menu',
			'container'      => 'ul',
			'menu_class'     => $class,
		];

		$args = wp_parse_args($args, $defaults);

		if ( defined('RBB_CORE_META_FIELD_MENU_VERTICAL') ) {
			$menu = get_post_meta(Setting::get_id(), RBB_CORE_META_FIELD_MENU_VERTICAL, true);
			if ( ! empty($menu) ) {
				$args['menu'] = $menu;
			}
		}

		ob_start();

		if ( class_exists(WalkerNavMenu::class) && ( has_nav_menu('vertical_menu') || isset($args['menu']) ) ) {
			$args['walker'] = new WalkerNavMenu();
			wp_nav_menu($args);
		} else {
			return '';
		}

		return ob_get_clean();
	}

	/**
	 * Menu Link Attribute.
	 *
	 * @param array $atts Attr.
	 * @param mixed $item Item.
	 * @param array $args Args.
	 * @param int   $depth Depth.
	 * @return array
	 */
	public function nav_menu_link_attributes( array $atts, $item, $args, int $depth ): array {
		if ( isset($atts['class']) ) {
			if ( is_array($args) && isset($args['theme_location']) ) {
				if ( 'primary' === $args['theme_location'] && 0 === $depth ) {
					$atts['class'] .= ' xl:mx-5 mx-3 h-full flex items-center a-level font-bold';
				} elseif ( 'account' === $args['theme_location'] ) {
					$atts['class'] .= ' py-2 text-sm whitespace-nowrap font-medium';
				}
			}
		}
		return $atts;
	}

	/**
	 * Get Image size.
	 *
	 * @param mixed $size Size.
	 * @return array
	 */
	public function nav_menu_item_image_size( $size ): array {
		$config = get_theme_support('rbb-menu-item-image')[0];
		if ( is_array($config) ) {
			return $config;
		}
		return $size;
	}
}
