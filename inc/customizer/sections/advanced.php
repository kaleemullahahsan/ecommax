<?php
/**
 * RisingBambooTheme Package
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;
use RisingBambooTheme\Customizer\Helper as CustomizerHelper;
$priority = 1;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_ADVANCED_MEGA_MENU,
	[
		'title'         => esc_html__('Mega Menu', 'ecommax'),
		'panel'         => RISING_BAMBOO_KIRKI_PANEL_ADVANCED,
		'description'   => esc_html__('This section contains advanced configurations.', 'ecommax'),
	]
);

/**
 * General.
 */
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'label'       => esc_html__('Normalize Classes', 'ecommax'),
		'description' => esc_html__('Remove unnecessary css classes of menu item.', 'ecommax'),
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_ADVANCED_MEGA_MENU_NORMALIZE_CLASSES,
		'section'     => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_MEGA_MENU,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_ADVANCED_MEGA_MENU_NORMALIZE_CLASSES),
	]
);

/**
 * 404 Error Page.
 */
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
	[
		'title'         => esc_html__('404 Error Page', 'ecommax'),
		'panel'         => RISING_BAMBOO_KIRKI_PANEL_ADVANCED,
		'description'   => esc_html__('404 Error Page Configuration.', 'ecommax'),
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('404 Error Page', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'image',
		'settings'        => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_IMAGE,
		'label'           => esc_html__('Image', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_IMAGE),
		'priority'        => $priority++,
		'choices'         => [
			'save_as' => 'url',
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'text',
		'settings'        => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_TITLE,
		'label'           => esc_html__('Title', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_TITLE),
		'priority'        => $priority++,
	]
);


RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'text',
		'settings'        => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_DESC,
		'label'           => esc_html__('Description', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_PAGE_404_DESC),
		'priority'        => $priority++,
	]
);

/**
 * Background Gradient.
 */
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT,
	[
		'title'         => esc_html__('Gradient', 'ecommax'),
		'panel'         => RISING_BAMBOO_KIRKI_PANEL_ADVANCED,
		'description'   => esc_html__('Background Color Configuration.', 'ecommax'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_ENABLE,
		'label'       => esc_html__('Enable', 'ecommax'),
		'description' => esc_html__('On / Off Animation', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_ENABLE),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_COLOR_1,
		'label'       => esc_html__('Background Gradient Color 1', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_COLOR_1),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_COLOR_2,
		'label'       => esc_html__('Background Gradient Color 2', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_COLOR_2),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_COLOR_3,
		'label'       => esc_html__('Background Gradient Color 3', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_COLOR_3),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_COLOR_4,
		'label'       => esc_html__('Background Gradient Color 4', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_COLOR_4),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'slider',
		'settings'        => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_TIME,
		'label'           => esc_html__('Time', 'ecommax'),
		'description'     => esc_html__('Set the time for the gradient animation effect.', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT,
		'default'         => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_TIME),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 10,
			'max'  => 50,
			'step' => 1,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_ENABLE,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_DEG,
		'label'       => esc_html__('Deg', 'ecommax'),
		'description' => esc_html__('Rotation by a given degree value. There are 360 degrees in a circle.', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_SECTION_ADVANCED_GRADIENT_DEG),
		'priority'    => $priority++,
		'choices'     => [
			'min'  => 0,
			'max'  => 360,
			'step' => 1,
		],
	]
);
