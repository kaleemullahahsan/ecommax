<?php
/**
 * The Color Section in Color Panel
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;

$priority = 1;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_COLOR_MENU,
	[
		'title'          => esc_html__('Color', 'ecommax'),
		'description'    => esc_html__('Set colors for menu.', 'ecommax'),
		'panel'          => 'nav_menus',
		'priority'       => 1,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COLOR_MENU_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COLOR_MENU,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Menu', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COLOR_MENU_LINK,
		'label'       => __('Menu Link', 'ecommax'),
		'description' => esc_html__('Color for menu link.', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COLOR_MENU,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_MENU_LINK),
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COLOR_MENU_LINK_HOVER,
		'label'       => __('Menu Link Hover', 'ecommax'),
		'description' => esc_html__('Color for menu link when hover.', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COLOR_MENU,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_MENU_LINK_HOVER),
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COLOR_MENU_BACKGROUND,
		'label'       => __('Background', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COLOR_MENU,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_MENU_BACKGROUND),
		'choices'     => [
			'alpha' => true,
		],
	]
);
