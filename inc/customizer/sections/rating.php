<?php
/**
 * RisingBambooTheme
 *
 * @package rising-bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper as CustomizerHelper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;
use RisingBambooTheme\Helper\Helper;

$priority = 1;

/**
 * Section.
 */

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_COMPONENT_RATING,
	[
		'title'         => esc_html__('Rating', 'ecommax'),
		'panel'         => RISING_BAMBOO_KIRKI_PANEL_COMPONENT,
		'description'   => esc_html__('This section contains advanced configurations for rating.', 'ecommax'),
	]
);

/**
 * Rating Configration.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_RATING_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_RATING,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Rating', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'rbb-icons',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_RATING_ICON,
		'label'       => esc_html__('Icon', 'ecommax'),
		'description' => esc_html__('Choose the rating icon ?', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_RATING,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_RATING_ICON),
		'priority'    => $priority++,
		'choices'     => Helper::get_rbb_icons('rating'),
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'slider',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_RATING_ICON_SIZE,
		'label'       => esc_html__('Icon Size', 'ecommax'),
		'description' => esc_html__('Unit : rem', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_RATING,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_RATING_ICON_SIZE),
		'priority'    => $priority++,
		'choices'     => [
			'min'  => 0,
			'max'  => 3,
			'step' => 0.1,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COMPONENT_RATING_ICON_COLOR,
		'label'       => esc_html__('Color', 'ecommax'),
		'description' => esc_html__('Change the icon color?', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COMPONENT_RATING,
		'default'     => CustomizerHelper::get_default(RISING_BAMBOO_KIRKI_FIELD_COMPONENT_RATING_ICON_COLOR),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	]
);
