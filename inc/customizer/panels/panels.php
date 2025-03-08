<?php
/**
 * The Customizer Panel
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;

/**
 * General.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_GENERAL,
	[
		'priority'    => 10,
		'title'       => esc_html__('General', 'ecommax'),
		'description' => esc_html__('General theme settings', 'ecommax'),
	]
);

/**
 * Layout.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_LAYOUT,
	[
		'priority'    => 11,
		'title'       => esc_html__('Layout', 'ecommax'),
		'description' => esc_html__('The layout configuration', 'ecommax'),
	]
);

/**
 * Components.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_COMPONENT,
	[
		'priority'    => 12,
		'title'       => esc_html__('Components', 'ecommax'),
		'description' => esc_html__('Other components', 'ecommax'),
	]
);

/**
 * Advanced.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_ADVANCED,
	[
		'priority'    => 13,
		'title'       => esc_html__('Advanced', 'ecommax'),
		'description' => esc_html__('Advanced Configuration', 'ecommax'),
	]
);

/**
 * Blog.
 */
RisingBambooKirki::add_panel(
	RISING_BAMBOO_KIRKI_PANEL_BLOG,
	[
		'priority'    => 14,
		'title'       => esc_html__('Blog', 'ecommax'),
		'description' => esc_html__('Blog Configuration', 'ecommax'),
	]
);
