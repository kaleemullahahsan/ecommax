<?php
/**
 * The header section.
 *
 * @package Rising_Bamboo
 */

use RisingBambooTheme\App\App;
use RisingBambooTheme\Customizer\Helper;
use RisingBambooCore\Kirki\Kirki as RisingBambooKirki;

$priority = 1;
RisingBambooKirki::add_section(
	RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
	[
		'title'       => esc_html__('Header', 'ecommax'),
		'description' => esc_html__('Theme header.', 'ecommax'),
		'panel'       => RISING_BAMBOO_KIRKI_PANEL_LAYOUT,
		'priority'    => 10,
	]
);

$headers = Helper::get_files_assoc(get_template_directory() . '/template-parts/headers/');
/**
 * The fields of this section.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Heading', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'select',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER,
		'label'       => esc_html__('Template', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER),
		'placeholder' => esc_html__('Select a header...', 'ecommax'),
		'priority'    => $priority++,
		'multiple'    => 1,
		'choices'     => $headers,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'color',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_BACKGROUND_COLOR,
		'label'       => esc_html__('Navigation background color', 'ecommax'),
		'description' => esc_html__('Background color of the navigation.', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_BACKGROUND_COLOR),
		'priority'    => $priority++,
		'choices'     => [
			'alpha' => true,
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_LOGIN_FORM,
		'label'       => esc_html__('Login Form', 'ecommax'),
		'description' => esc_html__('On/Off login form in header', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_LOGIN_FORM),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_SEARCH_FORM,
		'label'       => esc_html__('Search', 'ecommax'),
		'description' => esc_html__('On/Off search form in header', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_SEARCH_FORM),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_SEARCH_FORM_MOBILE,
		'label'       => esc_html__('Search Mobile', 'ecommax'),
		'description' => esc_html__('On/Off search in menu mobile', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_SEARCH_FORM_MOBILE),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_MINI_CART,
		'label'       => esc_html__('Mini Cart', 'ecommax'),
		'description' => esc_html__('On/Off mini cart feature in header', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_MINI_CART),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_WISH_LIST,
		'label'       => esc_html__('Wishlist', 'ecommax'),
		'description' => esc_html__('On/Off wishlist feature in header', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_WISH_LIST),
		'priority'    => $priority++,
	]
);

/**
 * Sticky.
 */

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'     => 'custom',
		'settings' => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_GROUP_TITLE . '_' . ( $priority++ ),
		'section'  => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'priority' => $priority++,
		'default'  => '<div class="rising-bamboo-kirki-separator">' . esc_html__('Heading Sticky', 'ecommax') . '</div>',
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'        => 'toggle',
		'settings'    => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY,
		'label'       => esc_html__('Enable', 'ecommax'),
		'description' => esc_html__('On/Off header sticky feature', 'ecommax'),
		'section'     => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'     => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY),
		'priority'    => $priority++,
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'radio',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_BEHAVIOUR,
		'label'           => esc_html__('Behaviour', 'ecommax'),
		'description'     => esc_html__('Behaviour of header sticky when you scroll down/up the page', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_BEHAVIOUR),
		'priority'        => $priority++,
		'choices'         => [
			'both' => [
				esc_html__('Both', 'ecommax'),
				esc_html__('Sticky on scroll down/up', 'ecommax'),
			],
			'up' => [
				esc_html__('Scroll Up', 'ecommax'),
				esc_html__('Sticky on scroll up', 'ecommax'),
			],
			'down' => [
				esc_html__('Scroll Down', 'ecommax'),
				esc_html__('Sticky on scroll down', 'ecommax'),
			],
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY,
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
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_HEIGHT,
		'label'           => esc_html__('Height', 'ecommax'),
		'description'     => esc_html__('Height of header sticky.', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_HEIGHT),
		'priority'        => $priority++,
		'choices'         => [
			'min'  => 0,
			'max'  => 300,
			'step' => 1,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);

RisingBambooKirki::add_field(
	RISING_BAMBOO_KIRKI_CONFIG,
	[
		'type'            => 'color',
		'settings'        => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_BACKGROUND_COLOR,
		'label'           => esc_html__('Background color', 'ecommax'),
		'description'     => esc_html__('Background color of header sticky.', 'ecommax'),
		'section'         => RISING_BAMBOO_KIRKI_SECTION_LAYOUT_HEADER,
		'default'         => Helper::get_default(RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY_BACKGROUND_COLOR),
		'priority'        => $priority++,
		'choices'         => [
			'alpha' => true,
		],
		'active_callback' => [
			[
				'setting'  => RISING_BAMBOO_KIRKI_FIELD_LAYOUT_HEADER_STICKY,
				'operator' => '==',
				'value'    => true,
			],
		],
	]
);
