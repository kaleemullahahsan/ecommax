<?php
/**
 * The Color Section in Color Panel
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;

/**
 * General.
 */

$priority = 1;

RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
	[
		'title'       => esc_html__('Colors', 'ecommax'),
		'description' => esc_html__('General colors.', 'ecommax'),
		'panel'       => RISING_BAMBOO_KIRKI_PANEL_GENERAL,
		'priority'    => 160,
	]
);

// <editor-fold desc="General">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('General', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_HEADING_COLOR,
		'label'       => __('Heading Color', 'ecommax'),
		'description' => esc_html__('H1, H2 ... H6', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_HEADING_COLOR),
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_BODY_TEXT,
		'label'       => __('Body Text', 'ecommax'),
		'description' => esc_html__('Set the color for the body text.', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_BODY_TEXT),
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_BODY_BACKGROUND,
		'label'       => __('Background color', 'ecommax'),
		'description' => esc_html__('Visible if the grid is contained.', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_BODY_BACKGROUND),
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'color',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_PRIMARY_COLOR,
		'label'    => __('Primary color', 'ecommax'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority' => $priority++,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_PRIMARY_COLOR),
		'choices'  => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'color',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_SECONDARY_COLOR,
		'label'    => __('Secondary color', 'ecommax'),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority' => $priority++,
		'default'  => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_SECONDARY_COLOR),
		'choices'  => [
			'alpha' => true,
		],
	]
);
// </editor-fold>

// <editor-fold desc="Link">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Link', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'multicolor',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_LINK,
		'label'       => __('Choose color', 'ecommax'),
		'description' => esc_html__('This is a color of the link.', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_LINK),
		'choices'     => [
			'link'  => esc_html__('Default', 'ecommax'),
			'hover' => esc_html__('Hover', 'ecommax'),
		],
	]
);
// </editor-fold>

// <editor-fold desc="General Button">
RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('General Button', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'multicolor',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_BUTTON_TEXT_COLOR,
		'label'       => __('Text Color', 'ecommax'),
		'description' => esc_html__('This is a color of text.', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_BUTTON_TEXT_COLOR),
		'choices'     => [
			'link'  => esc_html__('Default', 'ecommax'),
			'hover' => esc_html__('Hover', 'ecommax'),
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'multicolor',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_BUTTON_BACKGROUND,
		'label'       => __('Background Color', 'ecommax'),
		'description' => esc_html__('This is a color of background button.', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_COLOR_GENERAL,
		'priority'    => $priority++,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_COLOR_GENERAL_BUTTON_BACKGROUND),
		'choices'     => [
			'link'  => esc_html__('Default', 'ecommax'),
			'hover' => esc_html__('Hover', 'ecommax'),
		],
	]
);
// </editor-fold>
