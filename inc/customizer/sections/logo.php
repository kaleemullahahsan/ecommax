<?php
/**
 * RisingBambooTheme
 *
 * @package RisingBambooTheme
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;

$priority = 1;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_LOGO,
	[
		'title'          => esc_html__('Logo', 'ecommax'),
		'description'    => esc_html__('This section contains general logo options.', 'ecommax'),
	]
);

/**
 * General.
 */
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LOGO_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('General', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
		'label'       => esc_html__('Enable', 'ecommax'),
		'description' => esc_html__('Show/Hide the logo ?', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'radio-buttonset',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_MODE,
		'label'           => esc_html__('Default Logo', 'ecommax'),
		'description'     => esc_html__('Choose default logo.', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_MODE),
		'priority'        => $priority++,
		'choices'         => [
			'dark'  => esc_html__('Dark Logo', 'ecommax'),
			'light' => esc_html__('Light Logo', 'ecommax'),
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'image',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_DARK,
		'label'           => esc_html__('Dark Version', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_DARK),
		'priority'        => $priority++,
		'choices'         => [
			'save_as' => 'array',
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'image',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_LIGHT,
		'label'           => esc_html__('Light Version', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_LIGHT),
		'priority'        => $priority++,
		'choices'         => [
			'save_as' => 'array',
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'slider',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_MAX_WIDTH,
		'label'           => esc_html__('Logo Max Width', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_MAX_WIDTH),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'dimensions',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_PADDING,
		'label'           => esc_html__('Logo Padding', 'ecommax'),
		'description'     => esc_html__('For e.g: 1em 10rem 1vh 10px', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_PADDING),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

/**
 * Sticky Logo
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'custom',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_GROUP_TITLE . '_' . ( $priority++ ),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'priority'        => $priority++,
		'default'         => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Sticky', 'ecommax') . '</div>',
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'image',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_STICKY_DARK,
		'label'           => esc_html__('Dark Version', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_STICKY_DARK),
		'priority'        => $priority++,
		'choices'         => [
			'save_as' => 'array',
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'image',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_STICKY_LIGHT,
		'label'           => esc_html__('Light Version', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_STICKY_LIGHT),
		'priority'        => $priority++,
		'choices'         => [
			'save_as' => 'array',
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'slider',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_STICKY_MAX_WIDTH,
		'label'           => esc_html__('Logo Max Width', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_STICKY_MAX_WIDTH),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'dimensions',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LOGO_STICKY_PADDING,
		'label'           => esc_html__('Logo Padding', 'ecommax'),
		'description'     => esc_html__('For e.g: 1em 10rem 1vh 10px', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LOGO,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LOGO_STICKY_PADDING),
		'priority'        => $priority++,
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LOGO_STATUS,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);
